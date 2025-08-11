<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Support extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
    }
    function index() {
        $this->notice();
    }
    function notice() {
        $data = array(
            'menu_code'          =>$this->input->get('menu_code'),    // 하위 메뉴 코드
            'menu_up_code'       =>$this->input->get('menu_up_code'), // 상위 메뉴 코드
        );

        $idx = $this->input->get('idx', TRUE);
        
        if(!$idx) {
            $this->load->view('home/cs/notice_list', $data);
        }else {
            $this->load->model('home/support_m');
            $result = $this->support_m->getNotice($idx);
            $data['title'] = $result->title;
            $data['sub_title'] = $result->sub_title;
            $data['idx'] = $idx;
            $this->load->view('home/cs/notice_detail', $data);
        }
    }
    function event() {
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');
        $data['menu_code'] = $menu_code; 
        $data['menu_up_code'] = $menu_up_code; 
        $idx = $this->input->get('idx', TRUE);
        if(!$idx) {
            $this->load->view('home/cs/event_list', $data);
        }else {
            $this->load->model('home/support_m');
            $result = $this->support_m->getNotice($idx);
            $data['title'] = $result->title;
            $data['sub_title'] = $result->sub_title;
            $data['idx'] = $idx;
            $this->load->view('home/cs/event_detail', $data);
        }
    }
    function faq() {
        $data = array(
            'menu_code'          =>$this->input->get('menu_code'),    // 하위 메뉴 코드
            'menu_up_code'       =>$this->input->get('menu_up_code'), // 상위 메뉴 코드
        );
        $this->load->view('home/cs/faq_list', $data);
    }
    function center() {
        $this->load->view('home/cs/center');
    }

}