<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Service_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 용역 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE (title like "%' . $search_word . '%" OR contents like "%'.$search_word.'%")'." ";
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

    /**
    * 용역 등록
    */
    function insert($arrays) {        
        $result = $this->db->insert('tb_testing_service', $arrays);
        return $result;
    }

    /**
    * 용역 삭제
    */
    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    /**
    * 용역 수정
    */
    function modify($arrays) {

         //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'title' => $arrays['title'],
            'category' => $arrays['category'],
            'page_main' => $arrays['page_main'],
            'region' => $arrays['region'],
            'terms' => $arrays['terms'],
            'keyword' => $arrays['keyword'],
            'thumb_img' => $arrays['thumb_img'],
            'img_list' => $arrays['img_list'],
            'path' => $arrays['path'],
            'addr' => $arrays['addr'],
            'addr_detail' => $arrays['addr_detail'],
            'postcode' => $arrays['postcode'],
            'buyer' => $arrays['buyer'],
            'scale' => $arrays['scale'],
            'contents' => $arrays['contents'],
            's_date' => $arrays['s_date'],
            'e_date' => $arrays['e_date'],
            'open_yn' => $arrays['open_yn'],
            'modify_date' => date("Y-m-d H:i:s")
        );

        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
    }

    /*
        * 기존 이미지 명 로드
    */
    function modify_img($table, $id){
        $sql = "SELECT img_list FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
   
    /**
    * 용역 상세보기
    */
    function get_view($table, $id) {
       $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
       $query = $this->db->query($sql);
 
       // 게시물 내용 반환
       $result = $query->row();
 
       return $result;
     }
}