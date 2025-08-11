<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Product extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/product_m');
    }

    // 제품 리스트 + 검색어 + 뎁스
    function list_get() {
        $search_word = $this->input->get('search_word', TRUE);
        $depth_1 = $this->input->get('depth_1', TRUE);
        $depth_2 = $this->input->get('depth_2', TRUE);
        $depth_3 = $this->input->get('depth_3', TRUE);
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);

        if($offset && $limit && $offset > 0 && $limit > 0) {

            // exc
            if($depth_1 == "시험용치구n지그")
                $depth_1 = "시험용치구&지그";
            if($depth_2 == "변형률계n무응력계")
                $depth_2 = "변형률계&무응력계";

            $arr = array(
                'search_word' => $search_word,
                'depth_1' => $depth_1,
                'depth_2' => $depth_2,
                'depth_3' => $depth_3,
                'offset' => $offset,
                'limit' => $limit
            );

            $data = $this->product_m->productList($arr);

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

        $data = $this->product_m->productView($idx);
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
        $data = $this->product_m->mainPageList();

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