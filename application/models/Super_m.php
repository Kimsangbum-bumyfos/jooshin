<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Super_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 관리자 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE auth_name like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT * FROM " . $table . $sword .$limit_query;
 
        $query = $this->db->query($sql);
 
        if ($type == 'count') {
            $result = $query->num_rows();
        } else {
            $result = $query->result();
        }
        return $result;
    }

    function id_chk($chk_id){

        $sql = " SELECT idx FROM tb_super" . " WHERE auth_id = '" . $chk_id . "'";
        $query = $this->db->query($sql);

        if($query->num_rows() >0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function email_chk($chk_email){

        $sql = " SELECT idx FROM tb_super" . " WHERE auth_email = '" . $chk_email . "'";
        $query = $this->db->query($sql);

        if($query->num_rows() >0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * 게시물 입력
     * 
     * @param array $arrays 테이블 명, 게시물 제목, 게시물 내용 1차 배열
     * @return boolean 입력 성공여부
     */
    function insert_auth($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');
        
        //패스워드 암호화 처리
        $this->load->library('encryption');
        $encrypted_passwd = $this->encryption->encrypt($arrays['auth_passwd']);

        $insert_array = array(
            'auth_name' => $arrays['auth_name'],
            'auth_id' => $arrays['auth_id'],
            'auth_email' => $arrays['auth_email'],
            'auth_passwd' => $encrypted_passwd,
            'use_yn' => $arrays['use_yn'],
            'reg_date' => date("Y-m-d H:i:s")
        );
            
        $result = $this->db->insert($arrays['table'], $insert_array);
        
        return $result;
    }

    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function modify($arrays) {
        
        //패스워드 암호화 처리
        $this->load->library('encryption');
        $encrypted_passwd = $this->encryption->encrypt($arrays['auth_passwd']);
        
        $modify_array = array(
           'auth_name' => $arrays['auth_name'],
           'auth_email' => $arrays['auth_email'],
           'auth_passwd' => $encrypted_passwd,
           'use_yn' => $arrays['use_yn']
        );
        
        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
    }
    function login($auth){

        $sql = "SELECT idx, auth_name,auth_passwd FROM tb_super WHERE auth_id ='" . $auth . "' and use_yn = 'Y' ";
        $query = $this->db->query($sql);

        if ($result = $query->row()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    //비밀번호 찾기 시 입력한 이메일이 있는지 확인 한다.
    function auth_email_chk($auth_email){

        $sql = " SELECT idx FROM tb_super WHERE auth_email ='" . $auth_email . "' and use_yn = 'Y' ";
        $query = $this->db->query($sql);

        $result = $query->num_rows();

        return $result;
    }

    //비번 재설성 메일 전송 후 유효 시간 체크를 위한 날짜/시간 업데이트
    function passwd_reset_send_date($auth_email){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'passwd_reset_date' => date("Y-m-d H:i:s"),
        );

        $where = array(
            'auth_email' => $auth_email
        );

        $result = $this->db->update('tb_super', $modify_array, $where);

        return $result;
    }

    //비밀번호 재설정 시 URL 전송 시점과 현재 시간이 유효한지 체크
    function reset_passwd_time_chk($auth_email){

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $sql = " SELECT idx FROM tb_super WHERE auth_email ='" . $auth_email . "' AND TIMESTAMPDIFF(MINUTE,passwd_reset_date,now()) < 15 ";
        $query = $this->db->query($sql);
        $result = $query->num_rows();

        return $result;
    }

    function reset_passwd_update($arrays){

        $modify_array = array(
            'auth_passwd' => $arrays['auth_passwd'],
        );

        $where = array(
            'auth_email' => $arrays['auth_email']
        );

        $result = $this->db->update($arrays['table'], $modify_array, $where);

        return $result;
    }

    /**
     * 오늘의 명언 가져오기(1개 랜덤)
     */
    function get_view() {
        $sql = " select * from tb_wise_saying order by rand() limit 1 ";
        $query = $this->db->query($sql);

        // 게시물 내용 반환
        $result = $query->row();

        return $result;
    }
    function get_data($id) {
        $sql = "SELECT * FROM tb_super WHERE idx=$id";
        $query = $this -> db -> query($sql);

        // 게시물 내용 반환
        $result = $query->row();

        return $result;
    }
 
}