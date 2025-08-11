<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    /**
    * 검색 페이지
    **/

class Search extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
    }

    function index() {
        $this->load->view('home/search/list');       
    }
}