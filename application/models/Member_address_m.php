<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Member_address_m extends CI_Model {
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
            $sword = ' WHERE address_title like "%' . $search_word . '%"' ;
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }

                
        //$sql = "SELECT * FROM " . $table . $sword .$limit_query;
        //공지유형 공통코드에서 가져오기 위해서 서브쿼리로 변경함
        $sql = " select * , (select count(*) from fr_address_member B where A.idx= B.idx ) as tot_cnt , (select count(*) from fr_address_member B where receive_mail_yn ='Y' and A.idx= B.idx ) as receive_yn from fr_address_book A  " . $sword .$limit_query;
 
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }

    /**
     * 게시물 입력
     * 
     * @param array $arrays 테이블 명, 게시물 제목, 게시물 내용 1차 배열
     * @return boolean 입력 성공여부
     */
    function insert($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');
      
        $insert_array = array(
            'address_title' => $arrays['address_title'],
            'reg_date' => date("Y-m-d H:i:s")
        );
            
        $result = $this->db->insert($arrays['table'], $insert_array);
        
        //주소록을 만들기 위해 방금 입력된 idx값을 가져온다.
        $member_idx = $this->db->insert_id();

        if($result){

            for($i=0; $i < count($arrays['member_list']); $i++) { 
               
               $member_array =explode("|",$arrays['member_list'][$i]);
               
               $insert_array = array(
                'idx' => $member_idx,
                'user_name' => $member_array[0],
                'user_email' => $member_array[1],
                'receive_mail_yn' => $member_array[2]
               );
              $result = $this->db->insert('fr_address_member', $insert_array);
            }  

        }        
        
        return $result;
    }

    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    function delete_address_all($table, $no) {
        $delete_array = array(
            'idx' => $no
        );

        $result = $this->db->delete($table, $delete_array);

        if($result){
           $result = $this->db->delete('fr_address_member', $delete_array);
        }        
        return $result;
    }

    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function modify($arrays) {

         //time존 설정
        date_default_timezone_set('Asia/Seoul');

         $modify_array = array(
            'address_title' => $arrays['address_title'],
            'modify_date' => date("Y-m-d H:i:s")
        );

        $where = array(
            'idx' => $arrays['idx']
        );

        $result = $this->db->update('fr_address_book', $modify_array, $where);
            

        if($result){

            $this ->delete('fr_address_member',$arrays['idx']);
          
            for($i=0; $i < count($arrays['member_list']); $i++) { 
               
               $member_array =explode("|",$arrays['member_list'][$i]);
               
               $insert_array = array(
                'idx' => $arrays['idx'],
                'user_name' => $member_array[0],
                'user_email' => $member_array[1],
                'receive_mail_yn' => $member_array[2]
               );
              $result = $this->db->insert('fr_address_member', $insert_array);
            }  

        }        

       return $result;
    }

    //맴버를 가져온다.
    function get_member_list() {
       
        $sql = "SELECT * FROM  fr_member where user_status ='Y' order by user_name asc";
        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> result();
 
        return $result;
     }


     //idx에 해당하는 이메일 수신목록을 가져온다.
    function get_address_list($idx) {
       
        $sql = "SELECT * FROM  fr_address_member where idx =  '" . $idx . "'  order by user_name asc";

        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> result();
 
        return $result;
     }



    /**
     * 게시물 상세보기 가져오기
     *
     * @param string $table 게시판 테이블
     * @param string $id 게시물 번호
     * @return array
     */
    function get_view($table, $id) {
        // 조횟수 증가
       // $sql0 = "UPDATE " . $table . " SET hits = hits + 1 WHERE board_id='" . $id . "'";
       // $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> row();
 
        return $result;
     }

 
}