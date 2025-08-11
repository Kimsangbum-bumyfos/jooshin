<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 회원관리
 **/

class Member extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('member_m');
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
        $page_url = '';
        if ($search_word = $this->input->get('search_word')) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }

        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/user/member/lists'.$page_url;
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

        // 게시물 전체 개수
        $config['total_rows'] = $this->member_m->lists('tb_member', 'count','', '', $search_word);

        // 한 페이지에 표시할 게시물 수
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

        $data['list'] = $this->member_m->lists('tb_member', '', $start, $limit, $search_word);

        //게시판 넘버링을 위한 값 전달
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;
        $data['total_row'] = $config['total_rows'];

        $this->load->view('admin/user/member', $data);
    }
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        $return = $this->member_m->delete('tb_member', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
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
            $this->form_validation->set_rules('user_name', '이름', 'required');
            $this->form_validation->set_rules('user_phone', '연락처', 'required');

            //수신여부 옵션
            $agreement = $this->input->post('agreement', TRUE);

            if (empty($agreement)) {
                $agreement="";
            }else{
                $agreement = implode(',', $agreement);
            }

            if($this->form_validation->run()) {
                $modify_data = array(
                    'table' => 'tb_member',
                    'idx' => $this->uri->segment(5),
                    'user_name' => $this->input->post('user_name', TRUE),
                    'addr_code' => $this->input->post('addr_code', TRUE),
                    'addr' => $this->input->post('addr', TRUE),
                    'addr2' => $this->input->post('addr2', TRUE),
                    'user_phone' => $this->input->post('user_phone', TRUE),
                    'agreement' => $agreement,
                    'login_block_yn' => $this->input->post('login_block_yn', TRUE),
                );

                $result = $this->member_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }

            }else {
                $data['v'] = $v - 1;
                $data['views'] = $this->member_m->get_view('tb_member', $this->uri->segment(5));
                $this->load->view('admin/user/member_modify', $data);
            }

        } else {
            $data['v'] = $v;
            $data['views'] = $this->member_m->get_view('tb_member', $this->uri->segment(5));
            $this->load->view('admin/user/member_modify', $data);
        }
    }
}
