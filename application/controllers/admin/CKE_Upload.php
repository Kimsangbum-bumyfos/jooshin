<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * cke editor file upload
 **/

class CKE_Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->config->load('setting');
        $this->load->model('cke_files_m');
    }

    //글 등록
    function upload() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //------------파일 업로드 처리-----------//
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG';
        $config['max_size'] = '10485760';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';


        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $data = $this->upload->do_upload();

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    function cke_upload() {
        //echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //------------파일 업로드 처리-----------//
        $config['upload_path'] = './uploads/cke_upload';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG';
        $config['max_size'] = '10485760';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';

        //파일명을 암호화하여 처리한다. 한글 파일명때문에 적용
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $data = $this->upload->do_upload('upload');

        if (!$data){
//            $error = array('error' => $this->upload->display_errors());
//            $this->upload->display_errors();
            alert_after_history($this->upload->display_errors(), -1);
        }else{
            $CKEditorFuncNum = $this->input->get("CKEditorFuncNum");
            $k = $this->input->get("k");
            $data = $this->upload->data();
            $filename = $data["file_name"];
            $url =$this->config->item('UPLOAD_DIR')."/cke_upload/". $filename;
            $this->load->model('cke_files_m');
            $this->cke_files_m->setPath($k, $filename);

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송이 완료되었습니다.')</script>";

            //'{"filename" : "'.$filename.'", "uploaded" : 1, "url":"'.$url.'"}';
        }
    }
}

