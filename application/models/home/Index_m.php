<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Index_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 관리자 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function get_list_home() {

    //   $sql = "SELECT * FROM fr_posts order by idx desc limit 0,6";
         $sql = "SELECT * FROM fr_posts order by idx desc  ";
 
       $query = $this -> db -> query($sql);
      
       $result = $query -> result();
     
       return $result;
    }
}