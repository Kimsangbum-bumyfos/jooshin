<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Service_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function serviceList($arr) {
        $category = $arr['category'];
        // $search_word = $arr['search_word'];
        $sword="";

        // if ($search_word != '') {        
        //     $sword .= " AND (title like '%$search_word%' OR sub_title like '%$search_word%')";
        // }

        if ($category != '') {
            // 카테고리
            $sword .=" AND category ='".$category."' ";
        }

       
        $start = ($arr['offset'] - 1) * $arr['limit'];
        $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];

        $sql = " SELECT * FROM tb_testing_service where open_yn='Y' " . $sword.$limit;
        $query = $this->db->query($sql);
        $list = $query->result();

        // 메뉴, 검색어에 따른 포스트 전체 갯수
        $sql_cnt = " SELECT * FROM tb_testing_service WHERE open_yn='Y' ".$sword;
        $query = $this->db->query($sql_cnt);  
        $total_count = $query->num_rows();

        if($list){
            $result = array('total_count' => $total_count, 'data' => $list);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;       
    }


    // 제품 게시물 상세보기
    function serviceView($idx) {
        
       //게시물 카운터를 증가시킨다.
       // $sql_cnt = "update tb_testing_service set view_cnt=view_cnt+1 WHERE idx=$idx";
       // $this->db->query($sql_cnt);


       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_testing_service WHERE idx=$idx AND open_yn='Y'";
       $query = $this->db->query($sql);
       $data = $query->result();


       $sql = "SELECT idx, title FROM tb_testing_service WHERE idx > $idx AND open_yn='Y' LIMIT 1";
       $query = $this->db->query($sql);
       $next_data = $query->result();
       $next_data = $next_data ? $next_data : 'NO DATA';

        $sql = "SELECT idx, title FROM tb_testing_service WHERE idx < $idx AND open_yn='Y' ORDER BY idx DESC LIMIT 1";
        $query = $this->db->query($sql);
        $prev_data = $query->result();
        $prev_data = $prev_data ? $prev_data : 'NO DATA';



       if($data){
           $result = array('data' => $data,
                            'next_data' => $next_data,
                            'prev_data' => $prev_data                     
                           );
       }else{
           $result = array('message' => 'NO DATA');
       }
       return $result;
    }   

    // 메인 노출 리스트(3개)
    function mainPageList() {
        $sql = " SELECT * FROM tb_testing_service where open_yn='Y' AND page_main='Y' ORDER BY reg_date DESC LIMIT 3 ";
        $query = $this->db->query($sql);
        $list = $query->result();

        if($list){
            $result = array('data' => $list);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;       
    }
}