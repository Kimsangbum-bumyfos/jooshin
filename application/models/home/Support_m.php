<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Support_m extends CI_Model
{

    function getNotice($idx) {
        $sql = "SELECT title, sub_title FROM tb_board WHERE idx='$idx'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}