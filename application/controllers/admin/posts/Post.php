<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/**
* 포스트 관리
**/
class Post extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script','manage_files'));
        $this->load->model('admin/post_m');
        $this->config->load('setting');
        $this->load->library('form_validation');
        $this->load->model('cke_files_m');      

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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/posts/post/lists'.$page_url;
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
        $config['total_rows'] = $this->post_m->lists('tb_posts', 'count','', '', $search_word);


        // 한 페이지에 표시할 게시물 수
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
 
        $data['list'] = $this->post_m->lists('tb_posts', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/posts/post', $data);
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
            $this->form_validation->set_rules('sub_title', '하위제목', 'required');
            $this->form_validation->set_rules('contents', '내용', 'required');
            if(empty($_FILES['userfile']['name'])) $this->form_validation->set_rules('userfile', '썸네일 이미지', 'required');
 
            if($this->form_validation->run()) {
                //------------파일 업로드 처리-----------//
                $config['upload_path'] = '.'.$this->config->item("UPLOAD_POSTS");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload()) {
                    alert_after_history('이미지 업로드에 실패하였습니다', -2);
                    exit;
                }

                //해당 메뉴 코드에 해당하는 menu_up_code를 가져온다. 
                //서브 메뉴가 넘어온 경우에는 menu_up_code가 있으며, 
                $menu_up_code = $this -> post_m -> getMenuUpCode($this -> input -> post('menu_code', TRUE));
                
                //file upload..
                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'sub_title' => $this->input->post('sub_title', TRUE),
                    'excerpt' => $this->input->post('excerpt', TRUE),
                    'menu_code' => $this->input->post('menu_code', TRUE),
                    'menu_up_code' => $menu_up_code,
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'thumb_img' => $this->upload->data('file_name'),
                    'path' => $this->config->item("UPLOAD_POSTS"),
                    'reg_date' => date('Y-m-d H:i:s')
                );
                $result = $this->post_m->insert($write_data);

                if ($result) {
                   //history($v+1);
                   //alert_after_history('등록되었습니다.', -2);
                   //에디터에서 이미지 첨부한 경우 이전으로 안감 
                   replace($this->config->item('ADMIN_ROOT').'/posts/post');
                   exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            }else{

                $data['hash'] = random_string('alnum', 32);
                while(!$this->cke_files_m->checkKey($data['hash'])) {
                    $data['hash'] = random_string('alnum', 32);
                }
                $data['v'] = $v-1;
                $data['menuList'] = $this -> post_m -> getMenuList();
                $this->load->view('admin/posts/post_write', $data);
            }
        } else {
            
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }

            $data['v'] = $v;
            $data['menuList'] = $this -> post_m -> getMenuList();
            $this->load->view('admin/posts/post_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->post_m->delete('tb_posts', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
            alert_after_history('삭제 되었습니다', $v);
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
            $this->form_validation->set_rules('sub_title', '하위제목', 'required');
            $this->form_validation->set_rules('contents', '내용', 'required');

            if($this->form_validation->run()) {
                $config['upload_path'] = '.'.$this->config->item("UPLOAD_POSTS");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload();


                if($this->upload->data('file_name')==''){
                    $real_file_name = $this->input->post('thumb_chk', TRUE);
                }else{
                    $real_file_name = $this->upload->data('file_name');
                }

                $modify_menu_up_code = $this->post_m->getMenuUpCode($this->input->post('menu_code', TRUE));

                $modify_data = array(
                    'table' => 'tb_posts',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    'sub_title' => $this->input->post('sub_title', TRUE),
                    'menu_code' => $this->input->post('menu_code', TRUE),
                    'menu_up_code' => $modify_menu_up_code,
                    'excerpt' => $this->input->post('excerpt', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'tags' => $this->input->post('tags', TRUE),
                    'thumb_img' => $real_file_name,
                    'path' => $this->config->item("UPLOAD_POSTS")
                );

                $result = $this->post_m->modify($modify_data);

                if ($result) {
                    replace($this->config->item('ADMIN_ROOT').'/posts/post');
                    //alert_after_history('수정 되었습니다', $v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->post_m->get_view('tb_posts', $this->uri->segment(5));
            $data['menuList'] = $this->post_m->getModiMenuList($data['views']->menu_code);
            $this->load->view('admin/posts/post_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->post_m->get_view('tb_posts', $this->uri->segment(5));
            $data['menuList'] = $this->post_m->getModiMenuList($data['views']->menu_code);
            $this->load->view('admin/posts/post_modify', $data);
        }
    }
}
