<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * 상품 유형 콘텐츠 분기
    **/

class Product extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date','segment'));
        $this->config->load('setting');
        $this -> load -> helper('alert');
    }

    function index() {
       
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');
        $depth_1 = $this->input->get('depth_1');
        $depth_2 = $this->input->get('depth_2');
        $depth_3 = $this->input->get('depth_3');
        $offset = $this->input->get('offset');
        $search_word = $this->input->get('search_word');
        $search_flag = $this->input->get('search_flag');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $data = array(
                'menu_code'             =>$menu_code,              // 하위 메뉴 코드
                'menu_up_code'          =>$menu_up_code,           // 상위 메뉴 코드
                'depth_1'               =>$depth_1,                // 1뎁스
                'depth_2'               =>$depth_2,                // 2뎁스
                'depth_3'               =>$depth_3,                // 3뎁스
                'offset'                =>$offset,                 // 리스트 번호
                'search_word'           =>$search_word,            // 검색어
                'search_flag'           =>$search_flag,            // 검색 플래그 
            );
            $this -> load -> view('home/product/list',$data);       
        }
    }

    function detail() {
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');
        $depth_1 = $this->input->get('depth_1');
        $depth_2 = $this->input->get('depth_2');
        $depth_3 = $this->input->get('depth_3');
        $offset = $this->input->get('offset');
        $search_word = $this->input->get('search_word');
        $search_flag = $this->input->get('search_flag');

        if($menu_code == ""){
           alert('정상적인 경로가 아닙니다.다시 접속해 주세요', $this->config->item('HOME_ROOT').'/index');
           exit ;
        }else{
            $this->load->model('home/product_m');
            $idx = $this->input->get('idx');
            $result = $this->product_m->getMeta($idx);

            $data = array(
                'idx'                =>$idx,                              // idx
                'menu_code'          =>$menu_code,                        // 하위 메뉴 코드
                'menu_up_code'       =>$menu_up_code,                     // 상위 메뉴 코드
                'depth_1'            =>$depth_1,                          // 1뎁스
                'depth_2'            =>$depth_2,                          // 2뎁스
                'depth_3'            =>$depth_3,                          // 3뎁스
                'offset'             =>$offset,                           // 페이징
                'search_word'        =>$search_word,                      // 검색어 
                'search_flag'        =>$search_flag,                      // 검색 플레그
                'title'              =>$result->title,                    // 제목
                'sub_title'          =>$result->sub_title,                // 설명
                'model_name'         =>$result->model_name,               // 모델명
                'manufacturer'       =>$result->manufacturer,             // 제조사
                'thumb_img'          =>$result->thumb_img,                // 썸네일
                'path'               =>$result->path,                     // 경로
            );

            $this -> load -> view('home/product/detail',$data);       
        }
    }

    function file_downLoad(){
        $this->load->helper('download');
        $file = $this->input->get('file');
        $file_real = $this->input->get('file_real');
        $data = file_get_contents($file);
        force_download($file_real, $data);
        $this->output->enable_profiler(TRUE);
    }

}