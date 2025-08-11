<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/setting_m');
        $this->config->load('setting');
    }
    function index() {
        $this->view();
    }
    function view() {
        $this->load->view('admin/setting/cms');
    }
}