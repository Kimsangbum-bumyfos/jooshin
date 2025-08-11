<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Car extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();      
        $this->load->model('api/car_m');

    }

    //자동차 리스트 조회
    public function list_get(){

        $arrays = array(
            'car_type' => $this->input->get('type', TRUE),
            'offset' => $this->input ->get('offset', TRUE),
            'limit' => $this->input ->get('limit', TRUE),
        );
        
        $result = $this->car_m->carList_get($arrays);
        
        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Get List Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);            
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'NO DATA'
            ]);
        }
    }

    public function detail_get() {
        $idx = $this->input->get('idx', TRUE);
        if(!$idx) {
            $this->response([
                'status' => FALSE,
                'message' => 'undefined idx'
            ]);
            exit;
        }
        $result = $this->car_m->detail_get($idx);
        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Get List Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'NO DATA'
            ]);
        }
    }
    function popularList_get() {
        $result = $this->car_m->popularList_get();
        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Get List Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'NO DATA'
            ]);
        }
    }

    /***********************************************************************************************************************************
    *********렌트 예상가격 계산을 위한 필요 함수*******************************************************************************************
    ***********************************************************************************************************************************/

    //휴무일 체크 시 날짜 한자리인데 앞에 '0'있는 경우 제거
    function fitHoliday($num){
        if($num < 10){
            $num = substr($num,1,1);
        }
        return $num;
    }

    //렌탈 올림 일수를 리턴
    //추가 시간이 10시간 이상인 경우에는 하루치를 적용하므로 사용한다.
    function rental_day($d1, $d2){
        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        $diff_secs = abs($d1 - $d2);

        return ceil($diff_secs / (3600 * 24));
    }

    //렌탈 내림 일수를 리턴
    //추가 시간이 10시간 미만인 경우 추가 요금을 계산하기 위해 사용한다.
    function rental_real_day($d1, $d2){

        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        $diff_secs = abs($d1 - $d2);

        return floor($diff_secs / (3600 * 24));
    }

    //렌트 일수를 시간을 환산하여 추가되는 시간(나머지값)을 리턴 한다.

    function rental_add_hours($d1, $d2){
        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        
        $diff_hour = abs($d1 - $d2) / 3600;
        
        return (int)$diff_hour % 24;
    }

    //시작날짜, 완료날짜 포함 사이에 있는 모든 날짜 리스트 리턴
    function createDateRangeArray($strDateFrom,$strDateTo){

        $aryRange=array();
        
        //YYYY-MM-DD 타입
        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),substr($strDateTo,8,2),substr($strDateTo,0,4));

        //YYYYMMDD 타입
        // $iDateFrom=mktime(1,0,0,substr($strDateFrom,4,2),substr($strDateFrom,6,2),substr($strDateFrom,0,4));
        // $iDateTo=mktime(1,0,0,substr($strDateTo,4,2),substr($strDateTo,6,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom){
            array_push($aryRange,date('Ymd',$iDateFrom)); // first entry
            
            while ($iDateFrom<$iDateTo){
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Ymd',$iDateFrom));
            }
        }
        return $aryRange;
    }

    /***********************************************************************************************************************************
    *********렌탈 예상가격 계산**********************************************************************************************************
    *  옵션을 제외한 일수에 해당하는 렌트 예상가격 합계를 리턴한다.(보험, 배/회차 서비스)

    * 1. totalDateList : 시작일, 종료일에 해당하는 모든 날짜 리스트
    * 2. rental_hours_type : 렌트 추가 시간
    *    - R001 : 추가 시간 없이 일수로 딱 떨어지는 경우(0 또는 10시간 초과시)
    *    - R002 : 추가 시간이 있는 경우
    * 3. rental_day_type : 렌트 전체 일수 
    *    - D001 : 1~2일 렌트
    *    - D002 : 3~6일 렌트
    *    - D003 : 7일 이상 렌트
    * 변수로 넘어온 날짜의 하루 가격을 설정한다.
    * rental_day_type : 렌트 일수 타입
    * check_date : 계산이 필요한 날짜 
    ***********************************************************************************************************************************/
    function daily_price($arr, $rental_day_type, $check_date){

        //daily_price($arr, $rental_day_type, $totalDateList[$i]);
        //rental_day_type : 렌트 전체 일수 / D001 : 1~2일 렌트 , D002 : 3~6일 렌트, D003 : 7일 이상 렌트
        //totalDateList :렌트 계산할 날짜 
        
        //고객이 입력한 정보
        $car_idx = $arr['car_idx'];
        $s_date = $arr['s_date'];
        $e_date = $arr['e_date'];
        $operate_svc = $arr['operate_svc'];
        $release_svc = $arr['release_svc'];
        $insur_fee_type = $arr['insur_fee_type'];

        //차량 idx에 해당하는 자동차 정보        
        
        $data['views'] = $this->car_m->get_view($car_idx);

        $rental_fee = $data['views']->rental_fee; //정가
        $rental_fee_12 = $data['views']->rental_fee_12; //할인가(1일기준가)
        $rental_peak_fee_12 = $data['views']->rental_peak_fee_12; //성수기가(1일기준가) 
        $rental_high_peak_fee_12 = $data['views']->rental_high_peak_fee_12; //극성수기가(1일기준가)

        $rental_fee_36 = $data['views']->rental_fee_36; //3~6일 기본 가격
        $rental_peak_fee_36 = $data['views']->rental_peak_fee_36; //3~6일 성수기 가격
        $rental_high_peak_fee_36 = $data['views']->rental_high_peak_fee_36; //3~6일 극성수기 가격

        $rental_fee_7 = $data['views']->rental_fee_7; //7일 이상 기본 가격
        $rental_peak_fee_7 = $data['views']->rental_peak_fee_7; //7일 이상 성수기 가격
        $rental_high_peak_fee_7 =$data['views']->rental_high_peak_fee_7; //7일 극성수기 가격
        
        $rental_weekend_fee = $data['views']->rental_weekend_fee; //주말가격(1일 기준)

        $add_hours_fee =$data['views']->add_hours_fee; //추가시간(시간당)
        
        $insur_fee = $data['views']->insur_fee;  //보험료(완전자차)
        $insur_fee_10 = $data['views']->insur_fee_10; //보험료(고객부담금 10만원)
        $insur_fee_30 = $data['views']->insur_fee_30; //보험료(고객부담금 30만원)

        $operate_svc_fee = $data['views']->operate_svc_fee;  //배차
        $release_svc_fee = $data['views']->release_svc_fee;  //회차
        
        //--------------------------------------------------------------
        //법정 휴무일 체크
        $chk_year = substr($check_date,0,4);
        $chk_mon = substr($check_date,4,2);
        $chk_day = (int)substr($check_date,6,2);

        // echo "checkdate : ". $check_date."<br />";
        // echo "chk_year : ". $chk_year."<br />";
        // echo "mon : ".$chk_mon."<br />";
        // echo "chk_day : ". $chk_day."<br />";

        //법정 공휴일 체크
        $holiday_chk = $this->car_m ->holidayCheck($chk_year,$chk_mon,$chk_day);
        
        //holiday_chk : 0->법정공휴일 X
        //holiday_chk : 1->법정공휴일 O
        if($holiday_chk ===false){
            $holiday_chk = 0;    
        }else{
            $holiday_chk = 1;    
        }

        // echo "holiday_chk". $holiday_chk;

        /*************************성수기, 극성수기 체크**************************************************
        //peak_type : 성수기(01)
        //peak_type : 극성수기(02)
        //peak_type : 준성수기/일반(03)
        *******************************************************************************************************/

        //날자포맷 YYYYMMDD 성수기 체크할 날짜 8자리(예:20180101)
        $check_date = substr($check_date,0,8);
        
        //해당 날짜가 성수기에 해당하는지 체크한다.        
        $count = $this->car_m->peakCheck($check_date,'count');

        //해당 날짜가 성수기가 아닌경우(카운트가 0인 경우)
        if($count ==0){
            //일반,준성수기 등 성수/극성수기에 해당하지 않는 경우
            $peak_type="03";
        }else{
            $data['views'] = $this->car_m->peakCheck($check_date,'');            
            $peak_type = $data['views']->peak_type;
        }

                        
        //rental_day_type : 렌트 전체 일수 
        //- D001 : 1~2일 렌트
        //- D002 : 3~6일 렌트
        //- D003 : 7일 이상 렌트

        //1~2일인 경우
        //성수기/극성수기만 체크 
        $daily_price=0;

        if($rental_day_type=='D001'){

            //성수기,극성수기 체크
           
            if($peak_type=="01" || $peak_type=="02"){

                //성수기 가격 설정
                if($peak_type=="01"){

                    $daily_price = (int)$rental_peak_fee_12;

                //극성수기 가격 설정    
                }else if($peak_type=="02"){
                    
                    $daily_price = (int)$rental_high_peak_fee_12;

                }

            //성수기가 아닌 경우 주말 및 법정공휴일 체크
            }else{

                //주말여부 체크
                $weekend_day = date("w", strtotime(substr($check_date,0,8)));

                // echo "check_date : ". $check_date."<br>";
                // echo "weekend_day : ". $weekend_day."<br>";

                //주말요금인 경우 (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일), 법정공휴일(DB설정일)
                if($weekend_day==5 || $weekend_day==6 || $weekend_day==0 || $holiday_chk==1){
                    $daily_price = (int)$rental_weekend_fee;
                }else{
                    $daily_price = (int)$rental_fee_12;
                }

            }           

        //렌트일수 3~6일인 경우 
        }else if($rental_day_type =='D002'){

            //성수기,극성수기 체크
            if($peak_type=="01" || $peak_type=="02"){

                //성수기 가격 설정
                if($peak_type=="01"){

                    $daily_price = (int)$rental_peak_fee_36;

                //극성수기 가격 설정    
                }else if($peak_type=="02"){

                    $daily_price = (int)$rental_high_peak_fee_36;
                }

            //성수기가 아닌 경우 주말 및 법정공휴일 체크
            }else{

                //주말여부 체크
                $weekend_day = date("w", strtotime(substr($check_date,0,10)));

                //주말요금인 경우 (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일)
                if($weekend_day==5 || $weekend_day==6 || $weekend_day==0 || $holiday_chk==1){
                    $daily_price = (int)$rental_weekend_fee; 
                } else{
                    $daily_price = (int)$rental_fee_36; 
                }

            }

        //렌트일수 7일 이상인 경우에는 주말, 법정공휴일 체크 안함     
        }else if($rental_day_type=='D003'){

            //성수기,극성수기 체크
            if($peak_type=="01" || $peak_type=="02"){

                //성수기 가격 설정
                if($peak_type=="01"){

                    $daily_price = (int)$rental_peak_fee_7; 

                //극성수기 가격 설정    
                }else if($peak_type=="02"){

                    $daily_price = (int)$rental_high_peak_fee_7; 

                }
            }else{
                    //7일 이상 렌트 시에는 주말 요금을 고려하지 않는다.
                    $daily_price = (int)$rental_fee_7; 
            }

        }

        return (int)$daily_price;

    }

    public function totalSum_post(){

        
        //고객이 입력한 정보
        $car_idx = $this->input->post('car_idx', TRUE);
        $s_date = $this->input->post('s_date', TRUE);
        $e_date = $this->input->post('e_date', TRUE);
        $operate_svc = $this->input->post('operate_svc', TRUE);
        $release_svc = $this->input->post('release_svc', TRUE);
        $insur_fee_type = $this->input->post('insur_fee_type', TRUE);

        $arr = array(
            'car_idx' =>  $car_idx, 
            's_date' => $s_date, 
            'e_date' => $e_date, 
            'operate_svc' => $operate_svc, 
            'release_svc' => $release_svc, 
            'insur_fee_type' => $insur_fee_type,             
        );
        

        //보험료 계산
        $data['views'] = $this->car_m->get_view($car_idx);

        //echo var_dump($data['views']);
        //echo $data['views']->insur_fee;
        $insur_fee_00 = $data['views']->insur_fee;  //보험료(완전자차)
        $insur_fee_10 = $data['views']->insur_fee_10; //보험료(고객부담금 10만원)
        $insur_fee_30 = $data['views']->insur_fee_30; //보험료(고객부담금 30만원)

        //추가시간 비용
        $add_hours_fee = $data['views']->add_hours_fee; 


        //배/회차 비용
        $operate_svc_fee = $data['views']->operate_svc_fee;
        $release_svc_fee = $data['views']->release_svc_fee;


        //고객부담금 0원(완전자차)
        if($insur_fee_type=='01'){
            $insur_fee    = (int)$insur_fee_00;
        
        //고객부담금 10만원    
        }else if($insur_fee_type=='02'){
            $insur_fee    = (int)$insur_fee_10;

        //고객부담금 30만원    
        }else if($insur_fee_type=='03'){
            $insur_fee    = (int)$insur_fee_30;
        }else{
            $insur_fee =0;
        }

        //--------------------------------------------------------------------------------------------
        //렌트 시작일과 종료일 포함 렌트 전체 일자 리스트를 가져 온다.
        //배열로 받아서 저장

        $totalDateList = $this-> createDateRangeArray(substr($s_date,0,10),substr($e_date,0,10));
        

        //추가되는 시간을 리턴 받는다.
        //추가시간은 10시간 기준이며 10시간 이상은 1일로 계산된다. 10시간 미만인 경우에만 추가시간을 계산한다.
        $rental_add_hours = $this-> rental_add_hours($s_date, $e_date);

        //렌트 시간 기준으로 타입을 결정한다.
        //R001 : 추가 시간 없이 일수로 딱 떨어지는 경우(0 또는 10시간 초과시)
        //R002 : 추가 시간이 있는 경우
        $rental_hours_type = "";

        if($rental_add_hours > 10){
            $rental_hours_type = "R001";        
        }else{
            $rental_hours_type = "R002";        
        }        

        //렌트 일수 계산
        $rentDays =0;   
        // 추가 시간이 없는 경우 올림 일수로 계산
        if($rental_hours_type =="R001"){
            $rentDays = $this-> rental_day($s_date,$e_date);
        // 추가 시간이 있는 경우 내림 일수로 계산
        }else{
            $rentDays = $this-> rental_real_day($s_date,$e_date);
        }

        //렌트 전체 일수 에 따른 가격구간 타입 설정
        //1. 1~2일 : D001
        //2. 3~6일 : D002
        //3. 7일 이상 : D003

        $rental_day_type ="";

        if($rentDays==1 || $rentDays==2){
            
            $rental_day_type ="D001";

        }else if($rentDays >=3 && $rentDays <= 6){
            
            $rental_day_type ="D002";

        }else if($rentDays>=7){
            $rental_day_type ="D003";
        }

        
        /*******************기본 가격 일별 합산(렌트 전체일자에 해당하는 차량 렌트 비용 총 합산 )******************/
        
        $basic_fee = 0;
                
        for($i=0; $i<$rentDays; $i++){
            
            $basic_fee += $this-> daily_price($arr, $rental_day_type, $totalDateList[$i]);
        }

        /*********************************추가 시간 계산**********************************/
        //rental_hours_type : R002는 추가 시간이 있는 경우   
        //나중에 렌트 총 합산 할 때 추가시간은 별도로 계산
        if($rental_hours_type =='R002'){
            $add_hours_fee = (int)$rental_add_hours * (int)$add_hours_fee;         
        }else{
            $add_hours_fee=0;       
        }

        /*********************************보험료 계산**********************************/
        //보험료는 1시간만 추가되어도 1일 요금이 적용되므로 올림 일수로 산정한다.
        $insur_rent_days = $this-> rental_day($s_date,$e_date);
        $insur_fee = (int)$insur_rent_days*(int)$insur_fee;
        
        
        /*********************************배/회차 계산**********************************/
        // operate_svc_fee : 배차 서비스  / release_svc_fee : 회차 서비스
          
        //배차가격
//        if($operate_svc=='Y') $operate_svc_fee=(int)$operate_svc_fee; else $operate_svc_fee=0;
//        //회차가격
//        if($release_svc=='Y') $release_svc_fee=(int)$release_svc_fee; else $release_svc_fee=0;
        //------------------------------------------------------------------------

        //추가 시간을 포함 옵션 제외 렌트 비용 합산
        $basic_fee = (int)$basic_fee + (int)$add_hours_fee;

        //렌트 전체 합산 
        $total_sum = (int)$basic_fee + (int)$insur_fee + (int)$operate_svc_fee + (int)$release_svc_fee;

        $arrays = array(
            'total_sum' => $total_sum,            
            'basic_fee' => $basic_fee,            
            'operate_svc_fee' => $operate_svc_fee,            
            'release_svc_fee' => $release_svc_fee,            
            'insur_fee' => $insur_fee,            
            'rentDays' => $rentDays,            
            'rental_add_hours' => $rental_add_hours            
        );

        if($total_sum>0){
            $this->response([
                'status' => TRUE,
                'message' => 'Get View Success',
                'result' => $arrays,
            ], REST_Controller::HTTP_OK);        
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Get View Error'
            ]);
        }

    }
}
