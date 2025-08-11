<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class MainSlide_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function lists($template_code) {
        if($template_code) {
            $sql = "SELECT idx,
                       title_header,
                       title,
                       title_footer,
                       text1,
                       text2,
                       text3,
                       text_color,
                       link_url,
                       link_target,
                       pc_img,
                       mobile_img,
                       path,
                       order_no
                       FROM tb_main_slide WHERE open_yn='Y' AND template_code='$template_code' ORDER BY order_no ASC";
        } else {
            $sql = "SELECT idx,
                       title_header,
                       title,
                       title_footer,
                       text1,
                       text2,
                       text3,
                       text_color,
                       link_url,
                       link_target,
                       pc_img,
                       mobile_img,
                       path,
                       order_no
                       FROM tb_main_slide WHERE open_yn='Y' ORDER BY order_no ASC";
        }

        $query = $this->db->query($sql);
        $list = $query->result();
        if($list) {
            $result = array('data'=>$list);
        } else {
            $result = array('message' => 'NO DATA');
        }

        return $result;

    }

 
}