<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	* 실시간 예약 헤더 관리(자동차)
	*@param type : count가 필요한 경우 
	**/

    function get_reserve($type = ''){

    	$ci=& get_instance();
	    $ci->load->database(); 

	    $sql = "SELECT * FROM tb_reservation WHERE process_result ='N' ORDER BY idx DESC LIMIT 5 "; 
	    $query = $ci->db->query($sql);

	    if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
     //    return $result;
	    // $row = $query->num_rows();
	    // //return $row;
	    return $result;
    }

    /**
	* 고객센터 헤더 관리
	*@param type : count가 필요한 경우  
	**/

    function get_customer($type = ''){

    	$ci=& get_instance();
	    $ci->load->database(); 

	    $sql = "SELECT * FROM tb_inquire WHERE feedback_yn ='N' ORDER BY idx DESC LIMIT 5 ";
	    $query = $ci->db->query($sql);

	    if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }

    /**
	* 실시간 예약 헤더 관리(자동차)
	*@param type : count가 필요한 경우 
	**/

    function get_pension_Reserve($type = ''){

    	$ci=& get_instance();
	    $ci->load->database(); 

	    $sql = "SELECT * FROM tb_pension_reservation WHERE confirm_result ='doing' ORDER BY idx DESC LIMIT 5 "; 
	    $query = $ci->db->query($sql);

	    if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
     //    return $result;
	    // $row = $query->num_rows();
	    // //return $row;
	    return $result;
    }
?>