<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Info extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
    }

    function index() {
        $this->company();
    }

    function company() {
        $data = array(
            'menu_code'          =>$this->input->get('menu_code'),    // 하위 메뉴 코드
            'menu_up_code'       =>$this->input->get('menu_up_code'), // 상위 메뉴 코드
        );
        $this->load->view('home/info/company', $data);
    }

    function cs() {
        $data = array(
            'menu_code'          =>$this->input->get('menu_code'),    // 하위 메뉴 코드
            'menu_up_code'       =>$this->input->get('menu_up_code'), // 상위 메뉴 코드
        );
        $this->load->view('home/info/cs', $data);
    }

}