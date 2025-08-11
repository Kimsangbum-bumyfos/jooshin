<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Auth extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/member_m');
        $this->config->load('setting');
    }
    //회원가입
    public function register_post(){
        $user_name = $this->input->post('user_name', TRUE);
        $user_id = $this->input->post('user_id', TRUE);
        $user_phone = $this->input->post('user_phone', TRUE);
        $agreement = $this->input->post('agreement', TRUE);
        $sns_type = $this->input->post('sns_type', TRUE);
        $sns_id = $this->input->post('sns_id', TRUE);


        //sns 가입과 일반 가입 구분
        if($sns_type) {
            $arrays = array(
                'sns_type' => $sns_type,
                'sns_id' => $sns_id,
                'user_name' => $user_name,
                'user_id' => $user_id,
                'user_phone' => $user_phone,
                'agreement' => $agreement
            );

            //sns 회원가입 validation
            switch (NULL) {
                case $arrays['user_name'] :
                case $arrays['user_id'] :
                case $arrays['user_phone'] :
                case $arrays['sns_id'] :
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Parameters ErrorFORSNS'
                    ], REST_Controller::HTTP_OK);
                    break;
            }

        } else {
            $user_passwd = $this->input->post('user_passwd', TRUE);
            if(!$user_passwd) $encrypted_passwd = '';
            else {
                //비밀번호 암호화
                $this->load->library('encrypt');
                $encrypted_passwd = $this->encrypt->encode($this->input->post('user_passwd', TRUE));
            }

            $arrays = array(
                'user_name' => $user_name,
                'user_id' => $user_id,
                'user_phone' => $user_phone,
                'user_passwd' => $encrypted_passwd,
                'agreement' => $agreement
            );

            // 일반 가입 validation
            switch (NULL) {
                case $arrays['user_name'] :
                case $arrays['user_id'] :
                case $arrays['user_phone'] :
                case $encrypted_passwd :
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Parameters Error'
                    ], REST_Controller::HTTP_OK);
                    exit;
            }

        }


        $result = $this->member_m->idDuplChk($this->input->post('user_id', TRUE));

        //아이디 중복 체크
        if($result){
            $this->response([
                'status' => FALSE,
                'join_with' => $result[0]->sns_type,
                'message' => 'Member ID Duplicate'
            ], REST_Controller::HTTP_OK);
        }else{
            $result = $this->member_m->member_insert($arrays);
            if($result){
                $this->response([
                    'status' => TRUE,
                    'message' => 'Member Insert Success'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Member Insert Error'
                ], REST_Controller::HTTP_OK);
            }
        }
    }

    //회원 아이디 찾기
    public function findID_post(){

        $this->load->model('api/member_m');

        $user_name = $this->input->post('user_name', TRUE);
        $user_phone = $this->input->post('user_phone', TRUE);

        switch (NULL) {
            case $user_phone :
            case $user_name :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter Error'
                ]);
                exit;
        }

        $arrays = array(
            'user_name' => $user_name,
            'user_phone' => $user_phone
        );

        $result = $this->member_m->findID($arrays);

        if($result){
            if($result[0]->sns_type) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Member joined '.$result[0]->sns_type
                ]);
            }else {
                $this->response([
                    'status' => TRUE,
                    'message' => 'Member findID Success',
                    'result' => $result
                ], REST_Controller::HTTP_OK);
            }
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Member findID Error'
            ]);
        }
    }

    //회원 패스워드 찾기
    public function findPasswd_post(){

        $this->load->model('api/member_m');
        $user_id = $this->input->post('user_id', TRUE);
        $user_name = $this->input->post('user_name', TRUE);

        switch (NULL) {
            case $user_id :
            case $user_name :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter Error'
                ]);
                exit;
        }

        $arrays = array(
            'user_name' => $user_name,
            'user_id' => $user_id,
        );

        $result = $this->member_m->findPasswd($arrays);

        //패스워드 찾는 유저가 있는 경우 패스워드를 받아서 메일 전송 한다.
        //메일 전송이 완료되면 결과 리턴한다.
        if($result){
            if($result[0]->sns_type) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Member joined '.$result[0]->sns_type
                ]);
                exit;
            }

            //이메일 암호화 처리 후 reset 페이지 URL 생성 후 메일 전송
            $this->load->library('encrypt');
            $encrypted_user_id = $this->encrypt->encode($user_id);

            //암호화 시 세그먼트로 인식되어서 "/"를 "*"로 치환한다.
            $encrypted_user_id = str_replace("/", "*", $encrypted_user_id);

            //메일로 전송할 비번 재설정 페이지 URL 셋팅
            $send_url = base_url().'home/auth/reset_passwd/'.$encrypted_user_id;

            $data['url'] = $send_url;
            $htmlContent = $this->load->view('admin/auth/reset_passwd_email', $data, true);

            //이메일 libray 로드
            $this->load->library('email');

            $this->email->set_newline("\r\n");
            $this->email->clear();
            $this->email->from("help@thefrom.kr");
            $this->email->to($user_id);
            $this->email->subject("패스워드 재설정");
            $this->email->message($htmlContent);


            if ($this->email->send()){
                //이메일 전송이 완료되면 비번변경 유효기간 설정을 위한 시간을 업데이트한다.
                $result = $this->member_m->passwd_reset_send_date($this->input->post('user_id', TRUE));

                if($result){
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Reset Password Email Success'
                    ]);
                }else{
                    $this->response([
                        'status' => FALSE,
                        'message' => 'Reset Password valid Time Error'
                    ]);
                }
            }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Reset Password Email Error'
                ]);

            }
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Member NO DATA'
            ], REST_Controller::HTTP_OK);
        }
    }
    public function info_get() {
        $idx = $this->session->userdata('user_idx');
        if(!$idx) {
            $this->response([
                'status' => FALSE,
                'message' => 'Error'
            ]);
        }
        $data = $this->member_m->getData($idx);
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

    //회원정보수정
    public function modify_post(){

        $idx = $this->session->userdata('user_idx');
        $user_name = $this->input->post('user_name', TRUE);
        $user_phone = $this->input->post('user_phone', TRUE);
        $auth_pass = $this->input->post('auth_pass', TRUE);
        $user_pass = $this->input->post('user_passwd', TRUE);
        $sns_type = $this->input->post('sns_type', TRUE);

        $encrypted_passwd = null;
        $this->load->library('encrypt');

        if(!$sns_type) {
            if(!$user_pass || !$auth_pass) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter Error'
                ], REST_Controller::HTTP_OK);
            }else {
                $check_pass = $this->member_m->getPass($idx);
                if($this->encrypt->decode($check_pass->user_passwd) !== $auth_pass) {
                    $this->response([
                        'status' => FALSE,
                        'message' => 'PW invalidate'
                    ], REST_Controller::HTTP_OK);
                }

                $encrypted_passwd = $this->encrypt->encode($user_pass);
            }

        }
        switch(NULL) {
            case $idx :
            case $user_name :
            case $user_phone :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter Error'
                ], REST_Controller::HTTP_OK);
                exit;
        }


        $arrays = array(
            'idx' => $idx,
            'user_name' => $user_name,
            'user_phone' => $user_phone,
            'user_passwd' => $encrypted_passwd,
            'agreement' => $this->input->post('agreement', TRUE),
            'table' => 'tb_member',
        );

        $result = $this->member_m->member_modify($arrays);

        if($result){
            $this->response([
                'status' => TRUE,
                'message' => 'Member Update Success'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Member Update Error'
            ], REST_Controller::HTTP_OK);
        }

    }

    public function login_post(){
        //SNS 로그인
        $sns_type = $this->input->post('sns_type', TRUE);
        if($sns_type) {
            $result = $this->member_m->loginWithSns($sns_type, $this->input->post('sns_id', TRUE));
            if(!$result) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID/PW invalidate'
                ], REST_Controller::HTTP_OK);
            }else {
                $newdata = array(
                    'user_idx' => $result->idx,
                    'user_name' => $result->user_name,
                    'user_phone' => $result->user_phone,
                    'logged_in' => TRUE,
                    'rank' => 'normal'
                );
                $this->session->set_userdata($newdata);

                log_message('LOG', '로그인 성공(SNS) [user_idx] : '.$result->idx);
                $this->response([
                    'status' => TRUE,
                    'message' => 'login Success'
                ], REST_Controller::HTTP_OK);
            }
        }
        //



        $user_id = $this->input->post('user_id', TRUE);
        log_message('LOG', '로그인 시도 [user_id] : '.$user_id);
        //비밀번호 암호화
        $this->load->library('encrypt');
        $result = $this->member_m->login($user_id);

        if(!$result){
            log_message('LOG', '로그인 실패 [user_id] : '.$user_id);
            $this->response([
                'status' => FALSE,
                'message' => 'ID/PW invalidate'
            ], REST_Controller::HTTP_OK);

        }else{
            $db_passwd = $result->user_passwd;

            //암호화된 패스워드를 복호화한다.(입력된 패스워드와 비교)
            $d_passwd = $this->encrypt->decode($db_passwd);
            if($d_passwd == $this->input->post('user_passwd')) {
                $newdata = array(
                    'user_idx' => $result->idx,
                    'user_name' => $result->user_name,
                    'user_phone' => $result->user_phone,
                    'logged_in' => TRUE,
                    'rank' => 'normal'
                );
                $this->session->set_userdata($newdata);

                log_message('LOG', '로그인 성공 [user_id] : '.$user_id);
                $this->response([
                    'status' => TRUE,
                    'message' => 'login Success'
                ], REST_Controller::HTTP_OK);

            }else {
                log_message('LOG', '로그인 실패 [user_id] : '.$user_id);
                $this->response([
                    'status' => FALSE,
                    'message' => 'ID/PW invalidate'
                ], REST_Controller::HTTP_OK);
            }

        }

    }
}
