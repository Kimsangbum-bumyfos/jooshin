<?php
/**
 * Created by PhpStorm.
 * User: from
 * Date: 2019-01-08
 * Time: 오후 12:52
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Popup extends REST_Controller
{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/popup_m');
    }
    public function list_get() {
        $type = $this->input->get('type');
        $data = $this->popup_m->lists('tb_popup', $type);
        if($data){
            $this->response([
                'status' => TRUE,
                'message' => 'Get List Success',
                'result' => $data
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'NO DATA'
            ]);
        }
    }

}