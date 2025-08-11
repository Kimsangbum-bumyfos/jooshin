<?php
/**
 * 사이트 검색 리스트 api
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Search extends REST_Controller
{
    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/search_m');
    }
    public function list_get() {
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);
        $search_word = $this->input->get('search_word', TRUE);

        if($offset && $limit && $offset > 0 && $limit > 0) {
            $arr = array(
                'search_word' => $search_word,
                'offset' => $offset,
                'limit' => $limit
            );

            $data = $this->search_m->lists($arr);

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
        }else {
            $this->response([
                'status' => FALSE,
                'message' => 'Parameter ERROR'
            ]);
        }
    }

}