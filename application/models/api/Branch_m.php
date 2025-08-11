<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Branch_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function branch_all_get() {
        
        $sql = " SELECT * FROM tb_branch where open_yn = 'Y' order by idx desc ";
      
        $query = $this -> db -> query($sql);
 
        $result = $query -> result();
        return $result;
    }

    function branch_get($idx) {
        
        $sql = "SELECT * FROM tb_branch WHERE idx = '" . $idx . "' and open_yn = 'Y' order by  idx desc";
      
        $query = $this -> db -> query($sql);
 
        $result = $query -> result();
        return $result;
     }

     function list_get($arr) {
        if($arr['for'] == 'reservation') {
            $sql = "SELECT idx, branch_name FROM tb_branch WHERE open_yn='Y'";
            $q = $this->db->query($sql);
            $list = $q->result();
            $total_count = '';
        } else {
            $where = '';
            if($arr['search_word'] != '') {
                $where = "AND branch_name like '%".$arr['search_word']."%'";
            }
            $start = ($arr['offset'] - 1) * $arr['limit'];
            $limit = " ORDER BY IDX DESC LIMIT ".$start.", ".$arr['limit'];
            $sql = "SELECT idx,
                               branch_name,
                               addr_code,
                               addr,
                               addr2,
                               office_tel,
                               office_phone,
                               office_fax,
                               business_hours,
                               additional_comment,
                               additional_comment2,
                               map_comment,
                               thumb_img,
                               path
                               FROM tb_branch 
                               WHERE open_yn='Y'".$where.$limit;
            $q = $this->db->query($sql);
            $list = $q->result();

            // 전체 갯수
            $sql_cnt = " SELECT * FROM tb_branch WHERE open_yn ='Y' ".$where ;
            $query = $this->db->query($sql_cnt);  
            $total_count = $query->num_rows();
        }
        
         if($list){
             $result = array('total_count'=>$total_count, 'data'=>$list);
         }else {
             $result = array('message' => 'NO DATA');
         }

         return $result;
     }
}