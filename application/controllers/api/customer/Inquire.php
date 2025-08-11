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
class Inquire extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/inquire_m');
    }

    public function insert_post(){
        
        $insert_array = array(
            'title' => $this->input->post('title', TRUE), 
            'contents' => $this->input->post('contents', TRUE), 
            'name' => $this->input->post('name', TRUE), 
            'email' => $this->input->post('email', TRUE), 
            'phone' => $this->input->post('phone', TRUE), 
            'feedback_yn' => 'N',
            'table' => 'tb_inquire'
        );

        switch(NULL) {
            case $insert_array['title'] :
            case $insert_array['contents'] :
            case $insert_array['name'] :
            case $insert_array['email'] :
            case $insert_array['phone'] :
                $this->response([
                    'status' => FALSE,
                    'message' => 'Parameters error'
                ], REST_Controller::HTTP_OK);
                exit;
        }
 
        $result = $this->inquire_m->customer_put($insert_array);




        if($result){
            $this->load->library('Sms');

            // email
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->clear();
            $this->email->from("jooshin_@naver.com");
            $this->email->to(
                    array("help@joosh.co.kr")
                );
            $this->email->subject("[주신산업] 고객문의가 등록되었습니다.");

            $htmlContent = '<html><body>';
            $htmlContent .='<p style="color:#000;font-size:18px;font-weight:500;font-family:\'Apple Gothic\';">고객문의가 접수되었습니다.</p>';
            $htmlContent .='<br><br>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">제목 : '.$insert_array['title'].'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">이름 : '.$insert_array['name'].'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">연락처 : '.$insert_array['phone'].'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">이메일 : '.$insert_array['email'].'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">문의내용 : '.$insert_array['contents'].'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';">등록일 : '.date("Y-m-d H:i").'</p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';"></p>';
            $htmlContent .='<p style="color:#000;font-size:16px;font-weight:400;font-family:\'Apple Gothic\';"></p>';

            $htmlContent .='</body></html>';

            $this->email->message($htmlContent);

             if ($this->email->send()){
                    $this->response([
                    'status' => TRUE,
                    'message' => 'Customer Insert success'
                ], REST_Controller::HTTP_OK);
             }
             else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Email Error'
                ]);

            }
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Customer Insert error'
            ], REST_Controller::HTTP_OK);
        }
    }
}
