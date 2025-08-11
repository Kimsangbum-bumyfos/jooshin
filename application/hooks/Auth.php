<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth {
    function adminCheck(){
        $CI = & get_instance();
        $ad = $CI->uri->segment(1);
        if($ad !== 'admin' || (isset($CI->allow) && in_array('not_adm', $CI->allow))){

        }else {
            if($CI->session->userdata('rank') !== 'admin'){
                // 관리자 로그인 X

                alert("권한이 없습니다.",$CI->config->item('ADMIN_ROOT').'?redirect='.current_url());
            }
        }

    }
}
?>