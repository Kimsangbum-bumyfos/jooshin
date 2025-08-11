<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Pension_reservation_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 실시간예약 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE reserve_name like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT * FROM " . $table . $sword .$limit_query;
 
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }

    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function modify($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
   
        $modify_array = array(
            'total_sum' => $arrays['total_sum'], 
            'total_sum_desc' => $arrays['total_sum_desc'],  
            'reserve_status' => $arrays['reserve_status'],  
            'payment_status' => $arrays['payment_status'],  
            'confirm_result' => $arrays['confirm_result'],  
            'confirm_result_memo' => $arrays['confirm_result_memo'],  
            'submit_date' => date("Y-m-d H:i:s")
        );
        
        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
    }

    function delete($table, $no) {
       
        $delete_array = array(
            'idx' => $no
        );

        $result = $this->db->delete($table, $delete_array);

        return $result;
    }
    
    //예약확인 가격정보 : 이용요금, 부가서비스, 추가인원
    function get_roomCharge($idx){

        
        //아이디에 해당하는 정보 가져오기
        $sql = " SELECT pension_id, additional_number,stay_s_date,stay_e_date FROM tb_pension_reservation WHERE idx = '" . $idx . "'";
        $query = $this -> db -> query($sql);
        $result = $query -> row();
        
        $pension_id = $result -> pension_id;
        $additional_number = $result -> additional_number;
        $stay_s_date = $result -> stay_s_date;
        $stay_e_date = $result -> stay_e_date;

        //날짜에 해당하는 객실 이용료 합산 정보 가져오기
       
        $arr = array('p_id' => $pension_id,
                'stay_s_date' => $stay_s_date,
                'stay_e_date' => $stay_e_date
        );

        //객실 이용료 합산
        $roomTotPrice = $this -> totalSum_get($arr);
        
        //객실 가격정보 가져와서 인원추가 비용 계산
        $sql_room = " SELECT * FROM tb_pension_room_info WHERE idx = '" . $pension_id . "'";
        $query = $this -> db -> query($sql_room);
        $result_room = $query -> row();

        $p_name = $result_room -> name;        
        $additional_fee = $result_room -> additional_fee;
        
        $addTotPrice = (int)$additional_fee * (int)$additional_number;


        $result = array('addTotPrice' => $addTotPrice,
            'roomTotPrice' => $roomTotPrice,
            'additional_fee' => $additional_fee
        );

        return $result;       

    }

    function get_OptCharge($idx){

        //예약정보 가져오기
        // 팬션아이디에 해당하는 s,e 데이타 넣어서 팬션 합계 가져오기
        // 추가인원 수 계산하기
        // 부가서비스 합산하기

        //부가서비스 정보
        // $sql_opt = " SELECT pension_id, additional_number,stay_s_date,stay_e_date FROM tb_pension_option_reservation WHERE idx = '" . $idx . "'";
        //$query = $this -> db -> query($sql_opt);

        //부가서비스 계산
        //아이디에 해당하는 정보 가져오기
        $optTotPrice = 0;
        $optListArrs = '';

        $sql_opt = " select A.option_id, A.qty, (select B.option_unit_price from tb_pension_option  B where A.option_id = B.idx) as price ,(select B.name from tb_pension_option  B where A.option_id = B.idx) as opt_name from tb_pension_option_reservation A where A.reserve_id ='" . $idx . "' ";

        $query = $this -> db -> query($sql_opt);
        $result = $query -> num_rows();

        if($result >0){            
            foreach ($query -> result() as $row) {
               
                $optTotPrice += (int)$row->price * (int)$row->qty;            
            }         
        }        
        return $optTotPrice; 
    }

     //예약 첫번째 날이 성수기인지 체크한다.
    function peakCheck($check_date){

      $sql = " SELECT peak_type FROM tb_pension_peak where DATE_FORMAT(s_date ,'%Y%m%d')  <= STR_TO_DATE (".$check_date.",'%Y%m%d') and STR_TO_DATE (".$check_date.",'%Y%m%d') <= DATE_FORMAT(e_date ,'%Y%m%d') ";

      $query = $this->db->query($sql);

      $result = $query->row();
      return $result;
    }

    //예약 기간이 휴무일 체크한다.
    function holidayCheck($year, $mon, $day){

      //time존 설정
      date_default_timezone_set('Asia/Seoul');

      $sql = " SELECT holiday_data FROM tb_pension_holiday where use_yn ='Y' and year = '" . $year . "' ";
      
      $query = $this->db->query($sql);
      $result = $query->row(); 

      //DB 결과값을 가져온다.      
      $result = $result->holiday_data;

      $result = (array)json_decode($result);

      $data = trim($result['m'.$mon]);
      $day= trim($day);

      //해당월에 데이터가 없는 경우 
      if(empty($data)){
        return FALSE;
      }else if(stripos($data,$day) !== false){
        return TRUE;  
      }else{
        return FALSE;        
      }
    }

    /**
     * 게시물 상세보기 가져오기
     *
     * @param string $table 게시판 테이블
     * @param string $id 게시물 번호
     * @return array
     */
    function get_view($table, $idx) {
        // 조횟수 증가
       // $sql0 = "UPDATE " . $table . " SET hits = hits + 1 WHERE board_id='" . $id . "'";
       // $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $idx . "'";
        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> row();
 
        return $result;
    }


    /***************************객실요금계산로직*************************************/

    //실시간예약 선택 객실 요금 계산
    function totalSum_get($arrays){

        //날짜 타입은 y-m-d로 받아야 한다.    
        $p_idx = $arrays['p_id'];
        $stay_s_date = $arrays['stay_s_date'];
        $stay_e_date = $arrays['stay_e_date'];


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

        return $roomCharge;
     
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

    //예약일에 속한 날짜별로 가격을 계산한다.
    //check-date : yyyy-mm-dd
    function dailyFee($p_idx, $check_date){

        //팬션 객실 가격 정보를 가져온다.
        $data['views'] = $this->get_view('tb_pension_room_info',$p_idx);

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
        $priceType = $this->peakCheck($peakDate);

     
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

        $holidayChk = $this->holidayCheck($chk_year,$chk_mon,$chk_day);
        
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
 
}