<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 관리자 관리
 **/

class Super extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('super_m');
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
        if ($search_word = $this->input->get('search_word', TRUE)) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }
        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/user/super/lists'.$page_url;
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
        $config['total_rows'] = $this->super_m->lists('tb_super', 'count','', '', $search_word);

        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
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

        $data['limit'] = $config['per_page'];
        $data['page'] = $page;
        $data['total_row'] = $config['total_rows'];
        $data['list'] = $this->super_m->lists('tb_super', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/user/super', $data);
    }

    //글 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        //post로 전송된 값이 있을 경우
        if ($_POST){
            $this->form_validation->set_rules('auth_name', '이름', 'required');
            $this->form_validation->set_rules('auth_id', '아이디', 'required');
            $this->form_validation->set_rules('auth_email', '이메일', 'required');
            $this->form_validation->set_rules('auth_passwd', '비밀번호', 'required');

            if($this->form_validation->run()) {
                $write_data = array(
                    'auth_name' => $this->input->post('auth_name', TRUE),
                    'auth_id' => $this->input->post('auth_id', TRUE),
                    'auth_email' => $this->input->post('auth_email', TRUE),
                    'auth_passwd' => $this->input->post('auth_passwd', TRUE),
                    'use_yn' => $this->input->post('use_yn', TRUE),
                    'table' => 'tb_super'
                );
                $idChk = $this->super_m->id_chk($this->input->post('auth_id', TRUE));

                $emailChk = $this->super_m->email_chk($this->input->post('auth_email',TRUE)); 

                if($idChk){
                    alert_after_history('이미 등록된 아이디가 있습니다', -1);
                    exit;
                }
                else if($emailChk){
                    alert_after_history('이미 등록된 이메일이 있습니다', -1);
                    exit;
                }
                else{
                    $result = $this->super_m->insert_auth($write_data);
                    if ($result) {
                        alert_after_history('등록 되었습니다', $v);
                        exit;
                    } else {
                        alert_after_history('수정중 오류가 발생했습니다', -1);
                        exit;
                    }
                }
            } else {
                $data['v'] = $v - 1;
                $this->load->view('admin/user/super_write');
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/user/super_write',$data);
        }
    }

    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $return = $this->super_m->delete('tb_super', $this->uri->segment(5));
        $v = $this->input->get('v', TRUE);

        if ($return) {
            alert_after_history('삭제 되었습니다', $v);
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
            $this->form_validation->set_rules('auth_name', '이름', 'required');
            $this->form_validation->set_rules('auth_email', '이메일', 'required');
            $this->form_validation->set_rules('auth_passwd', '비밀번호', 'required');

            if($this->form_validation->run()) {
                $modify_data = array(
                    'table' => 'tb_super',
                    'idx' => $this->uri->segment(5),
                    'auth_name' => $this->input->post('auth_name', TRUE),
                    'auth_email' => $this->input->post('auth_email', TRUE),
                    'auth_passwd' => $this->input->post('auth_passwd', TRUE),
                    'use_yn' => $this->input->post('use_yn', TRUE)
                );

                $result = $this->super_m->modify($modify_data);

                if ($result) {
                    alert_after_history('수정 되었습니다', $v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['views'] = $this->super_m->get_data($this->uri->segment(5));
                //암호화된 패스워드를 리턴 받아서 복호화한다. 수정 시 다시 암호화한다.
                $this->load->library('encryption');
                $d_passwd = $this->encryption->decrypt($data['views']->auth_passwd);

                //data객체에 복호화된 패스워드를 추가한다.
                $data['views']->auth_passwd = $d_passwd;
                $data['v'] = $v - 1;
                $this->load->view('admin/user/super_modify', $data);
            }

        } else {

            $data['views'] = $this->super_m->get_data($this->uri->segment(5));

            //암호화된 패스워드를 리턴 받아서 복호화한다. 수정 시 다시 암호화한다.
            $this->load->library('encryption');
            $d_passwd = $this->encryption->decrypt($data['views']->auth_passwd);

            //data객체에 복호화된 패스워드를 추가한다.
            $data['views']->auth_passwd = $d_passwd;
            $data['v'] = $v;
            $this->load->view('admin/user/super_modify', $data);
        }
    }

    //관리자 가입 시 아이디 중복을 체크한다.
    function id_dupl_chk(){

        $chk_id = $this->input->post('auth_id', TRUE);
        $result = $this->super_m->id_chk($chk_id);

        if($result){
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;");
            echo "fail";

        }else{
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;");
            echo "success";

        }
    }

    //관리자 가입 시 아이디 중복을 체크한다.
    function email_dupl_chk(){

        $chk_email = $this->input->post('auth_email', TRUE);
        $result = $this->super_m->email_chk($chk_email);

        if($result){
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;");
            echo "fail";

        }else{
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;");
            echo "success";

        }
    }
}

