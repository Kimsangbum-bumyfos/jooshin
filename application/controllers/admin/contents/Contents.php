<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
/**
* Contents 관리
**/

class Contents extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date','form','segment'));
        $this -> load -> model('contents_m');
        $this->config->load('setting');

        //*******헤더 예약, 문의 Noti(공통)*********************
        $this -> load -> model('header_m');
        $this->reserv_list();
        //*******************************************************

        //*******로그인 세션 체크*********************
        $this -> load -> helper('alert');
        if ($this->session->userdata('auth_name') == '') {
            alert('비정상적인 접근입니다.', $this->config->item('ADMIN_ROOT').'/login');
            exit ;
        }
        //*******************************************************     
    }

    public function index() {
      
        $this -> lists();         
    }

    //리스트 페이지
    public function lists() {
         echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        // 페이지 네이션 설정
        $this -> load -> library('my_pagination');
        $this->config->load('pagination');

        // 검색어 초기화
        $search_word = $page_url = $page_url2 = $filter_code= '';
        $uri_segment = 5;
        
        // 주소 중에서 q(검색어) 세그먼트가 있는 지 검사하기 위해 주소를 배열로 반환
        $uri_array = segment_explode($this -> uri -> uri_string());
 
        if (in_array('filter', $uri_array)) {
            // 주소에 검색어가 있을 경우 처리
            $filter_code = urldecode(url_explode($uri_array, 'filter'));
            $page_url2 = '/filter/' . $filter_code;
            if (in_array('q', $uri_array)) {
                $uri_segment = 9;
            }else{
                $uri_segment = 7;
            }   
        }

        if (in_array('q', $uri_array)) {
            // 주소에 검색어가 있을 경우 처리
            $search_word = urldecode(url_explode($uri_array, 'q'));
            $page_url = '/q/' . $search_word;
            if (in_array('filter', $uri_array)) {
                $uri_segment = 9;
            }else{
                $uri_segment = 7;
            }      
        }
        
        // 페이징 주소
        $config['base_url'] = $this->config->item('ADMIN_ROOT').'/contents/lists/'.$page_url2.$page_url.'/page/'; 
                
        // 게시물 전체 개수    
        $config['total_rows'] = $this -> contents_m -> lists('fr_posts', 'count','', '', $search_word, $filter_code);

        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;
        //$config['per_page']=  $this->config->item('per_page');
        
        // 페이지 번호가 위치한 세그먼트
        $config['uri_segment'] = $uri_segment;
      
        $config['full_tag_open'] =$this->config->item('full_tag_open');
        $config['full_tag_close'] =$this->config->item('full_tag_close');

        // 페이지네이션 초기화
        $this -> my_pagination -> initialize($config);
        
        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['my_pagination'] = $this -> my_pagination -> create_links();

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this -> uri -> segment($uri_segment, 1);
         
        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = ($page - 1) * $config['per_page'];
        }

        $limit = $config['per_page'];
 
        $data['list'] = $this -> contents_m -> lists('fr_posts', '', $start, $limit, $search_word,$filter_code);
        $data['getMenuList'] = $this -> contents_m -> get_MenuList();
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this -> load -> view('admin/contents', $data);
    }
   

    //글 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
 
        //post로 전송된 값이 있을 경우
        if ($_POST) {
            // 글쓰기 POST 전송 시
             $this -> load -> helper('alert');
             if (!$this -> input -> post('post_title', TRUE)) {
                // 글 내용이 없을 경우, 프로그램 단에서 한 번 더 체크
                alert('비정상적인 접근입니다.', $this->config->item('ADMIN_ROOT').'/contents/page/' . $pages);
                exit ;
            }

            //------------파일 업로드 처리-----------//
            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10485760';
            $config['max_width']  = '5000';
            $config['max_height']  = '5000';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            //------------파일 업로드 처리-----------//

            $data = $this->upload->do_upload();

            //커스텀 URL 있는지 체크한다.
            $custom_link_status="";
            if($this -> input -> post('custom_link_url') =="") {
                $custom_link_status ="N";
            }else{
                $custom_link_status ="Y";
            }
            
            //time존 설정
            date_default_timezone_set('Asia/Seoul');

            if($this -> input -> post('post_reg_date', TRUE)==''){
                $reg_date = date("Y-m-d H:i:s");
            }else{

                $date_tmp =  $this -> input -> post('post_reg_date', TRUE);
                $reg_date=str_replace(" ","",$date_tmp);
                $reg_date=str_replace("-","",$reg_date);
                $reg_date = date('Y-m-d H:i:s', strtotime($reg_date));
               // echo $reg_date."<br>";
            }

            //해당 메뉴 코드에 해당하는 menu_up_code를 가져온다. 
            //서브 메뉴가 넘어온 경우에는 menu_up_code가 있으며, 
            $menu_code = $this -> contents_m -> get_menu_up_code($this -> input -> post('post_menu_code', TRUE));
            if($menu_code ==""){
                $menu_code = $this -> input -> post('post_menu_code', TRUE);
            }else{
                $menu_code;
            }

            $write_data = array(
                'post_title' => $this -> input -> post('post_title', TRUE), 
                'post_sub_title' => $this -> input -> post('post_sub_title', TRUE), 
                'post_excerpt' => $this -> input -> post('post_excerpt', TRUE),                 
                'post_menu_code' => $this -> input -> post('post_menu_code', TRUE), 
                'post_menu_up_code' => $menu_code, 
                'post_status' => $this -> input -> post('post_status', TRUE), 
                'post_reg_date' => $reg_date, 
                'post_reg_date_status' => $this -> input -> post('post_reg_date_status', TRUE), 
                'custom_link_url' => $this -> input -> post('custom_link_url', TRUE),
                'custom_link_status' => $custom_link_status ,
                'post_keyword' => $this -> input -> post('post_keyword', TRUE), 
                'post_thumb_img' => $this->upload->data('file_name'),  
                'post_contents' => $this -> input -> post('contents', TRUE),
                'table' => 'fr_posts'
            );

            $result = $this -> contents_m -> insert($write_data);
            
            if ($result) {
                replace($this->config->item('ADMIN_ROOT').'/contents');
                exit;
            } else {
                alert("등록 중 오류가 발생했습니다.",$this->config->item('ADMIN_ROOT').'/contents/page/1');
                exit;
            }
        } else {
            // 쓰기 폼 view 호출
            $data['menuList'] = $this -> contents_m -> makeMenuList();
            $this->load->view('admin/contents_write',$data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->contents_m->delete('fr_posts', $this->uri->segment(4));
        
        if ( $return ) {
            replace($this->config->item('ADMIN_ROOT').'/contents/');
            exit;
        } else {
            alert('삭제 중 오류가 발생했습니다.', $this->config->item('ADMIN_ROOT').'/contents/');
            exit;
        }
        
    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        
        if ( $_POST ) {

            $this -> load -> helper('alert');
            
            $uri_array = segment_explode($this->uri->uri_string());
            
            if ( in_array('page', $uri_array)) {
                $pages = urldecode($this->url_explode($uri_array, 'page'));
            } else {
                $pages = 1;
            }
            
            if ( !$this->input->post('post_title', TRUE) AND !$this->input->post('contents', TRUE)) {
                alert('비정상적인 접근입니다.', $this->config->item('ADMIN_ROOT').'/contents/page/'.$pages);
                exit;
            }

            //----파일 업로드 처리---------------------------//

            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '10485760';
            $config['max_width']  = '3000';
            $config['max_height']  = '3000';

            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $data = $this->upload->do_upload();
            //----------------------------------------------//
            
            
            if($this->upload->data('file_name')==''){
                $real_file_name = $this -> input -> post('thumb_chk', TRUE);
            }else{
                $real_file_name = $this->upload->data('file_name');
            }
            
            //커스텀 URL 있는지 체크한다.
            $custom_link_status="";
            if($this -> input -> post('custom_link_url') =="") {
                $custom_link_status ="N";
            }else{
                $custom_link_status ="Y";
            }
             //커스텀 URL 있는지 체크한다.
            $custom_link_status="";
            if($this -> input -> post('custom_link_url') =="") {
                $custom_link_status ="N";
            }else{
                $custom_link_status ="Y";
            }

            //time존 설정
            date_default_timezone_set('Asia/Seoul');

            if($this -> input -> post('post_reg_date', TRUE)==''){
                $reg_date = date("Y-m-d H:i:s");
            }else{

                $date_tmp =  $this -> input -> post('post_reg_date', TRUE);
                $reg_date=str_replace(" ","",$date_tmp);
                $reg_date=str_replace("-","",$reg_date);
                $reg_date = date('Y-m-d H:i:s', strtotime($reg_date));
               // echo $reg_date."<br>";
            }

            $menu_code = $this -> contents_m -> get_menu_up_code($this -> input -> post('post_menu_code', TRUE));
            
            if($menu_code ==""){
                $menu_code = $this -> input -> post('post_menu_code', TRUE);
            }else{
                $menu_code;
            }
           
            $modify_data = array(
                'idx' => $this->uri->segment(4),
                'post_title' => $this -> input -> post('post_title', TRUE), 
                'post_sub_title' => $this -> input -> post('post_sub_title', TRUE), 
                'post_excerpt' => $this -> input -> post('post_excerpt', TRUE),                 
                'post_menu_code' => $this -> input -> post('post_menu_code', TRUE), 
                'post_menu_up_code' => $menu_code, 
                'post_status' => $this -> input -> post('post_status', TRUE), 
                'post_reg_date' => $reg_date, 
                'post_reg_date_status' => $this -> input -> post('post_reg_date_status', TRUE), 
                'custom_link_url' => $this -> input -> post('custom_link_url', TRUE),
                'custom_link_status' => $custom_link_status ,
                'post_keyword' => $this -> input -> post('post_keyword', TRUE), 
                'post_thumb_img' => $real_file_name,   
                'post_contents' => $this -> input -> post('contents', TRUE),
                'table' => 'fr_posts',
            );

            $result = $this->contents_m->modify($modify_data);
            
            if ( $result ) {
                replace($this->config->item('ADMIN_ROOT').'/contents');
                exit;
            } else {
                alert('등록 중 오류가 발생했습니다.', $this->config->item('ADMIN_ROOT').'/contents');
                exit;
            }
        } else {
           $data['views'] = $this->contents_m->get_view('fr_posts', $this->uri->segment(4));
           $data['menuList'] = $this -> contents_m -> editMenuList($data['views']->post_menu_code);
          // echo $data['views']->post_menu_code;
           $this->load->view('admin/contents_modify', $data);
        }
    }

    //*******헤더 예약, 문의 Noti(공통) 함수*********************
    public function reserv_list(){
        $data['resev_list'] = $this -> header_m -> reservation_lists('');
        $data['resev_list_cnt'] = $this -> header_m -> reservation_lists('count');
        $data['customer_list'] = $this -> header_m -> customer_lists('');
        $data['customer_list_cnt'] = $this -> header_m -> customer_lists('count');
        $this->load->vars($data);
    }
    //*******************************************************
 }
