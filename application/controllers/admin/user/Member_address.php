<?php
	if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
/**
* 공지사항 관리
**/
class Member_address extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this -> load -> helper(array('url', 'date','segment'));
        $this -> load -> model('member_address_m');
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

    function index(){
    
        $this->lists();
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

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        // 페이지 네이션 설정
        $this -> load -> library('my_pagination');
        $this->config->load('pagination');

        // 검색어 초기화
        $search_word = $page_url = '';
        $uri_segment = 5;
        
        // 주소 중에서 q(검색어) 세그먼트가 있는 지 검사하기 위해 주소를 배열로 반환
        $uri_array = segment_explode($this -> uri -> uri_string());
 
        if (in_array('q', $uri_array)) {
            // 주소에 검색어가 있을 경우 처리
            $search_word = urldecode(url_explode($uri_array, 'q'));
                $page_url = '/q/' . $search_word;
                $uri_segment = 7;
        }
        
        // 페이징 주소
        $config['base_url'] = $this->config->item('ADMIN_ROOT').'/member_address/lists'.$page_url.'/page/'; 
                
        // 게시물 전체 개수    
        $config['total_rows'] = $this -> member_address_m -> lists('', 'count','', '', $search_word);
        
        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;
        //$config['per_page']=  $this->config->item('per_page');
        
        $config['uri_segment'] = $uri_segment;
      
        // 페이지 번호가 위치한 세그먼트
       

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
 
        $data['list'] = $this -> member_address_m-> lists('', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this -> load -> view('admin/member_address', $data);
    }

    //글 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
 
        //post로 전송된 값이 있을 경우
        if ($_POST) {
            // 글쓰기 POST 전송 시
             $this -> load -> helper('alert');
            
             if (!$this -> input -> post('address_title', TRUE)) {
                // 글 내용이 없을 경우, 프로그램 단에서 한 번 더 체크
                alert('비정상적인 접근입니다.', $this->config->item('ADMIN_ROOT').'/member_address/lists/page/' . $pages);
                exit ;
            }
 
            $write_data = array(
                'address_title' => $this -> input -> post('address_title', TRUE),
                'member_list' => $this -> input -> post('member_list', TRUE),
                'table' =>'fr_address_book'
            );

            $result = $this -> member_address_m -> insert($write_data);
            
            if ($result) {
                replace($this->config->item('ADMIN_ROOT').'/member_address/lists/page/1/');
                exit;
            } else {
                alert("등록 중 오류가 발생했습니다.",$this->config->item('ADMIN_ROOT').'/member_address/lists/page/1');
                exit;
            }
        } else {
            // 쓰기 폼 view 호출
            $data['list'] = $this -> member_address_m -> get_member_list();                   
            $this->load->view('admin/member_address_write',$data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->member_address_m->delete_address_all('fr_address_book', $this->uri->segment(4));
        
        if ( $return ) {
            replace($this->config->item('ADMIN_ROOT').'/member_address/lists/page/1');
            exit;
        } else {
            alert('삭제 중 오류가 발생했습니다.', $this->config->item('ADMIN_ROOT').'/member_address/lists/page/1');
            exit;
        }
    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
     
        if ( $_POST ) {
            $this -> load -> helper('alert');
            
            $uri_array = segment_explode($this->uri->uri_string());

            //수정 시 넘겨준 페이지 파라미터가 1페이지인 경우에는 page/만 넘어오고 숫자는 안넘어 오기 때문에
            //페이지 번호가 없는 경우에는 1페이지로 처리한다.
            if(in_array('page', $uri_array) && $this->uri->segment(6)==''){
                $pages = 1;
            }else{
                $pages = urldecode(url_explode($uri_array, 'page'));
            }
            
            if ( !$this->input->post('address_title', TRUE)) {
                alert('비정상적인 접근입니다.', $this->config->item('ADMIN_ROOT').'/member_address/lists/page/'.$pages);
                exit;
            }

            $modify_data = array(
                'idx' => $this->uri->segment(4),
                'address_title' => $this -> input -> post('address_title', TRUE),
                'member_list' => $this -> input -> post('member_list', TRUE)
            );
            
            $result = $this->member_address_m->modify($modify_data);
            
            if ( $result ) {
                replace($this->config->item('ADMIN_ROOT').'/member_address/lists/page/'.$pages);
                exit;
            } else {
                alert('등록 중 오류가 발생했습니다.', $this->config->item('ADMIN_ROOT').'/member_address/lists/page/1');
                exit;
            }
        } else {
            $data['views'] = $this->member_address_m->get_view('fr_address_book', $this->uri->segment(4));
            $data['address_member'] = $this->member_address_m->get_address_list($this->uri->segment(4));
            $data['member'] = $this -> member_address_m -> get_member_list();  
            $this->load->view('admin/member_address_modify', $data);
        }
    }
}
