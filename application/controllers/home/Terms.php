<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Terms extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->config->load('setting');
    }
    function index() {
        $this->email();
    }
    function email(){
        $this->load->view('home/terms/email');
    }
    function service() {
        $this->load->view('home/terms/service');
    }
    function privacy() {
        $this->load->view('home/terms/privacy');
    }
    function allowPrivacy() {
        $this->load->view('home/terms/allow_privacy');
    }
}