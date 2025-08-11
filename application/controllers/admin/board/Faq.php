<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
/**
* Faq 관리
**/

class Faq extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('script', 'form', 'manage_files'));
        $this->load->model('admin/faq_m');
        $this->load->model('cke_files_m');
        $this->config->load('setting');
        $this->load->library('form_validation');

    }

    public function index() {

        $this->lists();
    }

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        $this->load->library('pagination');

        $data['search_word'] = "";
        $data['category'] = '';
        $page_url = '';

        if ($search_word = $this->input->get('search_word', TRUE)) {
            $page_url = '?search_word='.$search_word;
            $data['search_word'] = $search_word;
        }

        if ($category = $this->input->get('category', TRUE)) {
            $page_url = $page_url ? $page_url.'&category='.$category : '?category='.$category;
            $data['category'] = $category;
        }

        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/board/faq/lists'.$page_url;
        $config['page_query_string']        = TRUE;
        $config['enable_query_string']      = TRUE;
        $config['cur_tag_open']             = '<a class="active">';
        $config['cur_tag_close']            = '</a>';
        $config['next_tag_open']            = '<span class="ico-next">';
        $config['next_tag_close']           = '</span>';
        $config['next_link']                = '';
        $config['prev_tag_open']            = '<span class="ico-prev">';
        $config['prev_tag_close']           = '</span>';
        $config['prev_link']                = '';
        $config['use_page_number']          = TRUE;
//
        // 게시물 전체 개수
        $config['total_rows'] = $this->faq_m->lists('tb_board', 'count','', '', $search_word, $category);


//
//        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $data['page'] = $this->input->get('page', TRUE);
        $page = $data['page'];

        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = 0;
            $page = 1;
        }

        $limit = $config['per_page'];

        $data['total_row'] = $config['total_rows'];
        $data['list'] = $this->faq_m->lists('tb_board', '', $start, $limit, $search_word, $category);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/board/faq', $data);
    }

    //글 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history
        $this->load->helper('string');

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            $this->form_validation->set_rules('title', '제목', 'required');
            $this->form_validation->set_rules('contents', '답변', 'required');

            if($this->form_validation->run()) {
                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'category' => $this->input->post('category', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'board_type' => 'FAQ',
                    'cke_key' => $this->input->post('k', TRUE),
                    'table' => 'tb_board'
                );

                $result = $this->faq_m->insert($write_data);

                if ($result) {
                    //history($v);
                    replace($this->config->item('ADMIN_ROOT').'/board/faq');
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['hash'] = random_string('alnum', 32);
                while(!$this->cke_files_m->checkKey($data['hash'])) {
                    $data['hash'] = random_string('alnum', 32);
                }
                $data['v'] = $v - 1;
                $this->load->view('admin/board/faq_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }
            $data['v'] = $v;
            $this->load->view('admin/board/faq_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        $data = $this->faq_m->get_view('tb_board', $this->uri->segment(5));
        $return = $this->faq_m->delete('tb_board', $this->uri->segment(5));
        $v = $this->input->get('v', TRUE);

        if ($return) {
            $remove_file = $this->cke_files_m->getPath($data->cke_key);
            if($remove_file) {
                $remove_file = explode(',', $remove_file);
                remove_files('/uploads/cke_upload', $remove_file);
            }
            $this->cke_files_m->delete($data->cke_key);
            history($v);
            exit;
        } else {
            alert_after_history('삭제중 오류가 발생했습니다', $v);
            exit;
        }

    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        if ($_POST) {
            $this->form_validation->set_rules('title', '제목', 'required');
            $this->form_validation->set_rules('contents', '답변', 'required');

            if($this->form_validation->run()) {
                $modify_data = array(
                    'table' => 'tb_board',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    'category' => $this->input->post('category', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'tags' => $this->input->post('tags', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE)
                );

                $result = $this->faq_m->modify($modify_data);

                if ($result) {
                    replace($this->config->item('ADMIN_ROOT').'/board/faq');
                    //history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->faq_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/faq_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->faq_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/faq_modify', $data);
        }
    }
    
    
}
