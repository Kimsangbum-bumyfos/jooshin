<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Member_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

     function member_insert($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
        
//        $insert_array = array(
//            'user_name' => $arrays['user_name'],
//            'user_id' => $arrays['user_id'],
//            'user_phone' => $arrays['user_phone'],
//            'user_passwd' => $arrays['user_passwd'],
//            'agreement' => $arrays['agreement'],
//            'status' => 'Y',
//            'reg_date' => date("Y-m-d H:i:s")
//        );
        $arrays['status'] = 'Y';
        $arrays['reg_date'] = date('Y-m-d H:i:s');
            
        $result = $this->db->insert('tb_member', $arrays);
        return $result;          
     }

     function getData($idx) {
        $sql = "SELECT user_name, user_id, user_phone, agreement, sns_type FROM tb_member WHERE idx=$idx";
        $query = $this->db->query($sql);
        $data = $query->result();

         if($data){
             $result = array('data'=>$data);
         }else {
             $result = array('message' => 'NO DATA');
         }

         return $result;
     }

     //비번 재설성 메일 전송 후 유효 시간 체크를 위한 날짜/시간 업데이트
      function member_modify($arrays){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'user_name' => $arrays['user_name'],
            'user_phone' => $arrays['user_phone'],
            'user_passwd' => $arrays['user_passwd'],
            'agreement' => $arrays['agreement'],
            'modi_date' => date("Y-m-d H:i:s"),
        );
        
        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update('tb_member', $modify_array, $where);

        return $result;
      }

      function idDuplChk($user_id) {

        //board type에 해당하는 전체 카운터 리턴
        $sql_cnt = " SELECT idx, sns_type FROM tb_member WHERE user_id = '$user_id' LIMIT 1";
        $query = $this->db->query($sql_cnt);  
        $result = $query->result();

        return $result;

      }

    function idDuplChkSns($sns_id, $sns_type) {

        $sql_cnt = " SELECT idx FROM tb_member WHERE sns_id='$sns_id' AND sns_type='$sns_type' LIMIT 1";
        $query = $this->db->query($sql_cnt);
        $result = $query->result();

        return $result;

    }

      function findID($arrays) {

        $user_name = $arrays['user_name']; 
        $user_phone = $arrays['user_phone'];

        $sql = " SELECT user_id, sns_type FROM tb_member WHERE user_name = '".$user_name."' and user_phone = '".$user_phone."' " ;
        $query = $this->db->query($sql);
        $result = $query->result();
        
        return $result;
      }    

      function findPasswd($arrays) {

        $user_name = $arrays['user_name']; 
        $user_id = $arrays['user_id'];
        
        //board type에 해당하는 전체 카운터 리턴
        $sql = " SELECT idx, sns_type FROM tb_member WHERE user_name = '".$user_name."' and user_id = '".$user_id."' " ;
        $query = $this->db->query($sql);
        
        $result = $query->result();

        return $result;
      }

      //비번 재설성 메일 전송 후 유효 시간 체크를 위한 날짜/시간 업데이트
      function passwd_reset_send_date($user_id){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'passwd_reset_date' => date("Y-m-d H:i:s"),
        );
        
        $where = array(
            'user_id' => $user_id
        );
        
        $result = $this->db->update('tb_member', $modify_array, $where);

        return $result;
      }

      //비밀번호 재설정 시 URL 전송 시점과 현재 시간이 유효한지 체크
      function reset_passwd_time_chk($user_id){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');
        
        $sql = " SELECT * FROM tb_member WHERE user_id ='" . $user_id . "' AND TIMESTAMPDIFF(MINUTE,passwd_reset_date,now()) < 15 ";
        $query = $this->db->query($sql);
        $result = $query->num_rows();

        return $result;
      }

    function reset_passwd_update($arrays){

        $modify_array = array(
            'user_passwd' => $arrays['user_passwd'],
        );
        $where = array(
            'user_id' => $arrays['user_id']
        );

        $result = $this->db->update($arrays['table'], $modify_array, $where);

        return $result;
    }

    function login($user_id) {
        $sql = "SELECT idx, user_name, user_phone, user_passwd FROM tb_member WHERE user_id='$user_id'";
        $query = $this->db->query($sql);
        $row = $query->row();

        if($row) {
            return $row;
        }else {
            return FALSE;
        }
    }
    function loginWithSns($sns_type, $sns_id) {
        $sql = "SELECT idx, user_name, user_phone FROM tb_member WHERE sns_type='$sns_type' AND sns_id='$sns_id'";
        $query = $this->db->query($sql);
        $row = $query->row();

        if($row) {
            return $row;
        }else {
            return FALSE;
        }
    }

    function getPass($idx) {
        $sql = "SELECT user_passwd FROM tb_member WHERE idx=$idx LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->row();

        if($row) {
            return $row;
        }else {
            return FALSE;
        }
    }
}