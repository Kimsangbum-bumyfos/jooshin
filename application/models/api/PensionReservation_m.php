<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Customer_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function customer_put($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
        
        $insert_array = array(
            'title' => $arrays['title'],
            'contents' => $arrays['contents'],
            'user_name' => $arrays['user_name'],
            'user_email' => $arrays['user_email'],
            'user_phone' => $arrays['user_phone'],
            'ans_yn' => 'N',
            'reg_date' => date("Y-m-d H:i:s")
        );
            
        $result = $this->db->insert($arrays['table'], $insert_array);
        
        return $result;
     }
}