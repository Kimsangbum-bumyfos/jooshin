<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
/**
* 이벤트 관리
**/
class Event extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/event_m');
        $this->load->model('cke_files_m');
        $this->config->load('setting');
        $this->load->library('form_validation');
    }

    function index(){
        $this->lists();
    }

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        $this->load->library('pagination');


        $data['search_word'] = "";
        $page_url = '';
        if ($search_word = $this->input->get('search_word')) {
            $page_url = '?search_word='.$search_word;
            $data['search_word'] = $search_word;
        }


        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/board/event/lists'.$page_url;
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
        $config['total_rows'] = $this->event_m->lists('tb_board', 'count','', '', $search_word);

//
//        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this->input->get('page', 1);

        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = 0;
            $page = 1;
        }

        $limit = $config['per_page'];

        $data['total_row'] = $config['total_rows'];
 
        $data['list'] = $this->event_m->lists('tb_board', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/board/event', $data);
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
            $this->form_validation->set_rules('sub_title', '하위제목', 'required');
            $this->form_validation->set_rules('contents', '내용', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');
            // if(empty($_FILES['userfile']['name'])) $this->form_validation->set_rules('userfile', '썸네일 이미지', 'required');
 
            if($this->form_validation->run()) {

                //------------파일 업로드 처리-----------//
                // $config['upload_path'] = '.'.$this->config->item("UPLOAD_EVENT");
                // $config['allowed_types'] = 'gif|jpg|png';
                // $config['max_size'] = '10485760';
                // $config['max_width']  = '5000';
                // $config['max_height']  = '10000';

                // $this->load->library('upload', $config);
                // $this->upload->initialize($config);


                // if(!$this->upload->do_upload()) {
                //    echo $this->upload->display_errors();
                //    exit;
                //     alert_after_history('이미지 업로드에 실패하였습니다', -2);
                //     exit;
                // }
                //file upload..


                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'sub_title' => $this->input->post('sub_title', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'board_type' => 'EVENT',
                    // 'thumb_img' => $this->upload->data('file_name'),
                    // 'path' => $this->config->item("UPLOAD_EVENT"),
                    'cke_key' => $this->input->post('k', TRUE),
                    'table' => "tb_board"
                );

                $result = $this->event_m->insert($write_data);

                if ($result) {
                    //history($v);
                    replace($this->config->item('ADMIN_ROOT').'/board/event');
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
                $this->load->view('admin/board/event_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }
            $data['v'] = $v;
            $this->load->view('admin/board/event_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->event_m->get_view('tb_board', $this->uri->segment(5));
        $return = $this->event_m->delete('tb_board', $this->uri->segment(5));
        $v = $this->input->get('v');

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
            $this->form_validation->set_rules('sub_title', '하위제목', 'required');
            $this->form_validation->set_rules('contents', '내용', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');

            if($this->form_validation->run()) {
                // $config['upload_path'] = '.'.$this->config->item("UPLOAD_EVENT");
                // $config['allowed_types'] = 'gif|jpg|png';
                // $config['max_size'] = '10485760';
                // $config['max_width']  = '5000';
                // $config['max_height']  = '10000';

                // $this->load->library('upload', $config);
                // $this->upload->initialize($config);

                // $this->upload->do_upload();

                // if($this->upload->data('file_name')==''){
                //     $real_file_name = $this->input->post('thumb_chk', TRUE);
                // }else{
                //     $real_file_name = $this->upload->data('file_name');
                // }

                $modify_data = array(
                    'table' => 'tb_board',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    'sub_title' => $this->input->post('sub_title', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'board_type' => 'EVENT',
                    // 'thumb_img' => $real_file_name,
                    // 'path' => $this->config->item("UPLOAD_EVENT")
                );

                $result = $this->event_m->modify($modify_data);

                if ($result) {
                    //history($v);
                    replace($this->config->item('ADMIN_ROOT').'/board/event');
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->event_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/event_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->event_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/event_modify', $data);
        }
    }
}
