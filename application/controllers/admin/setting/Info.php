<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller
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
            $com_name = $this->input->post('com_name', TRUE);
            $site_contents = $this->input->post('site_contents', TRUE);
            $site_name = $this->input->post('site_name', TRUE);
            $company_email = $this->input->post('company_email', TRUE);
            $site_keyword = $this->input->post('site_keyword', TRUE);

            $this->load->library('upload');

            //multi file upload 처리
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);


            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile'] ['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile'] ['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile'] ['tmp_name'][$i];
                $_FILES['userfile']['size'] = $files['userfile'] ['size'][$i];

                $config['upload_path'] = '.' .$this->config->item("UPLOAD_LOGO");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);
                $this->upload->do_upload();


                $raw_filename[] = $this->upload->data('file_name');
            }
            //------------파일 업로드 처리-----------//

            if ($raw_filename[0] == '' || $raw_filename[0] == "" || $raw_filename[0] == null) {
                $raw_filename[0] = $this->input->post('thumb_chk', TRUE);
                $raw_filename[0] = str_replace($this->config->item("UPLOAD_LOGO").'/', '', $raw_filename[0]);
            }

            if ($raw_filename[1] == '' || $raw_filename[1] == "" || $raw_filename[1] == null) {
                $raw_filename[1] = $this->input->post('thumb_chk2', TRUE);
                $raw_filename[1] = str_replace($this->config->item("UPLOAD_LOGO").'/', '', $raw_filename[1]);
            }

            if ($raw_filename[2] == '' || $raw_filename[2] == "" || $raw_filename[2] == null) {
                $raw_filename[2] = $this->input->post('thumb_chk3', TRUE);
                $raw_filename[2] = str_replace($this->config->item("UPLOAD_LOGO").'/', '', $raw_filename[2]);
            }

            if ($raw_filename[3] == '' || $raw_filename[3] == "" || $raw_filename[3] == null) {
                $raw_filename[3] = $this->input->post('thumb_chk4', TRUE);
                $raw_filename[3] = str_replace($this->config->item("UPLOAD_LOGO").'/', '', $raw_filename[3]);
            }

            $arr = array(
                'com_name' => $com_name,
                'company_addr_code' => $this->input->post('company_addr_code', TRUE),
                'company_addr' => $this->input->post('company_addr', TRUE),
                'company_addr2' => $this->input->post('company_addr2', TRUE),
                'company_phone' => $this->input->post('company_phone', TRUE),
                'company_fax' => $this->input->post('company_fax', TRUE),
                'ceo_name' => $this->input->post('ceo_name', TRUE),
                'company_reg_no' => $this->input->post('company_reg_no', TRUE),
                'mail_order_sales_report_no' => $this->input->post('mail_order_sales_report_no', TRUE),
                'privacy_mgr' => $this->input->post('privacy_mgr', TRUE),
                'copyright' => $this->input->post('copyright', TRUE),
                'site_contents' => $site_contents,
                'site_name' => $site_name,
                'company_email' => $company_email,
                'site_keyword' => $site_keyword,
                'logo_pc' => $this->config->item("UPLOAD_LOGO").'/'.$raw_filename[0],
                'logo_pc_sub' => $this->config->item("UPLOAD_LOGO").'/'.$raw_filename[1],
                'logo_mobile' => $this->config->item("UPLOAD_LOGO").'/'.$raw_filename[2],
                'logo_pc_footer' => $this->config->item("UPLOAD_LOGO").'/'.$raw_filename[3]
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
            $this->load->view('admin/setting/info', $data);
        }

    }
    function save() {


    }

}