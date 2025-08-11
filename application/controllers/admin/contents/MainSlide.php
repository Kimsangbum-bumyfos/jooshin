<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 메인슬라이드관리
	**/

class MainSlide extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/mainSlide_m');
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/contents/mainSlide/lists'.$page_url;
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
        $config['total_rows'] = $this->mainSlide_m->lists('tb_main_slide', 'count','', '', $search_word);
       // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';


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
        $data['list'] = $this->mainSlide_m->lists('tb_main_slide', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/contents/mainSlide', $data);
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
            $this->form_validation->set_rules('order_no', '순서', 'required|is_natural_no_zero');
            
            if(empty($_FILES['userfile']['name'][0])) $this->form_validation->set_rules('userfile[0]', 'pc이미지', 'required');
            if(empty($_FILES['userfile']['name'][1])) $this->form_validation->set_rules('userfile[1]', 'mobile이미지', 'required');

            if($this->form_validation->run()) {
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                //multi file upload 처리
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size'] = $files['userfile'] ['size'][$i];

                    $config['upload_path'] = '.' . $this->config->item("UPLOAD_MAIN_SLIDE");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width'] = '5000';
                    $config['max_height'] = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload()) {
                        alert_after_history('이미지 업로드에 실패하였습니다', -2);
                        exit;
                    }

                    $raw_filename[] = $this->upload->data('file_name');
                }

                $write_data = array(
                    'title_header' => $this->input->post('title_header', TRUE),
                    'title' => $this->input->post('title', TRUE),
                    'title_footer' => $this->input->post('title_footer', TRUE),
                    'text1' => $this->input->post('text1', TRUE),
                    'text2' => $this->input->post('text2', TRUE),
                    'text3' => $this->input->post('text3', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'pc_img' => $raw_filename[0],
                    'mobile_img' => $raw_filename[1],
                    'path' => $this->config->item("UPLOAD_MAIN_SLIDE"),
                    'order_no' => $this->input->post('order_no', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'link_target' => $this->input->post('link_target', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_main_slide'
                );

                $result = $this->mainSlide_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록록중 오류가 발했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $this->load->view('admin/contents/mainSlide_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/contents/mainSlide_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->mainSlide_m->get_view('tb_main_slide', $this->uri->segment(5));
        $return = $this->mainSlide_m->delete('tb_main_slide', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
            $remove_file = array(
                $data->pc_img,
                $data->mobile_img
            );
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
            $this->form_validation->set_rules('order_no', '순서', 'required|is_natural_no_zero');
//            if(empty($_FILES['userfile']['name'][0])) $this->form_validation->set_rules('userfile[0]', 'pc이미지', 'required');
//            if(empty($_FILES['userfile']['name'][1])) $this->form_validation->set_rules('userfile[1]', 'mobile이미지', 'required');

            if($this->form_validation->run()) {
                //------------파일 업로드 처리-----------//

                $this->load->library('upload');

                //multi file upload 처리
                $files=$_FILES;
                $cpt=count($_FILES['userfile']['name']);

                for($i=0; $i<$cpt; $i++){
                    $_FILES['userfile']['name']=$files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type']=$files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name']=$files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size']=$files['userfile'] ['size'][$i];

                    $config['upload_path'] = '.'.$this->config->item("UPLOAD_MAIN_SLIDE");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width']  = '5000';
                    $config['max_height']  = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    $this->upload->do_upload();



                    $raw_filename[] = $this->upload->data('file_name');
                }
                //------------파일 업로드 처리-----------//

                if($raw_filename[0]=='' || $raw_filename[0]=="" || $raw_filename[0]==null){
                    $raw_filename[0] = $this->input->post('thumb_chk', TRUE);
                } else {
                    remove_file($this->config->item("UPLOAD_MAIN_SLIDE"), $this->input->post('thumb_chk', TRUE));
                }

                if($raw_filename[1]=='' || $raw_filename[1]=="" || $raw_filename[1]==null){
                    $raw_filename[1] = $this->input->post('thumb_chk2', TRUE);
                } else {
                    remove_file($this->config->item("UPLOAD_MAIN_SLIDE"), $this->input->post('thumb_chk2', TRUE));
                }

                $modify_data = array(
                    'table' => 'tb_main_slide',
                    'idx' => $this->uri->segment(5),
                    'title_header' => $this->input->post('title_header', TRUE),
                    'title' => $this->input->post('title', TRUE),
                    'title_footer' => $this->input->post('title_footer', TRUE),
                    'text1' => $this->input->post('text1', TRUE),
                    'text2' => $this->input->post('text2', TRUE),
                    'text3' => $this->input->post('text3', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'pc_img' => $raw_filename[0],
                    'mobile_img' => $raw_filename[1],
                    'path' => $this->config->item("UPLOAD_MAIN_SLIDE"),
                    'order_no' => $this->input->post('order_no', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'link_target' => $this->input->post('link_target', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                );

                $result = $this->mainSlide_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['v'] = $v - 1;
                $data['views'] = $this->mainSlide_m->get_view('tb_main_slide', $this->uri->segment(5));
                $this->load->view('admin/contents/mainSlide_modify', $data);
            }
        } else {
            $data['v'] = $v;
            $data['views'] = $this->mainSlide_m->get_view('tb_main_slide', $this->uri->segment(5));
            $this->load->view('admin/contents/mainSlide_modify', $data);
        }
    }
}
