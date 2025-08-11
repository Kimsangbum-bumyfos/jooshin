<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Branch extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this -> load -> model('api/branch_m');
    }

    function list_get() {
        $for = $this->input->get('for', TRUE);
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);
        $search_word = $this->get('search_word', TRUE);

        if($for !== 'reservation' && ($offset == '' || $limit == '')) {
            $this->response([
                'status' => FALSE,
                'message' => 'PARAMETER ERROR'
            ], REST_Controller::HTTP_OK);
            exit;
        }

        $arr = array(
            'for' => $for,
            'offset' => $offset,
            'limit' => $limit,
            'search_word' => $search_word
        );

        $result = $this->branch_m->list_get($arr);
        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'success',
                'result' => $result
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'no data'
            ], REST_Controller::HTTP_OK);
        }

    }

     public function branch_all_get(){
        $result = $this -> branch_m -> branch_all_get();
        
       //var_dump($result);

        if($result){
           $this->response([
               'status' => TRUE,
               'message' => 'success',
               'data' => $result
           ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'no data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function branch_post(){
        
        // $this -> load -> model('api/branch_m');

        /*$insert_array = array(
            'idx' => $this -> input -> post('idx', TRUE), 
            'table' => 'branch_mgr'
        );*/
        $idx = $this -> input -> post('idx', TRUE);
 
        $result = $this -> branch_m -> branch_get($idx);
        
        if($result){
             $this->response($result, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code    
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'no data'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
