<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_m extends CI_Model
{

    function getMeta($idx) {
        $sql = "SELECT title, sub_title, model_name, manufacturer, thumb_img, path FROM tb_products WHERE idx='$idx'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}