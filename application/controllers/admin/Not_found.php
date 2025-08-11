<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
/**
* Not_found(404)
**/

class Not_found extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->config->load('setting');

    }

    public function index() {

       $this->load->view('admin/404');
    }
}
