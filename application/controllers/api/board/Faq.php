<?php
/**
 * Created by PhpStorm.
 * User: from
 * Date: 2019-01-14
 * Time: 오전 10:54
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Faq extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/board_m');
    }
    function list_get()
    {
        $offset = $this->input->get('offset', TRUE);
        $limit = $this->input->get('limit', TRUE);
        $category = $this->input->get('category', TRUE);
        $search_word = $this->input->get('search_word', TRUE);
        if ($offset && $limit && $offset > 0 && $limit > 0) {
            $arrays = array(
                'category' => $category,
                'search_word' => $search_word,
                'offset' => $offset,
                'limit' => $limit
            );

            $result = $this->board_m->faqList_get($arrays);

            if ($result) {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Get List Success',
                    'result' => $result
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'NO DATA'
                ]);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Parameter ERROR'
            ]);
        }
    }
}