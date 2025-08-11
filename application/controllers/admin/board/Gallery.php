<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');
	
/**
* 갤러리 관리
**/
class Gallery extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/gallery_m');
        $this->load->model('cke_files_m');
        $this->config->load('setting');
        $this->load->library('form_validation');
    }

    function index(){
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/board/gallery/lists'.$page_url;
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
//
        // 게시물 전체 개수
        $config['total_rows'] = $this->gallery_m->lists('tb_board', 'count','', '', $search_word);

//
//        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

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

        $limit = $config['per_page'];

        $data['total_row'] = $config['total_rows'];
 
        $data['list'] = $this->gallery_m->lists('tb_board', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/board/gallery', $data);
    }

    //글 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
        
        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history
        $this->load->helper('string');

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            $this->form_validation->set_rules('title', '제목', 'required');
            
            if(empty($_FILES['userfile']['name'][0])) $this->form_validation->set_rules('userfile[0]', '대표이미지', 'required'); 
            if($this->form_validation->run()) {


                $this->load->library('upload');

                //multi file upload 처리
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                $img_name = array();

                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                    $config['upload_path'] = '.' . $this->config->item("UPLOAD_GALLERY");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width'] = '5000';
                    $config['max_height'] = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    $this->upload->do_upload();

                    $img_name[] = $this->upload->data('file_name');
                }    

                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'contents' => $this->input->post('contents', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'board_type' => 'GALLERY',
                    'thumb_img' => $img_name[0],
                    'gall_img1' => $img_name[1],
                    'gall_img2' => $img_name[2],
                    'gall_img3' => $img_name[3],
                    'gall_img4' => $img_name[4],
                    'gall_img5' => $img_name[5],
                    'gall_img6' => $img_name[6],
                    'gall_img7' => $img_name[7],
                    'gall_img8' => $img_name[8],
                    'contents' => $this->input->post('contents', TRUE),
                    'path' => $this->config->item("UPLOAD_GALLERY"),
                    'cke_key' => $this->input->post('k', TRUE),
                    'reg_date' => date('Y-m-d H:i:s')                    
                );

                $result = $this->gallery_m->insert($write_data);

                if ($result) {
                    //history($v);
                    replace($this->config->item('ADMIN_ROOT').'/board/gallery');
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['hash'] = random_string('alnum', 32);
                while(!$this->cke_files_m->checkKey($data['hash'])) {
                    $data['hash'] = random_string('alnum', 32);
                }
                $data['v'] = $v - 1;
                $this->load->view('admin/board/gallery_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }
            $data['v'] = $v;
            $this->load->view('admin/board/gallery_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->gallery_m->get_view('tb_board', $this->uri->segment(5));
        $return = $this->gallery_m->delete('tb_board', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
            $remove_file = array(
                $data->thumb_img,
                $data->gall_img1,
                $data->gall_img2,
                $data->gall_img3,
                $data->gall_img4,
                $data->gall_img5,
                $data->gall_img6,
                $data->gall_img7,
                $data->gall_img8
            );
          
            remove_files($data->path, $remove_file);
            $remove_file = $this->cke_files_m->getPath($data->cke_key);

            if($remove_file) {
                $remove_file = explode(',', $remove_file);
                remove_files('/uploads/cke_upload', $remove_file);
            }
            $this->cke_files_m->delete($data->cke_key);

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
            
            if($this->form_validation->run()) {

                $this->load->library('upload');

                //multi file upload 처리
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                $img_name = array();

                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                    $config['upload_path'] = '.' . $this->config->item("UPLOAD_GALLERY");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width'] = '5000';
                    $config['max_height'] = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    $this->upload->do_upload();

                    $img_name[] = $this->upload->data('file_name');
                }

                if (!$img_name[0])  $img_name[0] = $this->input->post('thumb_chk1', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk1', TRUE));
                if (!$img_name[1])  $img_name[1] = $this->input->post('thumb_chk2', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk2', TRUE));
                if (!$img_name[2])  $img_name[2] = $this->input->post('thumb_chk3', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk3', TRUE));
                if (!$img_name[3])  $img_name[3] = $this->input->post('thumb_chk4', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk4', TRUE));
                if (!$img_name[4])  $img_name[4] = $this->input->post('thumb_chk5', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk5', TRUE));
                if (!$img_name[5])  $img_name[5] = $this->input->post('thumb_chk6', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk6', TRUE));
                if (!$img_name[6])  $img_name[6] = $this->input->post('thumb_chk7', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk7', TRUE));
                if (!$img_name[7])  $img_name[7] = $this->input->post('thumb_chk8', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk8', TRUE));
                if (!$img_name[8])  $img_name[8] = $this->input->post('thumb_chk9', TRUE);
                else remove_file($this->config->item("UPLOAD_GALLERY"), $this->input->post('thumb_chk9', TRUE));
                 
                $modify_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'contents' => $this->input->post('contents', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'board_type' => 'GALLERY',
                    'thumb_img' => $img_name[0],
                    'gall_img1' => $img_name[1],
                    'gall_img2' => $img_name[2],
                    'gall_img3' => $img_name[3],
                    'gall_img4' => $img_name[4],
                    'gall_img5' => $img_name[5],
                    'gall_img6' => $img_name[6],
                    'gall_img7' => $img_name[7],
                    'gall_img8' => $img_name[8],
                    'contents' => $this->input->post('contents', TRUE),
                    'path' => $this->config->item("UPLOAD_GALLERY"),
                    'modi_date' => date('Y-m-d H:i:s')
                );

                $gallery_idx  = $this->uri->segment(5);
                $result = $this->gallery_m->modify($modify_data, $gallery_idx);

                if ($result) {
                    //history($v);
                    replace($this->config->item('ADMIN_ROOT').'/board/gallery');
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->gallery_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/gallery_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->gallery_m->get_view('tb_board', $this->uri->segment(5));
            $this->load->view('admin/board/gallery_modify', $data);
        }
    }
}
