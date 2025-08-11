<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Header_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 관리자 리스트
     *@param array $auth 폼 전송받은 이름 , 아이디
     *@return array
     */
    function reservation_lists($type = '') {

        $sword = ' WHERE process_result = "N" ';
        $limit_query = ' ORDER BY IDX DESC';

        $sql = "SELECT * FROM reservation" . $sword .$limit_query;
        
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }

    function customer_lists($type = '') {

        $sword = ' WHERE board_type = "CUSTOMER" AND status = "N" ';
        $limit_query = ' ORDER BY IDX DESC';


        $sql = "SELECT * FROM fr_board" . $sword .$limit_query;
 
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }
}