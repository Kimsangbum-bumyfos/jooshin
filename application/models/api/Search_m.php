<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Search_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function lists($arr) {
    	$search_word = $arr['search_word'];
        $sword="";

    	if ($search_word != '') {        
            // $sword .= " AND (title like '%$search_word%' OR model_name like '%$search_word%' OR manufacturer like '%$search_word%' OR sub_title like '%$search_word%' OR type like '%$search_word%' OR sensor_range like '%$search_word%')";
            $sword .= " AND (title like '%$search_word%' OR sub_title like '%$search_word%' OR model_name like '%$search_word%' OR manufacturer like '%$search_word%' OR type like '%$search_word%' OR sensor_range like '%$search_word%')";
        }

        $start = ($arr['offset'] - 1) * $arr['limit'];
        $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];


        $sql = " SELECT * FROM tb_products where open_yn = 'Y' " .$sword.$limit;
        $query = $this -> db -> query($sql);
        $list = $query -> result();



        //  전체 갯수
        $sql_cnt = " SELECT * FROM tb_products WHERE open_yn='Y' ".$sword;
        $query = $this->db->query($sql_cnt);  
        $total_count = $query->num_rows();


        if($list){
            $result = array('total_count' => $total_count, 'data' => $list);
        }else{
            $result = array('message' => 'NO DATA');
        }


        return $result;
    }    
}