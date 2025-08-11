<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/**
* 실시간예약 관리
**/
class Reservation extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/pension_reservation_m');
        $this->config->load('setting');
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
        if ($search_word = $this->input->get('search_word', TRUE)) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }

        // 페이징 주소
        $config['base_url'] = $this->config->item('ADMIN_ROOT').'/pension/reservation/lists'.$page_url.'/page/';
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
        $config['total_rows'] = $this->pension_reservation_m->lists('tb_pension_reservation', 'count','', '', $search_word);
        
        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;
        //$config['per_page']=  $this->config->item('per_page');

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
 
        $data['list'] = $this->pension_reservation_m->lists('tb_pension_reservation', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/pension/reservation', $data);
    }

    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->pension_reservation_m->delete('tb_pension_reservation', $this->uri->segment(5));

        if ($return) {
            history(-2);
            exit;
        } else {
            alert_after_history('삭제중 오류가 발생했습니다', -2);
            exit;
        }
    }

    //게시물 수정
    function modify() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
     
        if ($_POST) {

            $modify_data = array(
                'table' => 'tb_pension_reservation',
                'idx' => $this->uri->segment(5),
                'total_sum' => $this->input->post('total_sum', TRUE), 
                'total_sum_desc' => $this->input->post('total_sum_desc', TRUE), 
                'reserve_status' => $this->input->post('reserve_status', TRUE), 
                'payment_status' => $this->input->post('payment_status', TRUE), 
                'confirm_result' => $this->input->post('confirm_result', TRUE), 
                'confirm_result_memo' => $this->input->post('confirm_result_memo', TRUE), 
            );
            
            $result = $this->pension_reservation_m->modify($modify_data);

            if ($result) {
                history(-2);
                exit;
            } else {
                alert_after_history('등록중 오류가 발생했습니다', -2);
                exit;
            }
        } else {
            
            //팬션 숙박료 계산    
            $data['roomCharge'] = $this->pension_reservation_m->get_roomCharge($this->uri->segment(5));
            $data['optCharge'] = $this->pension_reservation_m->get_OptCharge($this->uri->segment(5));
            $data['views'] = $this->pension_reservation_m->get_view('tb_pension_reservation', $this->uri->segment(5));
            $this->load->view('admin/pension/reservation_modify', $data);
        }
    }
}
