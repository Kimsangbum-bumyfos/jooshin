<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sns extends CI_Controller
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
                'sns_navertv_url' => $this->input->post('sns_navertv_url', TRUE),
                'sns_naverblog_url' => $this->input->post('sns_naverblog_url', TRUE),
                'sns_fb_url' => $this->input->post('sns_fb_url', TRUE),
                'sns_youtube_url' => $this->input->post('sns_youtube_url', TRUE),
                'sns_insta_url' => $this->input->post('sns_insta_url', TRUE),
                'sns_kakaostory_url' => $this->input->post('sns_kakaostory_url', TRUE),
                'sns_kakaoplus_url' => $this->input->post('sns_kakaoplus_url', TRUE),
                'sns_navertalk_url' => $this->input->post('sns_navertalk_url', TRUE),
                'sns_kakao_id' => $this->input->post('sns_kakao_id', TRUE),
                'sns_kakaoplus_id' => $this->input->post('sns_kakaoplus_id', TRUE),
                'sns_navertalk_id' => $this->input->post('sns_navertalk_id', TRUE)
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
            $this->load->view('admin/setting/sns', $data);
        }
    }

}