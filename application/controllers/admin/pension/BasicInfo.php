<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class BasicInfo extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/Pension_info_m');
        $this->config->load('setting');
    }
    function index() {
        $this->view();
    }
    function view() {
        if($_POST) {
            $com_name = $this->input->post('pension_name', TRUE);
            
            $arr = array(
                'pension_name' => $this->input->post('pension_name', TRUE),
                'pension_addr_code' => $this->input->post('pension_addr_code', TRUE),
                'pension_addr' => $this->input->post('pension_addr', TRUE),
                'pension_addr2' => $this->input->post('pension_addr2', TRUE),
                'pension_phone' => $this->input->post('pension_phone', TRUE),
                'ceo_name' => $this->input->post('ceo_name', TRUE),
                'company_reg_no' => $this->input->post('company_reg_no', TRUE),
                'pension_email' => $this->input->post('pension_email', TRUE),
                'check_in' => $this->input->post('check_in', TRUE),
                'check_out' => $this->input->post('check_out', TRUE),
                'bank' => $this->input->post('bank', TRUE),
                'bank2' => $this->input->post('bank2', TRUE),
                'bank3' => $this->input->post('bank3', TRUE),                
                'contents' => $this->input->post('contents', TRUE),                
                'contents2' => $this->input->post('contents2', TRUE),                
            );
            $result = $this->Pension_info_m->save($arr);

            if($result) {
                history(-1);
            }else {
                alert_after_history('오류 발생', -1);
            }
        }else {
            $result = $this->Pension_info_m->getData();
            $cnt = count($result);
            $setting_data = array();
            for($i=0;$i<$cnt;$i++) {
                $setting_data[$result[$i]->p_key] = $result[$i]->p_value;
            }
            $data['lt'] = $setting_data;
            $this->load->view('admin/pension/basicInfo', $data);
        }

    }
    function save() {


    }

}