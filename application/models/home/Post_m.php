<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Post_m extends CI_Model
{

    function getMeta($idx) {
        $sql = "SELECT title, sub_title, thumb_img, path FROM tb_posts WHERE idx='$idx'";
        $query = $this->db->query($sql);
        $result = $query->row();
        return $result;
    }
}