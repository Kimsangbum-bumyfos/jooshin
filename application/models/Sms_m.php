<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_m extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function insert($arr) {
        $result = $this->db->insert('tb_sms', $arr);
        return $result;
    }

    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE user_name like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT * FROM " . $table . $sword .$limit_query;

        $query = $this -> db -> query($sql);

        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }
        return $result;
    }

    function getRowData($idx) {
        $sql = "SELECT * FROM tb_sms WHERE idx = $idx";
        $query = $this->db->query($sql);
        return $query->row();
    }

    function edit($arr, $idx) {
        $where = array(
            'idx' => $idx
        );

        $result = $this->db->update('tb_sms', $arr, $where);

        return $result;

    }

}