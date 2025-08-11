<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_m extends CI_Model
{

    function getMeta($idx) {
        $sql = "SELECT title, thumb_img, buyer, path FROM tb_testing_service WHERE idx='$idx'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}