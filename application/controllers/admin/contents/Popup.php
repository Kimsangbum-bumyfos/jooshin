<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 팝업관리
	**/

class Popup extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/popup_m');
        $this->config->load('setting');
        $this->load->library('form_validation');
    }

    public function index() {
       $this->lists();
    }

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

         $this->load->library('pagination');

 
        $data['search_word'] = "";
        $page_url = '';
        if ($search_word = $this->input->get('search_word')) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }
        
        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/contents/popup/lists'.$page_url;
        $config['page_query_string']        = TRUE;
        $config['enable_query_string']      = TRUE;
        $config['cur_tag_open']             = '<a class="active">';
        $config['cur_tag_close']            = '</a>';
        $config['next_tag_open']            = '<span class="ico-next">';
        $config['next_tag_close']           = '</span>';
        $config['next_link']                = '';
        $config['prev_tag_open']            = '<span class="ico-prev">';
        $config['prev_tag_close']           = '</span>';
        $config['prev_link']                = '';
        $config['use_page_number']          = TRUE;
        // 게시물 전체 개수
        $config['total_rows'] = $this->popup_m->lists('tb_popup', 'count','', '', $search_word);
        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);
        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this->input->get('page', 1);

        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = 0;
            $page = 1;
        }

        $data['limit'] = $config['per_page'];
        $data['page'] = $page;
        $data['total_row'] = $config['total_rows'];
        $data['list'] = $this->popup_m->lists('tb_popup', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/contents/popup', $data);
    }

    //글 등록
    function write() {

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history
        //post로 전송된 값이 있을 경우
        if ($_POST){
            //file upload class load...
            $this->load->library('upload');

            $this->form_validation->set_rules('title', '제목', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');
            if(empty($_FILES['userfile']['name'][0])) $this->form_validation->set_rules('userfile[0]', 'pc이미지', 'required');
            if(empty($_FILES['userfile']['name'][1])) $this->form_validation->set_rules('userfile[1]', 'mobile이미지', 'required');

            if($this->form_validation->run()) {
                //multi file upload 처리
                $files=$_FILES;
                $cpt=count($_FILES['userfile']['name']);


                for($i=0; $i<$cpt; $i++){
                    $_FILES['userfile']['name']=$files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type']=$files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name']=$files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size']=$files['userfile'] ['size'][$i];

                    $config['upload_path'] = '.'.$this->config->item("UPLOAD_POPUP");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width']  = '5000';
                    $config['max_height']  = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload()) {
                        alert_after_history('이미지 업로드에 실패하였습니다', -2);
                        exit;
                    }

                    $raw_filename[] = $this->upload->data('file_name');
                }

                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'popup_type' => $this->input->post('popup_type', TRUE),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'device_type' => $this->input->post('device_type', TRUE),
                    'cookie_yn' => $this->input->post('cookie_yn', TRUE),
                    'pc_img' => $raw_filename[0],
                    'mobile_img' => $raw_filename[1],
                    'path' => $this->config->item("UPLOAD_POPUP"),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'link_target' => $this->input->post('link_target', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_popup'
                );

                $result = $this->popup_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                //validation failed...
                $data['v'] = $v - 1;
                $this->load->view('admin/contents/popup_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/contents/popup_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->popup_m->get_view('tb_popup', $this->uri->segment(5));
        $return = $this->popup_m->delete('tb_popup', $this->uri->segment(5));
        $v = $this->input->get('v');
        
        if ($return) {
            $remove_file = array(
                $data->pc_img,
                $data->mobile_img
            );
            // log_message('LOG', $data->pc_img);
            // log_message('LOG', $data->mobile_img);
            remove_files($data->path, $remove_file);
            history($v);
            exit;
        } else {
            alert_after_history('삭제중 오류가 발생했습니다', $v);
            exit;
        }        
    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        if ($_POST) {
            $this->form_validation->set_rules('title', '제목', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');

            //------------파일 업로드 처리-----------//
            if($this->form_validation->run()) {
                $this->load->library('upload');

                //multi file upload 처리
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);

                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size'] = $files['userfile'] ['size'][$i];

                    $config['upload_path'] = '.' .$this->config->item("UPLOAD_POPUP");
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
                $upload_path = $this->config->item("UPLOAD_POPUP");

                if (!$raw_filename[0]) {
                    $raw_filename[0] = $this->input->post('thumb_chk', TRUE);
                } else {
                    remove_file($upload_path, $this->input->post('thumb_chk', TRUE));
                }

                if (!$raw_filename[1]) {
                    $raw_filename[1] = $this->input->post('thumb_chk2', TRUE);
                } else {
                    remove_file($upload_path, $this->input->post('thumb_chk2', TRUE));
                }

                $modify_data = array(
                    'table' => 'tb_popup',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    'popup_type' => $this->input->post('popup_type', TRUE),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'device_type' => $this->input->post('device_type', TRUE),
                    'cookie_yn' => $this->input->post('cookie_yn', TRUE),
                    'pc_img' => $raw_filename[0],
                    'mobile_img' => $raw_filename[1],
                    'path' => $upload_path,
                    'link_url' => $this->input->post('link_url', TRUE),
                    'link_target' => $this->input->post('link_target', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                );

                $result = $this->popup_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $data['views'] = $this->popup_m->get_view('tb_popup', $this->uri->segment(5));
                $this->load->view('admin/contents/popup_modify', $data);
            }
        } else {
            $data['v'] = $v;
            $data['views'] = $this->popup_m->get_view('tb_popup', $this->uri->segment(5));
            $this->load->view('admin/contents/popup_modify', $data);
        }
    }
}
