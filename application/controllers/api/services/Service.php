<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Service extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/service_m');
    }

    // 용역리스트
    function list_get() {
        // $search_word = $this->input->get('search_word', TRUE);
        $category = $this->input->get('category', TRUE);
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);

        if($offset && $limit && $offset > 0 && $limit > 0) {
            $arr = array(
                // 'search_word' => $search_word,
                'category' => $category,
                'offset' => $offset,
                'limit' => $limit
            );

            $data = $this->service_m->serviceList($arr);

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

    // 제품 상세보기
    function detail_get() {
        
        $idx = $this->input->get('idx', TRUE);
        
        if(!$idx) {
            $this->response([
                'status' => FALSE,
                'message' => 'Parameter ERROR'
            ]);
        }

        $data = $this->service_m->serviceView($idx);
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

    // 메인 노출 리스트 (3개)
    function mainPageList_get() {
        $data = $this->service_m->mainPageList();

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