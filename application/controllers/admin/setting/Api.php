<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/setting_m');
        $this->config->load('setting');
    }
    function index() {
        $this->view();
    }
    function view() {
        if($_POST) {
            $arr = array(
                'google_web_code' => $this->input->post('google_web_code', TRUE),
                'google_analytics_code' => $this->input->post('google_analytics_code', TRUE),
                'google_ads_code' => $this->input->post('google_ads_code', TRUE),
                'google_client_id' => $this->input->post('google_client_id', TRUE),
                'naver_analytics_code' => $this->input->post('naver_analytics_code', TRUE),
                'naver_web_code' => $this->input->post('naver_web_code', TRUE),
                'naver_client_id' => $this->input->post('naver_client_id', TRUE),
                'naver_client_secret' => $this->input->post('naver_client_secret', TRUE),
                'fb_app_id' => $this->input->post('fb_app_id', TRUE),
                'kakao_js_key' => $this->input->post('kakao_js_key', TRUE),
                'sms_admin_sender_number' => $this->input->post('sms_admin_sender_number', TRUE),
                'sms_admin_receiver_number' => $this->input->post('sms_admin_receiver_number', TRUE),
                'sms_api_key' => $this->input->post('sms_api_key', TRUE),
                'sms_api_secret' => $this->input->post('sms_api_secret', TRUE),
                'sms_kakao_sender_key' => $this->input->post('sms_kakao_sender_key', TRUE),

            );
            $result = $this->setting_m->save($arr);

            if($result) {
                history(-1);
            }else {
                alert_after_history('오류 발생', -1);
            }
        }else {
            $result = $this->setting_m->getData();
            $cnt = count($result);
            $setting_data = array();
            for($i=0;$i<$cnt;$i++) {
                $setting_data[$result[$i]->k] = $result[$i]->v;
            }
            $data['lt'] = $setting_data;
            $this->load->view('admin/setting/api', $data);
        }

    }

}