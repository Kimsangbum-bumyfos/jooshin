<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
    }
    function index() {
        $this->viewList();
    }
    function viewList() {
        $menu_code = $this->input->get('menu_code');
        $menu_up_code = $this->input->get('menu_up_code');
        $data['menu_code'] = $menu_code; 
        $data['menu_up_code'] = $menu_up_code; 
        $this->load->view('home/branch/list', $data);
    }

}