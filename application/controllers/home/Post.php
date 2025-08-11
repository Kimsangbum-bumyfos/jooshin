<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * 사용자 CONTS 유형 콘텐츠 분기
    **/

class Post extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date','segment'));
        $this->config->load('setting');
        $this -> load -> helper('alert');
    }

    function index() {
       
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $data['menu_code'] = $menu_code; 
            $data['menu_up_code'] = $menu_up_code; 
            $this -> load -> view('home/post/list',$data);       
        }
    }

    function detail() {
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $this->load->model('home/post_m');
            $idx = $this->input->get('idx');
            $result = $this->post_m->getMeta($idx);

            $data = array(
                'idx'                =>$idx,                              // idx
                'menu_code'          =>$menu_code,                        // 하위 메뉴 코드
                'menu_up_code'       =>$menu_up_code,                     // 상위 메뉴 코드
                'title'              =>$result->title,                    // 제목
                'sub_title'          =>$result->sub_title,                // 설명
                'thumb_img'          =>$result->thumb_img,                // 썸네일
                'path'               =>$result->path,                     // 경로

            );

            $this -> load -> view('home/post/detail',$data);       
        }
    }

}