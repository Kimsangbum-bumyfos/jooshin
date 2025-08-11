<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Gallery extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/board_m');
    }

    //갤러리 리스트
    function list_get() {
        $search_word = $this->input->get('search_word', TRUE);
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);
        
        if($offset && $limit && $offset > 0 && $limit > 0) {
            $arr = array(
                'search_word' => $search_word,
                'offset' => $offset,
                'limit' => $limit,
                'board_type' => 'GALLERY',
                'category' => '',
            );
            $data = $this->board_m->boardList_get($arr);

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

    function detail_get() {
        $idx = $this->input->get('idx', TRUE);
        if(!$idx) {
            $this->response([
                'status' => FALSE,
                'message' => 'Parameter ERROR'
            ]);
        }

        $data = $this->board_m->galleryView($idx);
        if($data) {
            $this->response([
                'status' => TRUE,
                'message' => 'success',
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