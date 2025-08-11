<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Post extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/post_m');
    }

    //포스트 리스트 
    //search_word는 향후 확장성 고려하여 추가해 놓음
    function list_get() {
        $search_word = $this->input->get('search_word', TRUE);
        $menu_code = $this->input->get('menu_code', TRUE);
        $menu_up_code = $this->input->get('menu_up_code', TRUE);
        $menu_level = $this->input->get('menu_level', TRUE);
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);

        if($offset && $limit && $offset > 0 && $limit > 0) {
            $arr = array(
                'search_word' => $search_word,
                'menu_code' => $menu_code,
                'menu_up_code' => $menu_up_code,
                'menu_level' => $menu_level,
                'offset' => $offset,
                'limit' => $limit
            );
            $data = $this->post_m->postList($arr);

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

    //포스트에 해당하는 관련 콘텐츠 최대 3개 가져오기
    
    function relatedList_get() {
        $menu_code = $this->input->get('menu_code', TRUE);
        $tags = $this->input->get('tags', TRUE);
        
        if($menu_code !=='') {
            $arr = array(
                'menu_code' => $menu_code,
                'tags' => $tags                
            );
            $data = $this->post_m->relatedPostList($arr);

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

    //포스트 상세보기
    function detail_get() {
        
        $idx = $this->input->get('idx', TRUE);
        
        if(!$idx) {
            $this->response([
                'status' => FALSE,
                'message' => 'Parameter ERROR'
            ]);
        }

        $data = $this->post_m->postView($idx);
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