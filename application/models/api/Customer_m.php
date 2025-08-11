<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Customer_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    //고객센터 1:1문의 하기
    function customer_put($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
        
        $insert_array = array(
            'title' => $arrays['title'],
            'contents' => $arrays['contents'],
            'name' => $arrays['name'],
            'phone' => $arrays['phone'],
            'email' => $arrays['email'],
            'feedback_yn' => $arrays['feedback_yn'],
            'reg_date' => date("Y-m-d H:i:s")
        );
            
        $result = $this->db->insert($arrays['table'], $insert_array);
        
        return $result;
     }

    // function customer_get() {
        
    //     $sql = " SELECT * FROM tb_customer where feedback_yn = 'N' order by  idx desc ";    
      
    //     $query = $this -> db -> query($sql);
 
    //     $result = $query -> result();
    //     return $result;
    // }
 
}