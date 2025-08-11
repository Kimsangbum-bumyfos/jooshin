<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Car_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function carList_get($arr) {
        $car_type = $arr['car_type']; 
        $offset = $arr['offset'];
        $limit = $arr['limit'];

        $sword = '';
        $limit_query = '';

        if ($car_type != '') {
          // 검색어 있을 경우
          $sword =" AND car_type ='".$car_type."' ";
        }

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
                        car_name,
                        rental_fee_consultation_inquiry,
                        rental_fee,
                        rental_fee_12,
                        rental_opt,
                        thumb_img,
                        popular_car,
                        path
                        FROM tb_car
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
        $sql = "SELECT * FROM tb_car WHERE idx = $idx AND open_yn='Y'";
        $query = $this->db->query($sql);
        $data = $query->result();
        if($data){
            $result = array('data' => $data);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;
    }

    function popularList_get() {
        $sql = "SELECT idx, car_name, rental_fee, thumb_img, path FROM tb_car
                WHERE open_yn='Y' AND popular_car='1'";
        $q = $this->db->query($sql);
        $data = $q->result();
        if($data){
            $result = array('data' => $data);
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

    //예약 기간이 성수기인지 체크한다.
    function peakCheck($check_date, $count){

      $sql = " SELECT peak_type FROM tb_peak where DATE_FORMAT(s_date ,'%Y%m%d')  <= STR_TO_DATE ('".$check_date."','%Y%m%d') and STR_TO_DATE ('".$check_date."','%Y%m%d') <= DATE_FORMAT(e_date ,'%Y%m%d') ";

      $query = $this->db->query($sql);

      if($count == 'count'){
        $result = $query->num_rows();        
      }else{
        $result = $query->row();     
      }

      return $result;
    }

    //예약 기간이 휴무일 체크한다.
    function holidayCheck($year, $mon, $day){

      $sql = " SELECT holiday_data FROM tb_holiday where use_yn ='Y' and year = '" . $year . "' ";
      
      $query = $this->db->query($sql);
      $result = $query->row(); 

      //DB 결과값을 가져온다.      
      $result = $result->holiday_data;

      $result = (array)json_decode($result);
      
      $data = trim($result[$mon]);
      $day= trim($day);

      if(stripos($data,$day)===false){
        return FALSE;
      }else{
        return TRUE;
      }      
    }

    function get_view($car_idx) { 

      $sql = "SELECT * FROM tb_car WHERE idx = '" . $car_idx . "'";
      $query = $this->db->query($sql);

      // 게시물 내용 반환
      $result = $query->row();

      return $result;
    }
}