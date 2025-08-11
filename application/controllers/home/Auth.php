<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->config->load('setting');
        $this->load->helper(array('script', 'form'));
        $this->load->model('api/member_m');
    }
    function index() {
        $this->login();
    }
    function login() {
        $this->load->view('home/member/login');
    }
    function select_register() {
        $this->load->view('home/member/choice');
    }
    function register_sns() {
        $type = $this->input->post('sns_type', TRUE);
        $sns_id = $this->input->post('sns_id', TRUE);
        if(!$type || !$sns_id) {
            alert_after_history('잘못된 요청입니다.', -1);
            exit;
        }

        $chk = $this->member_m->loginWithSns($type, $sns_id);
        if($chk) {
            switch ($type) {
                case 'fb' : $msg = '이미 페이스북으로 가입 하셨습니다. 로그인 해주세요.';
                break;
                case 'kakao' : $msg = '이미 카카오톡으로 가입 하셨습니다. 로그인 해주세요.';
                break;
                default : $msg = '이미 가입 하셨습니다. 로그인 해주세요.';
            }

            alert($msg, base_url().'home/auth/login');
        }

        $data = array(
            'type' => $type,
            'sns_id' => $sns_id,
            'user_id' => $this->input->post('user_id_sns', TRUE),
            'user_name' => $this->input->post('user_name', TRUE)
        );
        $this->load->view('home/member/register_sns', $data);
    }
    function modify() {
        $this->load->view('home/member/modify');
    }
    function register() {
        $this->load->view('home/member/register');
    }
    function successRegister() {
        $this->load->view('home/member/register_success');
    }
    function findID() {
        $this->load->view('home/member/search_id');
    }
    function findPW() {
        $this->load->view('home/member/search_pw');
    }
    function logout() {
        $this->session->sess_destroy();

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        alert('안전하게 로그아웃 되었습니다.', base_url());
        exit;
    }
    public function reset_passwd(){

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this->load->library('encrypt');

        if ($_POST) {
            //비빌 번호 유효시간 60분 초과 여부를 검사한다.
            $valid_chk =  $this->member_m->reset_passwd_time_chk($this->input->post('auth_email', TRUE));

            //유효시간(60분)이 지난 경우 비번 업데이트를 할 수 없음
            if($valid_chk==0) {
                alert('비빌번호 재설정 유효시간이 초과 하였습니다.\n비밀번호 재설정을 다시 시도하세요.', '/');
                exit;
            }else{

                //파라미터로 받은 비번은 암호화하여 전송한다.
                $modify_data = array(
                    'table' => 'tb_member',
                    'user_passwd' => $this->encrypt->encode($this->input->post('auth_passwd', TRUE)),
                    'user_id' => $this->input->post('auth_email', TRUE),
                );

                $result = $this->member_m->reset_passwd_update($modify_data);

                if ($result) {
                    replace('/home/auth/reset_password_result');
                    exit;
                } else {
                    alert('비밀번호 재설정 시 오류가 발생했습니다.\n다시 시도하세요.', '/');
                    exit;
                }
            }
        }else{
            //URI 세그멘트 중에 암호화된 이메일을 가져온다.
            $decrypted_email = $this->uri->segment(4);

            //암호화 할 때 치환했던 문자를 다시 변경한다.
            //암호화 시 "/"가 있는 경우 세그먼트가 인식할 수 없어 "*"로 변경후 url 생성
            $decrypted_email = str_replace("*", "/", $decrypted_email);
            $decrypted_email = $this->encrypt->decode($decrypted_email);

            $data['auth_email'] = $decrypted_email;
            $this->load->view('home/member/reset_passwd', $data);
        }
    }
    public function reset_password_result() {
        $this->load->view('home/member/reset_passwd_ok');
    }
}