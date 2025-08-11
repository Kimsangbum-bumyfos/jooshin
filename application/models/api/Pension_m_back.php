<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Pension_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function pensionList_get($arr) {
        
        $offset = $arr['offset'];
        $limit = $arr['limit'];

        $sword = '';
        $limit_query = '';

        
        //현재 페이지를 받아서 Limit START를 설정한다.
        if ($offset > 1) {
            $start = ($offset - 1) * $limit;
        } else {
            $start = 0;
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $start . ', ' . $limit;
        }

        $sql = " SELECT idx,
                        name,                        
                        p_thumb_img,
                        path
                        FROM tb_pension_room_info
                        WHERE open_yn='Y' ". $sword . $limit_query;

        $query = $this->db->query($sql);
        $list = $query->result();

        if($list){
          $result = array('page'=> $offset, 'data'=>$list);
        }else{
          $result = array('message' => 'NO DATA');
        }      
        return $result;
    }

    function detail_get($idx) {

        //해당 객실의 조회수를 증가한다.
        $sql_cnt = " UPDATE tb_pension_room_info SET view_cnt = view_cnt + 1 WHERE idx='" . $idx . "'";
        $this -> db -> query($sql_cnt);

        $sql = "SELECT * FROM tb_pension_room_info WHERE idx = $idx AND open_yn='Y'";
        $query = $this->db->query($sql);
        $data = $query->result();
        if($data){
            $result = array('data' => $data);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;
    }
  
    //객실정보 조회 시 룸 상태를 업데이트 한다.
    //hold중에 10분이 경과한 것을 업데이트한다.
    function roomStatusTimeChk(){

       //현재 시간 기준으로 10분이 경과한 객실의 hold를 업데이트한다.
        // $sql = " UPDATE tb_pension_room_info SET room_status = NULL where room_status='hold' and TIMESTAMPDIFF(MINUTE,room_status_expires_time,now()) > 10 ";
        
        //객실 조회 시 10분 이상 경과된 내역은 삭제한다.
        $sql = " delete from tb_pension_room_status where TIMESTAMPDIFF(MINUTE,room_status_expires_time,now()) > 10 ";
        $this -> db -> query($sql);
    }

    //객실 2단계 진입 시 해당 객실의 상태 테이블을에 객실아이디, 숙박 시작,종료일 업데이트.
    //예약일에 해당하는 날짜를 셋팅한다. 
    //나중에 다른 사람이 다른 날짜를 검색하는 경우에는 해당 룸이 나와야 한다.
    function roomStatusHold($idx,$s_date,$e_date){

      //time존 설정
      date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'pension_id' => $idx,
            'room_status' => 'hold',
            'room_status_expires_time' => date("Y-m-d H:i:s"),            
            'stay_s_date' => $s_date,
            'stay_e_date' => $e_date                 
        );

        // $where = array(
        //     'idx' => $idx
        // );
        
        $result = $this->db->insert('tb_pension_room_status', $modify_array);
        
        return $result;
    }

    //객실 2단계 진입 후 나가거나 메뉴 이동하는 경우
    function roomStatusHoldRelease($idx,$s_date,$e_date){

      //time존 설정
      date_default_timezone_set('Asia/Seoul');

        // $modify_array = array(
        //     'room_status' => NULL,
        //     'status_s_date' => NULL,
        //     'status_e_date' => NULL
        // );
        
        // $where = array(
        //     'idx' => $idx
        // );
      $sql = " delete from tb_pension_room_status where pension_id ='" . $idx . "'and stay_s_date =date_format('" . $s_date ."','%Y-%m-%d') and  stay_e_date =date_format('" . $e_date ."','%Y-%m-%d') ";
        
      $result = $this -> db -> query($sql);
        
      //$result = $this->db->update('tb_pension_room_info', $modify_array, $where);
        
      return $result;
    }

    function relatedList_get($arr) {

      $idx = $arr['idx'];
      $tags = $arr['tags'];      

      $sql = " SELECT idx,
                       name,                        
                       p_thumb_img,
                       path FROM tb_pension_room_info WHERE open_yn ='Y' AND idx not IN ('" . $idx . "') order by rand() LIMIT 4";

      $q = $this->db->query($sql);
      $data = $q->result();
      if($data){
          $result = array('data' => $data);
      }else{
          $result = array('message' => 'NO DATA');
      }

      return $result;
    }

     //예약확인
    function cancelPolicy_get() {

      $sql = " select p_value from tb_pension_basic_info where p_key ='contents2' ";

      $q = $this->db->query($sql);
      $data = $q->result();
      if($data){
          $result = array('data' => $data);
      }else{
          $result = array('message' => 'NO DATA');
      }

      return $result;
    }

    //예약확인
    function reserveConfirm_get($arr) {

      $reserve_name = $arr['reserve_name'];
      $reserve_phone = $arr['reserve_phone'];

      $sql = " SELECT *, (select A.p_thumb_img from tb_pension_room_info A where B.pension_id = A.idx ) as p_thumb_img, (select A.path from tb_pension_room_info A where B.pension_id = A.idx ) as path FROM tb_pension_reservation B WHERE reserve_name ='" . $reserve_name . "' AND reserve_phone = '" . $reserve_phone . "' ";

      $q = $this->db->query($sql);
      $data = $q->result();
      if($data){
          $result = array('data' => $data);
      }else{
          $result = array('message' => 'NO DATA');
      }

      return $result;
    }

    //예약취소
    function reserveCancel_get($arr) {

      $modify_array = array(
          'reserve_status' => 'cancel_doing',
          'cancel_date' => date("Y-m-d H:i:s")
      );      

      $where = array(
        'idx' => $arr['idx']
      );
      
      $result = $this->db->update('tb_pension_reservation', $modify_array, $where);
      
      return $result;
    }

    //팬션 예약 기본정보
    function reserveInfo_get() {
        $sql = " SELECT * FROM tb_pension_basic_info ";
        $sql2 = "SELECT * FROM tb_pension_option WHERE use_yn='Y'";

        $query = $this->db->query($sql);
        $data = $query->result();

        if($data){
            $query = $this->db->query($sql2);
            $data_option = $query->result();

            $result = array('data' => $data, 'data_option' => $data_option);
        }else{
            $result = array('message' => 'NO DATA');
        }
        return $result;
    }

    function totalSum_get($idx) {
        
       //게시물 카운터를 증가시킨다.
       $sql_cnt = "update tb_board set view_cnt=view_cnt+1 where idx= '" . $idx . "' ";
       $this->db->query($sql_cnt);

       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_board WHERE idx = '" . $idx . "' order by  idx desc";           
       $query = $this->db->query($sql);
 
       $result = $query->result();
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
      $data = $result['m'.$mon];
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

    function get_view($idx) { 

      $sql = "SELECT * FROM tb_pension_room_info WHERE idx = '" . $idx . "'";
      $query = $this->db->query($sql);

      // 게시물 내용 반환
      $result = $query->row();

      return $result;
    }

    //예약 첫번째 날이 성수기인지 체크한다.
    function peakCheck($check_date){

      $sql = " SELECT peak_type FROM tb_pension_peak where DATE_FORMAT(s_date ,'%Y%m%d')  <= STR_TO_DATE (".$check_date.",'%Y%m%d') and STR_TO_DATE (".$check_date.",'%Y%m%d') <= DATE_FORMAT(e_date ,'%Y%m%d') ";

      $query = $this->db->query($sql);

      $result = $query->row();
      return $result;
    }

    //선택날짜 가능 객실 리스트 조회
    function reserveRoomList_get($arr) {

        $offset = $arr['offset'];
        $limit = $arr['limit'];
        $stay_s_date = $arr['stay_s_date'];
        $stay_e_date = $arr['stay_e_date'];

        $priceType = $arr['priceType'];
        $weekendType = $arr['weekendType'];

        $limit_query = '';
        
        //현재 페이지를 받아서 Limit START를 설정한다.
        if ($offset > 1) {
            $start = ($offset - 1) * $limit;
        } else {
            $start = 0;
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $start . ', ' . $limit;
        }

        //예약테이블에서 검색 기간 중에 예약이 완료된 객실은 제외한다.
        $sql = " select pension_id from tb_pension_reservation where date_format('" . $stay_s_date ."','%Y-%m-%d') < date_format(stay_e_date, '%Y-%m-%d') 
and date_format('".$stay_e_date ."','%Y-%m-%d') > date_format(stay_s_date, '%Y-%m-%d') and reserve_status != 'cancel_done' " ;
        
        $query = $this->db->query($sql);
        $list = $query->result();

        $roomIdx ="";
        
        //제외 객실 idx 값 가져오기
        if($list){
          foreach($list as $lt){

            $roomIdx .=  $lt->pension_id.","; 

          }
          //마지막 ',' 잘라내기
          $result = substr($roomIdx , 0, -1);

        }else{
          $result = '000';
        }

        //예약홀드 관리 테이블에서  검색 기간 중에 10분 미만인 룸 정보는 검색 시 제외한다.(누군가 예약중)
        $sql = " select pension_id from tb_pension_room_status where date_format('" . $stay_s_date ."','%Y-%m-%d') < date_format(stay_e_date, '%Y-%m-%d') 
and date_format('".$stay_e_date ."','%Y-%m-%d') > date_format(stay_s_date, '%Y-%m-%d') and TIMESTAMPDIFF(MINUTE,room_status_expires_time,now()) < 10   " ;

        $query = $this->db->query($sql);
        $list = $query->result();

        $sQuery ="";
        $roomIdx2="";        
        //제외 객실 idx 값 가져오기
        if($list){
          foreach($list as $lt){

            $roomIdx2 .=  $lt->pension_id.","; 

          }
          //마지막 ',' 잘라내기
          $result2 = substr($roomIdx2 , 0, -1);
          $sQuery =" and idx not in (".$result2.") ";
        }
  
        //가격정보
        $selectNm = '';

        //준성수기
        if($priceType=='01'){

          //주말
          if($weekendType=='01'){
            $selectNm = 'mid_season_weekend_fee';            
          }else if($weekendType=='02'){
            $selectNm = 'mid_season_friday_fee';         
          }else{
            $selectNm = 'mid_season_normal_fee';
          }

        //성수기   
        }else if($priceType=='02'){
          //주말
          if($weekendType=='01'){
            $selectNm = 'peak_season_weekend_fee';            
          }else if($weekendType=='02'){
            $selectNm = 'peak_season_friday_fee';         
          }else{
            $selectNm = 'peak_season_normal_fee';
          }
        
        //극성수기 
        }else if($priceType=='03'){
          //주말
          if($weekendType=='01'){
            $selectNm = 'high_peak_season_weekend_fee';            
          }else if($weekendType=='02'){
            $selectNm = 'high_peak_season_friday_fee';         
          }else{
            $selectNm = 'high_peak_season_normal_fee';
          }
        //비수기  
        }else{

          //주말
          if($weekendType=='01'){
            $selectNm = 'off_season_weekend_fee';            
          }else if($weekendType=='02'){
            $selectNm = 'off_season_friday_fee';         
          }else{
            $selectNm = 'off_season_normal_fee';
          }

        }
        $sql = " select idx,name,space, fixed_number,max_number,p_desc,p_thumb_img,path,p_img01, p_img02,p_img03,p_img04,p_img05,p_options,additional_fee,".$selectNm." price from tb_pension_room_info where open_yn='Y' and idx not in (".$result.")" . $sQuery . $limit_query;
        
        $q = $this->db->query($sql);
        $data = $q->result();
        if($data){
            $result = array('data' => $data);
        }else{
            $result = array('message' => 'NO DATA');
        }
        return $result;
    }

    //부가서비스(옵션)리스트
    function optionList_get() {

      $sql = " SELECT * FROM tb_pension_option where use_yn ='Y' ";

      $q = $this->db->query($sql);
      $data = $q->result();
      if($data){
          $result = array('data' => $data);
      }else{
          $result = array('message' => 'NO DATA');
      }

      return $result;
    }


    //예약정보 저장
    function reserveInsert($arr, $option_arrays){

      $opt_cnt=0;
      $opt_arrays='';

      $pension_id = $arr['pension_id']; 

      if($option_arrays !='') {
        $opt_arrays = explode('/',$option_arrays);
        $opt_cnt = count($opt_arrays);  
      }
     

      //부가서비스 있는 경우 트랜잭션 처리
      if($opt_cnt>0){

        //트랜잭션 처리 , 예약정보와 옵션(부가서비스 정보가 정상 적으로 등록된 경우 커밋)
        
        $this->db->trans_start();

        $result = $this->db->insert('tb_pension_reservation', $arr);
        $reserve_idx = $this->db->insert_id();

        //예약정보 입력완료
        if($result){          

          for($i=0; $i<$opt_cnt; $i++){

            $str_opt = explode(',',$opt_arrays[$i]);

            $data = array(
                'reserve_id' => $reserve_idx,
                'option_id' => $str_opt[0],
                'qty' => $str_opt[1],
                'reg_date' => date('Y-m-d H:i:s')                
            );              

            //부가서비스 개수만큼 처리한다.
            $result = $this->db->insert('tb_pension_option_reservation', $data);            
          }
            //해당 객실의 룸 상태를 hold에서 NULL로 변경한다.
            // $sql_cnt = " UPDATE tb_pension_room_info SET room_status = NULL WHERE idx='" . $pension_id . "'";
            // $this -> db -> query($sql_cnt);
            $this->db->trans_complete();

        }                       

      }else{
        $result = $this->db->insert('tb_pension_reservation', $arr);        
        
        //해당 객실의 룸 상태를 hold에서 NULL로 변경한다.
        // $sql_cnt = " UPDATE tb_pension_room_info SET room_status = NULL WHERE idx='" . $pension_id . "'";
        // $this -> db -> query($sql_cnt);
      }

      return $result;
    }
}      