<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 성수기관리
	**/

class Peak extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/peak_m');
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/rent/peak/lists'.$page_url;
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
        $config['total_rows'] = $this->peak_m->lists('tb_peak', 'count','', '', $search_word);
        
//        // 한 페이지에 표시할 게시물 수
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
        $data['list'] = $this->peak_m->lists('tb_peak', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/rent/peak', $data);
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
            $this->form_validation->set_rules('peak_title', '제목', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');

            if($this->form_validation->run()) {
                $write_data = array(
                    'peak_title' => $this->input->post('peak_title', TRUE),
                    'peak_type' => $this->input->post('peak_type', TRUE),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'use_yn' => $this->input->post('use_yn', TRUE),
                    'table' => 'tb_peak'
                );

                $result = $this->peak_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $this->load->view('admin/rent/peak_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/rent/peak_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        
        $return = $this->peak_m->delete('tb_peak', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
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
            $this->form_validation->set_rules('peak_title', '제목', 'required');
            $this->form_validation->set_rules('s_date', '시작일', 'required');
            $this->form_validation->set_rules('e_date', '종료일', 'required');

            if($this->form_validation->run()) {
                $modify_data = array(
                    'table' => 'tb_peak',
                    'idx' => $this->uri->segment(5),
                    'peak_title' => $this->input->post('peak_title', TRUE),
                    'peak_type' => $this->input->post('peak_type', TRUE),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'use_yn' => $this->input->post('use_yn', TRUE),
                );

                $result = $this->peak_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['v'] = $v - 1;
                $data['views'] = $this->peak_m->get_view('tb_peak', $this->uri->segment(5));
                $this->load->view('admin/rent/peak_modify', $data);
            }
        } else {
            $data['v'] = $v ;
            $data['views'] = $this->peak_m->get_view('tb_peak', $this->uri->segment(5));
            $this->load->view('admin/rent/peak_modify', $data);
        }
    }
}
