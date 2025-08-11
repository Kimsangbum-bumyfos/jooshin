<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * 시험 및 용역 콘텐츠 분기
    **/

class Service extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date','segment'));
        $this->config->load('setting');
        $this -> load -> helper('alert');
    }

    function index() {
       
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');
        $category = $this->input->get('category');
        $offset = $this->input->get('offset');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $data['menu_code'] = $menu_code; 
            $data['menu_up_code'] = $menu_up_code;
            $data['category'] = $category; 
            $data['offset'] = $offset;
            $this -> load -> view('home/service/list',$data);       
        }
    }

    function detail() {
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $this->load->model('home/service_m');
            $idx = $this->input->get('idx');
            $result = $this->service_m->getMeta($idx);

            $category = $this->input->get('category');
            $offset = $this->input->get('offset');

            $data = array(
                'idx'                =>$idx,                              // idx
                'menu_code'          =>$menu_code,                        // 하위 메뉴 코드
                'menu_up_code'       =>$menu_up_code,                     // 상위 메뉴 코드
                'title'              =>$result->title,                    // 제목
                'buyer'              =>$result->buyer,                    // 설명(발주처)
                'thumb_img'          =>$result->thumb_img,                // 썸네일
                'path'               =>$result->path,                     // 경로
            );

            $data['category'] = $category; 
            $data['offset'] = $offset;

            $this -> load -> view('home/service/detail',$data);       
        }
    }

}