<?php
/**
 * Created by PhpStorm.
 * User: from
 * Date: 2019-01-08
 * Time: 오후 3:35
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
class MainSlide extends REST_Controller
{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/mainSlide_m');
    }
    public function list_get() {
        $template_code = $this->input->get('template_code', TRUE);
        $data = $this->mainSlide_m->lists($template_code);
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