<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
//        $this->load->library('session');
        $this->load->model('super_m');
        $this->load->helper(array('form', 'segment', 'script'));
        $this->config->load('setting');
        $this->allow = array('not_adm');
    }

    public function index(){
//        log_message('LOG', 'test log...');
        if($this->session->userdata('rank') === 'admin') {
            redirect($this->config->item('ADMIN_LOGIN_INDEX'));
        }
        $this->login_check();
    }

    //로그인 유효성 검사 함수
    function login_check() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', '아이디', 'required');
        $this->form_validation->set_rules('password', '비밀번호', 'required');
        
        //post로 전송된 값이 있고 폼 유효성 완료된 경우
        if ($_POST && $this->form_validation->run() == TRUE) {

             //패스워드 클래스 로드
            $this->load->library('encryption');

            $result = $this->super_m->login($this->input->post('id', TRUE));
             
            //해당 아이디에 해당하는 패스워드가 있는지 확인한다. 
            if($result){
                //함호화된 password를 가져온다.           
                $db_passwd = $result->auth_passwd;
                //암호화된 패스워드를 복호화한다.(입력된 패스워드와 비교)   
                $d_passwd = $this->encryption->decrypt($db_passwd);
                if($d_passwd == $this->input->post('password')){
                    $newdata = array(
                        'user_idx' => $result->idx,
                        'auth_name' => $result->auth_name,
                        'logged_in' => TRUE,
                        'rank' => 'admin'
                    );

                    $this->session->set_userdata($newdata);
                    $redirect_url = $this->input->get('redirect');
                    $redirect_url = $redirect_url ? $redirect_url : $this->config->item('ADMIN_LOGIN_INDEX');
                    replace($redirect_url);
                    exit;

                }else{
                    alert_after_history('패스워드가 일치하지 않습니다', -1);
                    exit;
                }

            }else{
                alert_after_history('아이디가 일치하지 않거나 인증되지 않은 아이디입니다.', -1);
                exit;
            }
        } else {
            // 쓰기 폼 view 호출
            $data['views'] = $this->super_m->get_view();
            $this->load->view('admin/auth/login',$data);
        }
    }

    //로그아웃
    public function logout() {
        $this->session->sess_destroy();
        
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        alert('안전하게 로그아웃 되었습니다.', $this->config->item('ADMIN_ROOT'));
        exit;
    }

    //관리자 비밀번호 찾기 이메일 전송하기
    public function forgot_password(){

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //post로 전송된 값이 있을 경우
        if ($_POST){
            $auth_email = $this->input->post('auth_email', TRUE); 
            
            //전송받은 이메일이 관리자에 등록되었는지 확인한다.
            $result = $this->super_m->auth_email_chk($auth_email);
            
            //입력한 이메일이 있는 경우 해당 이메일로 비번 리셋 URL을 전송한다.
            if ($result>0) {

                //이메일 암호화 처리 후 reset 페이지 URL 생성 후 메일 전송
                $this->load->library('encryption');
                $encrypted_email = $this->encryption->encrypt($auth_email);

                //암호화 시 세그먼트로 인식되어서 "/"를 "*"로 치환한다.
                $encrypted_email = str_replace("/", "*", $encrypted_email);

                //메일로 전송할 비번 재설정 페이지 URL 셋팅
                $send_url = $this->config->item('ADMIN_BASE_URL').'/auth/reset_passwd/'.$encrypted_email;

                $data['url'] = $send_url;
                $htmlContent = $this->load->view('admin/auth/reset_passwd_email', $data, true);
                //이메일 libray 로드
                $this->load->library('email');

                $this->email->set_newline("\r\n");
                $this->email->clear();
                $this->email->from("help@thefrom.kr");
                $this->email->to($auth_email); 
                $this->email->subject("패스워드 재설정");
                $this->email->message($htmlContent);
               
                if ($this->email->send()){
                    //$result = "success send email";
                    $result = $this->super_m->passwd_reset_send_date($auth_email);
                    if($result){
                        replace($this->config->item('ADMIN_BASE_URL').'/auth/forgot_password_result');
                    } else{
                        alert_after_history('오류가 발생하였습니다.', -1);
                    }
                } else {
                    alert_after_history('오류가 발생하였습니다.', -1);
                }
            } else {
                alert_after_history('등록되지 않은 이메일 입니다', -1);
                exit;
            }
        }else {
            // 쓰기 폼 view 호출
            $this->load->view('admin/auth/forgot_password');
        }    

    }
    public function forgot_password_result() {
        $this->load->view('admin/auth/forgot_password_info');
    }
    public function reset_password_result() {
        $this->load->view('admin/auth/reset_passwd_ok');
    }

    //비번 재설설정
    //이메일에서 URL를 클릭하면 오늘 비번 재설정 화면 이때 암호화된 이메일 주소를 달고 온다.
    public function reset_passwd(){

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $this->load->library('encryption');

        if ($_POST) {

            //비빌 번호 유효시간 60분 초과 여부를 검사한다.
            $valid_chk =  $this->super_m->reset_passwd_time_chk($this->input->post('auth_email', TRUE));

            //유효시간(60분)이 지난 경우 비번 업데이트를 할 수 없음
            if($valid_chk==0) {
                alert('비빌번호 재설정 유효시간이 초과 하였습니다.\n비밀번호 재설정을 다시 시도하세요.', $this->config->item('ADMIN_ROOT'));
                exit;
            }else{

                //파라미터로 받은 비번은 암호화하여 전송한다.
                $modify_data = array(
                    'table' => 'tb_super',
                    'auth_passwd' => $this->encryption->encrypt($this->input->post('auth_passwd', TRUE)),
                    'auth_email' => $this->input->post('auth_email', TRUE),
                );

                $result = $this->super_m->reset_passwd_update($modify_data);

                if ($result) {
                    replace($this->config->item('ADMIN_BASE_URL').'/auth/reset_password_result');
                    exit;
                } else {
                    alert('비번 재설정 시 오류가 발생했습니다.\n다시 시도하세요.', $this->config->item('ADMIN_ROOT'));
                    exit;
                }
            }

        }else{
            //URI 세그멘트 중에 암호화된 이메일을 가져온다.
            $decrypted_email = $this->uri->segment(4);

            //암호화 할 때 치환했던 문자를 다시 변경한다.
            //암호화 시 "/"가 있는 경우 세그먼트가 인식할 수 없어 "*"로 변경후 url 생성
            $decrypted_email = str_replace("*", "/", $decrypted_email);      
            $decrypted_email = $this->encryption->decrypt($decrypted_email);

            $data['auth_email'] = $decrypted_email;  
            $this->load->view('admin/auth/reset_passwd', $data);
        }     
    }
}
?>  