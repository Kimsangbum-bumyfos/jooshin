<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class MainSlide_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 팝업 관리 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE title like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT idx,
                       title,
                       path,
                       pc_img,
                       open_yn,
                       order_no,
                       reg_date
                       FROM " . $table . $sword .$limit_query;
 
        $query = $this->db->query($sql);

        if ($type == 'count') {
            $result = $query->num_rows();
        } else {
            $result = $query->result();
        }

        return $result;
    }

    /**
     * 게시물 입력 
     */
    function insert($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');
       
        $insert_array = array(
            'title_header' => $arrays['title_header'],
            'title' => $arrays['title'],
            'title_footer' => $arrays['title_footer'],
            'text1' => $arrays['text1'],
            'text2' => $arrays['text2'],
            'text3' => $arrays['text3'],
            'text_color' => $arrays['text_color'],
            'pc_img' => $arrays['pc_img'],
            'mobile_img' => $arrays['mobile_img'],
            'path' => $arrays['path'],
            'order_no' => $arrays['order_no'],
            'link_url' => $arrays['link_url'],
            'link_target' => $arrays['link_target'],
            'open_yn' => $arrays['open_yn'],     
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
        
        $modify_array = array(
            'title_header' => $arrays['title_header'],
            'title' => $arrays['title'],
            'title_footer' => $arrays['title_footer'],
            'text1' => $arrays['text1'],
            'text2' => $arrays['text2'],
            'text3' => $arrays['text3'],
            'text_color' => $arrays['text_color'],
            'pc_img' => $arrays['pc_img'],
            'mobile_img' => $arrays['mobile_img'],
            'path' => $arrays['path'],
            'order_no' => $arrays['order_no'],
            'link_url' => $arrays['link_url'],
            'link_target' => $arrays['link_target'],
            'open_yn' => $arrays['open_yn'],     
            'modi_date' => date("Y-m-d H:i:s")
        );
        
        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
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
       // $sql0 = "UPDATE " . $table . " SET view_cnt = view_cnt + 1 WHERE idx='" . $id . "'";
       // $this->db->query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this->db->query($sql);
 
        // 게시물 내용 반환
        $result = $query->row();
 
        return $result;
     }
 
}