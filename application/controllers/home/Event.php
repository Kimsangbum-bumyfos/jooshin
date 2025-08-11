<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Event extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
    }
    function index() {
        $this->viewList();
    }
    function viewList() {
        $this->load->view('home/cs/event_list');
    }
    function detail() {
        $this->load->view('home/cs/event_detail');
    }

}