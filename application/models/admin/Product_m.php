<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Product_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 상품 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '', $depth_1 = '', $depth_2 = '', $depth_3 = '') {

        $limit_query = '';
        $sword = '';
        $depth = '';

        if ($depth_1 != '' && $search_word == ''){// 1뎁스가 있을 경우
            $depth .= ' WHERE depth_1 = "' . $depth_1 . '" ' ;
        }
        else if($depth_1 != ''){
            $depth .= ' AND depth_1 = "' . $depth_1 . '" ' ;
        }
        if ($depth_2 != ''){ // 2뎁스가 있을 경우
            $depth .= ' AND depth_2 = "' . $depth_2 . '" ' ;
        }
        if ($depth_3 != ''){ // 3뎁스가 있을 경우
            $depth .= ' AND depth_3 = "' . $depth_3 . '" ' ;
        }

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE (title like "%' . $search_word . '%" OR sub_title like "%'.$search_word.'%" '.$depth.'     )'." ";
        }
        else {
            $sword = '  '.$depth.' ';
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
    * 상품 등록
    */
    function insert($arrays) {        
        $result = $this->db->insert('tb_products', $arrays);
        return $result;
    }

    /**
    * 상품 삭제
    */
    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    /**
    * 상품 수정
    */
    function modify($arrays) {

         //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'title' => $arrays['title'],
            'sub_title' => $arrays['sub_title'],
            'depth_1' => $arrays['depth_1'],
            'depth_2' => $arrays['depth_2'],
            'depth_3' => $arrays['depth_3'],
            'model_name' => $arrays['model_name'],
            'manufacturer' => $arrays['manufacturer'],
            'type' => $arrays['type'],
            'sensor_range' => $arrays['sensor_range'],
            'sensor_outline' => $arrays['sensor_outline'],
            'key_value' => $arrays['key_value'],
            'page_fix' => $arrays['page_fix'],
            'page_main' => $arrays['page_main'],
            'thumb_img' => $arrays['thumb_img'],
            'img_list' => $arrays['img_list'],
            'file_law_name' => $arrays['file_law_name'],
            'file_real_name' => $arrays['file_real_name'],
            'path' => $arrays['path'],
            // 'contents' => $arrays['contents'],
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
        * 기존 파일 명 로드
    */
    function modify_file($table, $id, $field){
        $sql = "SELECT ".$field." FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this->db->query($sql);
        $result = $query->row();
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
    * 상품 상세보기
    */
    function get_view($table, $id) {
       $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
       $query = $this->db->query($sql);
 
       // 게시물 내용 반환
       $result = $query->row();
 
       return $result;
     }
}