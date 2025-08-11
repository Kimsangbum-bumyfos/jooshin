<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Product_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function productList($arr) {
        $search_word = $arr['search_word'];
        $depth_1 = $arr['depth_1'];
        $depth_2 = $arr['depth_2'];
        $depth_3 = $arr['depth_3'];
        $depth=" AND depth_1='".$arr['depth_1']."' ";
        $sword="";

        if ($search_word != '') {        
            // $sword .= " AND (title like '%$search_word%' OR model_name like '%$search_word%' OR manufacturer like OR sub_title like '%$search_word%' OR type like '%$search_word%' OR sensor_range like '%$search_word%')";
          $sword .= " AND (title like '%$search_word%' OR sub_title like '%$search_word%' OR model_name like '%$search_word%' OR manufacturer like '%$search_word%' OR type like '%$search_word%' OR sensor_range like '%$search_word%')";
            $depth = "";
        }
        // else{
        //     $sword .="";
        //     $depth = "";
        // }

        if($depth_2 != '')
            $depth .= " AND depth_2='".$depth_2."' ";
        if($depth_3 != '')
            $depth .= " AND depth_3='".$depth_3."' ";

       
        $start = ($arr['offset'] - 1) * $arr['limit'];
        $limit = 'ORDER BY idx ASC LIMIT '.$start.','.$arr['limit'];

        $sql = " SELECT 
                      idx, 
                      title, 
                      depth_1, 
                      depth_2, 
                      depth_3,
                      model_name,
                      manufacturer,
                      type,
                      sensor_range,
                      sensor_outline,
                      page_main,
                      thumb_img,
                      path,
                      open_yn
                       FROM tb_products where open_yn='Y' " . $sword.$depth.$limit;
        $query = $this->db->query($sql);
        $list = $query->result();

        // 검색어, 뎁스에 따른 상품 갯수
        $sql_cnt = " SELECT idx FROM tb_products WHERE open_yn='Y' ".$sword.$depth;
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
    function productView($idx) {
        
       //게시물 카운터를 증가시킨다.
       // $sql_cnt = "update tb_products set view_cnt=view_cnt+1 WHERE idx=$idx";
       // $this->db->query($sql_cnt);


       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_products WHERE idx=$idx AND open_yn='Y'";
       $query = $this->db->query($sql);
       $data = $query->result();


       $sql = "SELECT idx, title FROM tb_products WHERE idx > $idx AND open_yn='Y' LIMIT 1";
       $query = $this->db->query($sql);
       $next_data = $query->result();
       $next_data = $next_data ? $next_data : 'NO DATA';

        $sql = "SELECT idx, title FROM tb_products WHERE idx < $idx AND open_yn='Y' ORDER BY idx DESC LIMIT 1";
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
        $sql = " SELECT * FROM tb_products where open_yn='Y' AND page_main='Y' ORDER BY reg_date DESC LIMIT 3 ";
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