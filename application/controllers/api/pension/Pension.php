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

#팬션 객실 리스트 호출(o)
#팬션 상세보기(o)
#연관 팬션(o)
#예약조회(o)
#예약취소(o)
#예약하기
#예약 기본 정보(o)
#예약날짜에 가능한 객실 리스트 

class Pension extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();      
        $this->load->model('api/pension_m');       

    }

    //팬션 객실 리스트 조회
    public function list_get(){

        $arrays = array(
            'offset' => $this->input ->get('offset', TRUE),
            'limit' => $this->input ->get('limit', TRUE),
        );
        
        $result = $this->pension_m->pensionList_get($arrays);
        
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
        $result = $this->pension_m->detail_get($idx);
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

    //추천 객실 리스트 조회
    //총 4개를 가져온다.
    function relatedList_get() {

        //현재 보고 있는 객실 idx값 
        $arrays = array(
            'idx' => $this->input ->get('idx', TRUE),   
            'tags' => $this->input ->get('tags', TRUE)   
        );

        $result = $this->pension_m->relatedList_get($arrays);
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

    //예약정보 저장
    function reserveInsert_post(){

        $insert_array = array(
            'pension_id' => $this->input->post('pension_id', TRUE), 
            'room_name' => $this->input->post('room_name', TRUE), 
            'reserve_name' => $this->input->post('reserve_name', TRUE), 
            'reserve_phone' => $this->input->post('reserve_phone', TRUE), 
            'reserve_email' => $this->input->post('reserve_email', TRUE), 
            'reserve_memo' => $this->input->post('reserve_memo', TRUE), 
            'total_number' => $this->input->post('total_number', TRUE), 
            'additional_number' => $this->input->post('additional_number', TRUE), 
            'estimate_cost' => $this->input->post('estimate_cost', TRUE), 
            'reserve_options' => $this->input->post('reserve_options', TRUE), 
            'isMobile' => $this->input->post('isMobile', TRUE), 
            'stay_s_date' => $this->input->post('stay_s_date', TRUE), 
            'stay_e_date' => $this->input->post('stay_e_date', TRUE), 
            'reservation_date' => date('Y-m-d H:i:s'),  
            'reserve_status' => 'done',  
            'payment_status' => 'doing',
            'confirm_result' => 'doing'
        );
        
        $option_arrays = $this->input ->post('options', TRUE);

        $result = $this->pension_m->reserveInsert($insert_array, $option_arrays);
        
        //예약 완료 후 문자전송
        if($result){

            $this->load->library('Sms');
            //관리자 SMS 전송
            $arr = array(
                'from' => $this->config->item('SMS_SEND_NUMBER_ADMIN'),
                'type' => 'LMS',                
                'subject' => '팬션예약신청',                
                'to' => $this->config->item('SMS_RECEIVE_NUMBER_ADMIN'),
                'text' => '팬션예약신청.
이름 : '.$insert_array['reserve_name'].'
객실 : '.$insert_array['room_name'].'
예약일 : '.date("Y-m-d H:i").'
연락처 : '.$insert_array['reserve_phone']
            );
            $this->sms->sendSimpleSms($arr);

            //예약자 SMS 전송
            $arr = array(
                'from' => $this->config->item('SMS_SEND_NUMBER_ADMIN'),
                'type' => 'LMS',
                'subject' => '팬션예약신청',   
                'to' => $insert_array['reserve_phone'],
                'text' => '예약신청완료.
신청자 : '.$insert_array['reserve_name'].'
객실 : '.$insert_array['room_name'].'
기간 : '.$insert_array['stay_s_date'].'~'.$insert_array['stay_e_date'].' 
예약일 : '.date("Y-m-d H:i").'
감사합니다.'
            );

            $this->sms->sendSimpleSms($arr);

            $this->response([
                'status' => TRUE,
                'message' => 'Insert Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Insert Failed'
            ]);
        }
    }

    //취소정책
    function cancelPolicy_get() {

        $result = $this->pension_m->cancelPolicy_get();
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

    //예약확인
    function reserveConfirm_get() {

        //현재 보고 있는 객실 idx값 
        $arrays = array(
            'reserve_name' => $this->input ->get('reserve_name', TRUE),         
            'reserve_phone' => $this->input ->get('reserve_phone', TRUE)         
        );

        $result = $this->pension_m->reserveConfirm_get($arrays);
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

    //예약취소
    function reserveCancel_get() {

        //현재 보고 있는 객실 idx값 
        $arrays = array(
            'idx' => $this->input ->get('idx', TRUE),                     
        );

        $result = $this->pension_m->reserveCancel_get($arrays);

        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Update Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Update Failed'
            ]);
        }
    }

    //팬션 예약 기본정보
    function reserveInfo_get() {

        $result = $this->pension_m->reserveInfo_get();
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

    //선택 객실 room_status 업데이트 
    //예약 2단계 진입 시 해당 객실 상태를 hold로 변경한다.
    //2단계 진입시마다 호출
    function roomStatusHold_get() {

        //현재 보고 있는 객실 idx값 
        $p_id = $this->input ->get('p_id', TRUE);
        $s_date = $this->input ->get('stay_s_date', TRUE);
        $e_date = $this->input ->get('stay_e_date', TRUE);

        $result = $this->pension_m->roomStatusHold($p_id, $s_date, $e_date);

        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Insert Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Insert Failed'
            ]);
        }
    } 

    //선택 객실 room_status 업데이트 
    //예약 2단계 진입 후 x버튼 눌러 나가는 경우와 예약조회 메뉴로 이동하는 경우 호출    
    function roomStatusHoldRelease_get() {

        //현재 보고 있는 객실 idx값 
        $p_id = $this->input ->get('p_id', TRUE);
        $s_date = $this->input ->get('stay_s_date', TRUE);
        $e_date = $this->input ->get('stay_e_date', TRUE);
        $result = $this->pension_m->roomStatusHoldRelease($p_id ,$s_date, $e_date);

        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Update Success',
                'result' => $result
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Update Failed'
            ]);
        }
    }



    //선택 날짜에 예약 가능한 팬션 객실 리스트 조회
    public function reserveRoomList_get(){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');


        /***************예약 가능 객실 정보 출력 시 가격 정보 체크  
        * 1.성수기 여부를 체크한다.
        * if) 성수기면
        *   어떤 성수기인지 체크 - 준성수기, 성수기, 극성수기
          
            예약일 다음날이 어떤 날인지 체크한다.
                if) 빨간날(법정-법정공휴일체크),일요일이면 주말 요금 

                else if) 토요일이면 금요일요금 적용

                else) 평일요금 적용


            else)성수기가 아니면 비수기 요금 적용

                예약일 다음날이 어떤 날인지 체크한다.
                if) 빨간날(법정-법정공휴일체크),일요일이면 주말 요금 

                else if) 토요일이면 금요일요금 적용

                else) 평일요금 적용
        **************************************************/

        //객실 상태를 업데이트 한다.
        //현재 시간 기준으로 10분이 경과한 row를 삭제한다.
        $roomStatus = $this->pension_m->roomStatusTimeChk();


        /********성수기여부 체크********/
        //숙박 선택된 첫번째 날짜의 가격정보 가져오기
        //2박 이상인 경우이고 첫째날은 평일, 두째날은 주말이어도 객실 리스트에는 첫째날 가격만 출력한다.

        $peakDate = date("Ymd", strtotime($this->input ->get('stay_s_date', TRUE)));
        $priceType = $this->pension_m->peakCheck($peakDate);

        
        /********예약 시작일 다음날 평일,금요일,주말체크********/            
        //예약 시작일 다음날이 어떤 날인지 체크
        
        $nextDay = date("Ymd", strtotime($this->input ->get('stay_s_date', TRUE)."+1 day"));

        //주말여부 체크
        //주말요금인 경우 (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일)
        $weekendChk = date("w", strtotime(substr($nextDay,0,8)));

        //선택한 다음 날 법정 휴무일 체크
        $chk_year = substr($nextDay,0,4);
        $chk_mon = substr($nextDay,4,2);
        $chk_day = (int)substr($nextDay,6,2);

        $holidayChk = $this->pension_m ->holidayCheck($chk_year,$chk_mon,$chk_day);


        
        //holiday_chk : ON->법정공휴일 X(빨간날 아님)
        //holiday_chk : OFF->법정공휴일 O(빨간날이므로 주말요금 적용)
        if($holidayChk){
            $holidayChk = 'ON';    
        }else{
            $holidayChk = 'OFF';    
        }

        
                
        //주말요금 적용(예약 다음날이 일요일, 법정 공휴일인 경우)
        //weekendType 01 : 주말 / 02:금요일 / 03:평일
        //주말요금인 경우 weekendChk (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일)
        
        $weekendType='';

        //주말요금
        if($holidayChk=='ON' || $weekendChk==0){

            $weekendType = '01';

        //금요일 요금(법정공휴일 아니고 다음날이 토요일인 경우)    
        }else if($holidayChk=='OFF' && $weekendChk==6){
            $weekendType = '02';    

        //평일 요금인 경우
        }else{
            $weekendType = '03';
        }

        
        //데이터가 있으면 성수기에 해당하는 경우
        //01:준성수기 / 02:성수기 / 03:극성수기 
        if($priceType){
            $priceType = $priceType->peak_type;
        }else{
            $priceType="04";
        }

        $arrays = array(
            'offset' => $this->input ->get('offset', TRUE),
            'limit' => $this->input ->get('limit', TRUE),
            'stay_s_date' => $this->input ->get('stay_s_date', TRUE),
            'stay_e_date' => $this->input ->get('stay_e_date', TRUE),
            'priceType' => $priceType,
            'weekendType' => $weekendType
        );
        
        $result = $this->pension_m->reserveRoomList_get($arrays);
        
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


    //부가서비스(옵션)리스트
    public function optionList_get(){

        $result = $this->pension_m->optionList_get();
        
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

    //실시간예약 선택 객실 요금 계산
    function totalSum_get(){

        //날짜 타입은 y-m-d로 받아야 한다.    
        $p_idx = $this->input ->get('pension_id', TRUE);
        $stay_s_date = $this->input ->get('stay_s_date', TRUE);
        $stay_e_date = $this->input ->get('stay_e_date', TRUE);

        //일수를 리턴한다.
        $stayDay = $this->stayDay($stay_s_date, $stay_e_date);

        //마지막 날짜는 계산에 필요 없으므로 하루를 뺀다.
        $stay_e_date = date("Y-m-d", strtotime($stay_e_date."-1 day"));

        $totalDateList = $this->createDateRangeArray($stay_s_date,$stay_e_date);

        $roomCharge=0;
            
        //날짜별 객실료 합산 계산
        for($i=0; $i<$stayDay; $i++){
            
            $roomCharge += $this-> dailyFee($p_idx, $totalDateList[$i]);
        }

        if($roomCharge>=0){
            $this->response([
                'status' => TRUE,
                'message' => 'Get List Success',
                'result' => $roomCharge
            ], REST_Controller::HTTP_OK);            
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'NO DATA'
            ]);
        }
     
    }

    //예약일에 속한 날짜별로 가격을 계산한다.
    //check-date : yyyy-mm-dd
    function dailyFee($p_idx, $check_date){

        //팬션 객실 가격 정보를 가져온다.
        $data['views'] = $this->pension_m->get_view($p_idx);

        //비수기
        $off_season_normal_fee = $data['views']->off_season_normal_fee;
        $off_season_friday_fee = $data['views']->off_season_friday_fee;
        $off_season_weekend_fee = $data['views']->off_season_weekend_fee;

        //준성수기
        $mid_season_normal_fee = $data['views']->mid_season_normal_fee;
        $mid_season_friday_fee = $data['views']->mid_season_friday_fee;
        $mid_season_weekend_fee = $data['views']->mid_season_weekend_fee;

        //성수기
        $peak_season_normal_fee = $data['views']->peak_season_normal_fee;
        $peak_season_friday_fee = $data['views']->peak_season_friday_fee;
        $peak_season_weekend_fee = $data['views']->peak_season_weekend_fee;

        //극성수기
        $high_peak_season_normal_fee = $data['views']->high_peak_season_normal_fee;
        $high_peak_season_friday_fee = $data['views']->high_peak_season_friday_fee;
        $high_peak_season_weekend_fee = $data['views']->high_peak_season_weekend_fee;


        //날짜 타입을 ymd로 변경/성수기 체크
        $peakDate = date("Ymd", strtotime($check_date));        
        $priceType = $this->pension_m->peakCheck($peakDate);

     
        //데이터가 있으면 성수기에 해당하는 경우
        //01:준성수기 / 02:성수기 / 03:극성수기  / 04:비수기
        if($priceType){
            $priceType = $priceType->peak_type;
        }else{
            $priceType="04";
        }

        /********선택 날자 다음날 평일,금요일,주말체크********/            
        //현재 날짜 다음날이 어떤 날인지 체크
        
        $nextDay = date("Ymd", strtotime($check_date."+1 day"));

        //주말여부 체크
        //주말요금인 경우 (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일)
        $weekendChk = date("w", strtotime(substr($nextDay,0,8)));

        //선택한 다음 날 법정 휴무일 체크
        $chk_year = substr($nextDay,0,4);
        $chk_mon = substr($nextDay,4,2);
        $chk_day = (int)substr($nextDay,6,2);


        $holidayChk = $this->pension_m ->holidayCheck($chk_year,$chk_mon,$chk_day);
        
        //holiday_chk : ON->법정공휴일 X(빨간날 아님)
        //holiday_chk : OFF->법정공휴일 O(빨간날이므로 주말요금 적용)
        if($holidayChk){
            $holidayChk = 'ON';    
        }else{
            $holidayChk = 'OFF';    
        }
                
        //주말요금 적용(예약 다음날이 일요일, 법정 공휴일인 경우)
        //weekendType 01 : 주말 / 02:금요일 / 03:평일
        //주말요금인 경우 weekendChk (1-월, 2-화,3-수, 4-목,5-금,6-토,0-일)
        
        $weekendType='';

        //주말요금
        if($holidayChk=='ON' || $weekendChk==0){

            $weekendType = '01';

        //금요일 요금(법정공휴일 아니고 다음날이 토요일인 경우)    
        }else if($holidayChk=='OFF' && $weekendChk==6){
            $weekendType = '02';    

        //평일 요금인 경우
        }else{
            $weekendType = '03';
        }
        
        $dailyCharge=0;

        //준성수기
        if($priceType=='01'){

          //주말
          if($weekendType=='01'){
            $dailyCharge = (int)$mid_season_weekend_fee;            
          }else if($weekendType=='02'){
            $dailyCharge = (int)$mid_season_friday_fee;         
          }else{
            $dailyCharge = (int)$mid_season_normal_fee;
          }

        //성수기   
        }else if($priceType=='02'){
          //주말
          if($weekendType=='01'){
            $dailyCharge = (int)$peak_season_weekend_fee;            
          }else if($weekendType=='02'){
            $dailyCharge = (int)$peak_season_friday_fee;         
          }else{
            $dailyCharge = (int)$peak_season_normal_fee;
          }
        
        //극성수기 
        }else if($priceType=='03'){
          //주말
          if($weekendType=='01'){
            $dailyCharge = (int)$high_peak_season_weekend_fee;            
          }else if($weekendType=='02'){
            $dailyCharge = (int)$high_peak_season_friday_fee;         
          }else{
            $dailyCharge = (int)$high_peak_season_normal_fee;
          }
        //비수기  
        }else{

          //주말
          if($weekendType=='01'){
            $dailyCharge = (int)$off_season_weekend_fee;            
          }else if($weekendType=='02'){
            $dailyCharge = (int)$off_season_friday_fee;         
          }else{
            $dailyCharge = (int)$off_season_normal_fee;
          }

        }        
        return $dailyCharge;       

    }
    
    //마지막 날을 제외하고 실제 계산해야할 박수를 가져온다.
    function stayDay($d1, $d2){
        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        $diff_secs = abs($d1 - $d2);

        return ceil($diff_secs / (3600 * 24));
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

    //휴무일 체크 시 날짜 한자리인데 앞에 '0'있는 경우 제거
    function fitHoliday($num){
        if($num < 10){
            $num = substr($num,1,1);
        }
        return $num;
    }
}
