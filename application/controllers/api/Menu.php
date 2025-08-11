<?php
/**
 * 메뉴 전체 리스트 api
 * Date: 2019-04-29
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Menu extends REST_Controller
{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/menu_m');
    }
    public function list_get() {
        $data = $this->menu_m->lists();
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