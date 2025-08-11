<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
class Reservation extends REST_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('api/reservation_m');
    }

    function insert_post() {

        $car_type = $this->input->post('car_type', TRUE);
        $car_name = $this->input->post('car_name', TRUE);
        $reserve_name = $this->input->post('reserve_name', TRUE);
        $reserve_phone = $this->input->post('reserve_phone', TRUE);
        $license_type = $this->input->post('license_type', TRUE);
        $license_valid_date = $this->input->post('license_valid_date', TRUE);
        $rental_branch = $this->input->post('rental_branch', TRUE);
        $rental_s_date = $this->input->post('rental_s_date', TRUE);
        $rental_e_date = $this->input->post('rental_e_date', TRUE);
        $insur_svc = $this->input->post('insur_svc', TRUE);
        $operate_svc = $this->input->post('operate_svc', TRUE);
        $release_svc = $this->input->post('release_svc', TRUE);
        $isMobile = $this->input->post('isMobile', TRUE);
        $estimate = $this->input->post('estimate', TRUE);

        switch (NULL) {
            case $car_type :
            case $car_name :
            case $reserve_name :
            case $reserve_phone :
            case $license_type :
            case $license_valid_date :
            case $rental_branch :
            case $rental_s_date :
            case $rental_e_date :
            case $insur_svc :
            case $operate_svc :
            case $release_svc :
            case $isMobile :
            case is_numeric($estimate) :

                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter ERROR'
                ]);
                exit;
        }


        $arrays = array(
            'user_idx' => $this->session->userdata('rank') === 'normal' ? $this->session->userdata('user_idx') : NULL,
            'car_type' => $car_type,
            'car_name' => $car_name,
            'reserve_name' => $reserve_name,
            'reserve_phone' => $reserve_phone,
            'license_type' => $license_type,
            'license_valid_date' => $license_valid_date,
            'rental_branch' => $rental_branch,
            'rental_s_date' => $rental_s_date,
            'rental_e_date' => $rental_e_date,
            'insur_svc' => $insur_svc,
            'operate_svc' => $operate_svc,
            'release_svc' => $release_svc,
            'isMobile' => $isMobile,
            'estimate' => $estimate,
            'reserve_date' => date('Y-m-d H:i:s')
        );

        $result = $this->reservation_m->insert($arrays);

        if($result){
            $this->load->library('Sms');
            //관리자 SMS 전송
            $arr = array(
                'from' => $this->config->item('SMS_SEND_NUMBER_ADMIN'),
                'type' => $this->config->item('SMS_TYPE'),
                'to' => $this->config->item('SMS_RECEIVE_NUMBER_ADMIN'),
                'text' => '예약이 접수되었습니다.
예약자명 : '.$reserve_name.'
신청일 : '.$arrays["reserve_date"].'
연락처 : '.$reserve_phone.'
대여차량 : '.$car_name.'
대여기간 : '.substr($rental_s_date, 0,16).'~'.substr($rental_e_date, 0, 16),
                'kakao_template' => 'RE_ADMIN',
                'kakao_button_name' => '예약현황',
                'kakao_button_url' => base_url().'admin/rent/reservation',

            );
            $this->sms->sendSimpleMessage($arr);

            //예약자 SMS 전송
            $arr = array(
                'from' => $this->config->item('SMS_SEND_NUMBER_ADMIN'),
                'type' => $this->config->item('SMS_TYPE'),
                'to' => $reserve_phone,
                'text' => '감사합니다.예약이 요청되었습니다.
예약자 : '.$reserve_name.'
신청일 : '.$arrays["reserve_date"].'
대여기간 : '.substr($rental_s_date, 0,16).'~'.substr($rental_e_date, 0, 16).'
대여차량 : '.$car_name.'
예상금액 : '.$estimate.'원',
                'kakao_template' => 'RE_USER',
                'kakao_button_name' => '예약 확인하기',
                'kakao_button_url' => base_url().'home/reservation/viewinfo',

            );
            $this->sms->sendSimpleMessage($arr);

            $this->response([
                'status' => TRUE,
                'message' => 'Reservation Insert Success'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Reservation Insert Error'
            ]);
        }
    }

    function viewInfo_get() {
        if($this->session->userdata('rank') === 'normal' && $this->session->userdata('user_idx')) {
            $data = $this->reservation_m->getData('', '', $this->session->userdata('user_idx'));
        }else {
            $user_name = urldecode($this->input->get('user_name', TRUE));
            $user_phone = $this->input->get('user_phone', TRUE);

            if(!$user_name || !$user_phone) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameter ERROR'
                ]);
                exit;
            }
            $data = $this->reservation_m->getData($user_name, $user_phone);
        }

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
    }

}