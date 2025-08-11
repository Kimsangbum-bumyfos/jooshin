<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 1:1문의 관리
 **/
class Inquire extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'security'));
        $this->load->model('admin/inquire_m');
        $this->config->load('setting');
    }

    public function index() {
        $this->lists();
    }

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        // 페이지 네이션 설정
        $this->load->library('pagination');


        $data['search_word'] = "";
        $page_url = '';
        if ($search_word = $this->input->get('searchWord')) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }

        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/customer/inquire/lists'.$page_url;
        $config['page_query_string']        = TRUE;
        $config['enable_query_string']      = TRUE;
        // $config['num_links']      = 5;
        $config['cur_tag_open']             = '<a class="active">';
        $config['cur_tag_close']            = '</a>';
        $config['next_tag_open']            = '<span class="ico-next">';
        $config['next_tag_close']           = '</span>';
        $config['next_link']                = '';
        $config['prev_tag_open']            = '<span class="ico-prev">';
        $config['prev_tag_close']           = '</span>';
        $config['prev_link']                = '';
        $config['use_page_number']          = TRUE;

        // 게시물 전체 개수
        $config['total_rows'] = $this->inquire_m->lists('tb_inquire', 'count','', '', $search_word);

        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

        /// 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';

        $page = $this->input->get('page', 1);

        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = 0;
            $page = 1;
        }

        $data['limit'] = $config['per_page'];
        $data['page'] = $page;
        $data['total_row'] = $config['total_rows'];
        $data['list'] = $this->inquire_m->lists('tb_inquire', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/customer/inquire', $data);
    }

    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        $return = $this->inquire_m->delete('tb_inquire', $this->uri->segment(5));

        if ($return) {
            history(-2);
            exit;
        } else {
            alert_after_history('삭제중 오류가 발생했습니다', -1);
            exit;
        }
    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        if ( $_POST ) {
            $modify_data = array(
                'table' => 'tb_inquire',
                'idx' => $this->uri->segment(5),
                'feedback_type' => $this->input->post('feedback_type', TRUE),
                'feedback_memo' => $this->input->post('feedback_memo', TRUE),
                'feedback_yn' => $this->input->post('feedback_yn', TRUE),
            );

            $result = $this->inquire_m->modify($modify_data);

            if ($result) {
                history(-2);
                exit;
            } else {
                alert_after_history('등록중 오류가 발생했습니다', -1);
                exit;
            }
        } else {
            $data['views'] = $this->inquire_m->get_view('tb_inquire', $this->uri->segment(5));
            $this->load->view('admin/customer/inquire_modify', $data);
        }
    }
}
