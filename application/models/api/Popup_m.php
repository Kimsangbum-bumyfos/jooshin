<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Popup_m extends CI_Model {
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
        $popup_type = '';
        $today = date('Y-m-d H:i:s');
        $where = " WHERE s_date <= '$today' AND e_date >= '$today' AND open_yn='Y'";

        if ($search_word != '') {
            // 검색어 있을 경우
            $where = $where.' AND title like "%' . $search_word . '%"';
        }

        if($type) $where = $where.' AND popup_type = '.$type;

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT idx,
                       title,
                       device_type,
                       popup_type,
                       cookie_yn,
                       link_url,
                       link_target,
                       pc_img,
                       mobile_img,
                       path
                       FROM " . $table.$where.$limit_query;
 
        $query = $this -> db -> query($sql);
 
        if ($type == 'count') {
            $list = $query -> num_rows();
        } else {
            $list = $query -> result();
        }
        if($list) {
            $result = array('data' => $list);
        } else {
            $result = array('message' => 'NO DATA');
        }

        return $result;
    }

}