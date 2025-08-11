<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 휴무일관리
	**/

class Holiday extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this->load->model('admin/pension_holiday_m');
        $this->config->load('setting');
        $this->load->library('form_validation');
    }

    public function index() {
       $this->lists();
    }

    //리스트 페이지
    public function lists() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        // 페이지 네이션 설정
        $this->load->library('pagination');

        $data['search_word'] = "";
        $page_url = '';
        if ($search_word = $this->input->get('search_word', TRUE)) {
            $page_url = '?search_word='.$search_word;

            $data['search_word'] = $search_word;
        }

        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/pension/holiday/lists'.$page_url;
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
        $config['total_rows'] = $this->pension_holiday_m->lists('tb_pension_holiday', 'count','', '', $search_word);

        // 한 페이지에 표시할 게시물 수
        $config['per_page'] = 10;

        // 페이지네이션 초기화
        $this->pagination->initialize($config);

        // 페이지 링크를 생성하여 view에서 사용하 변수에 할당
        $data['pagination'] = $this->pagination->create_links();
        if(!$data['pagination']) $data['pagination'] = '<a class="active">1</a>';

        // 게시물 목록을 불러오기 위한 offset, limit 값 가져오기
        $page = $this->input->get('page', TRUE);

        if ($page > 1) {
            $start = ($page - 1) * $config['per_page'];
        } else {
            $start = 0;
            $page = 1;
        }

        $data['limit'] = $config['per_page'];
        $data['page'] = $page;
        $data['total_row'] = $config['total_rows'];
        $data['list'] = $this->pension_holiday_m->lists('tb_pension_holiday', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/pension/holiday', $data);
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
            $m_1 = $this->input->post('m_1', TRUE);
            $m_2 = $this->input->post('m_2', TRUE);
            $m_3 = $this->input->post('m_3', TRUE);
            $m_4 = $this->input->post('m_4', TRUE);
            $m_5 = $this->input->post('m_5', TRUE);
            $m_6 = $this->input->post('m_6', TRUE);
            $m_7 = $this->input->post('m_7', TRUE);
            $m_8 = $this->input->post('m_8', TRUE);
            $m_9 = $this->input->post('m_9', TRUE);
            $m_10 = $this->input->post('m_10', TRUE);
            $m_11 = $this->input->post('m_11', TRUE);
            $m_12 = $this->input->post('m_12', TRUE);

            // 1~12월 중 휴무일이 아무것도 입력이 안될 시 validation
            $check = 0;
            for($i=1;$i<=12;$i++) {
                if(!${"m_".$i}) {
                    continue;
                }
                else {
                    $check = 1;
                    break;
                }
            }

            if(!$check) {
                $this->form_validation->set_rules('m_1', '휴무일', 'required');
                $check = $this->form_validation->run();
            }
            // ***


            if($check) {
                $holiday_date = array(
                    'm01' => $m_1,
                    'm02' => $m_2,
                    'm03' => $m_3,
                    'm04' => $m_4,
                    'm05' => $m_5,
                    'm06' => $m_6,
                    'm07' => $m_7,
                    'm08' => $m_8,
                    'm09' => $m_9,
                    'm10' => $m_10,
                    'm11' => $m_11,
                    'm12' => $m_12
                );

                //json형식으로 인코딩한다.
                $output_data = json_encode($holiday_date, JSON_UNESCAPED_UNICODE);

                $write_data = array(
                    'year' => $this->input->post('year', TRUE),
                    'holiday_data' => $output_data,
                    'use_yn' => $this->input->post('use_yn', TRUE),
                    'table' => 'tb_pension_holiday'
                );

                // 동일한 연도에 등록된 휴무일이 있는지 체크한다. 년도는 중복되면 안됨
                $result = $this->pension_holiday_m->get_year_chk('tb_pension_holiday', $this->input->post('year', TRUE));
                if($result==1){
                    alert_after_history('선택한 년도로 등록 된 휴무일이 있습니다', -1);
                    exit;
                }

                $result = $this->pension_holiday_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $this->load->view('admin/pension/holiday_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/pension/holiday_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        $return = $this->pension_holiday_m->delete('tb_pension_holiday', $this->uri->segment(5));
        $v = $this->input->get('v', TRUE);

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
            $m_1 = $this->input->post('m_1', TRUE);
            $m_2 = $this->input->post('m_2', TRUE);
            $m_3 = $this->input->post('m_3', TRUE);
            $m_4 = $this->input->post('m_4', TRUE);
            $m_5 = $this->input->post('m_5', TRUE);
            $m_6 = $this->input->post('m_6', TRUE);
            $m_7 = $this->input->post('m_7', TRUE);
            $m_8 = $this->input->post('m_8', TRUE);
            $m_9 = $this->input->post('m_9', TRUE);
            $m_10 = $this->input->post('m_10', TRUE);
            $m_11 = $this->input->post('m_11', TRUE);
            $m_12 = $this->input->post('m_12', TRUE);

            // 1~12월 중 휴무일이 아무것도 입력이 안될 시 validation
            $check = 0;
            for($i=1;$i<=12;$i++) {
                if(!${"m_".$i}) {
                    continue;
                }
                else {
                    $check = 1;
                    break;
                }
            }

            if(!$check) {
                $this->form_validation->set_rules('m_1', '휴무일', 'required');
                $check = $this->form_validation->run();
            }
            // ***
            if($check) {
                //월별 배열로 변환한다.
                $holiday_date = array(
                    'm01' => $m_1,
                    'm02' => $m_2,
                    'm03' => $m_3,
                    'm04' => $m_4,
                    'm05' => $m_5,
                    'm06' => $m_6,
                    'm07' => $m_7,
                    'm08' => $m_8,
                    'm09' => $m_9,
                    'm10' => $m_10,
                    'm11' => $m_11,
                    'm12' => $m_12
                );

                $output_data = json_encode($holiday_date, JSON_UNESCAPED_UNICODE);

                $modify_data = array(
                    'table' => 'tb_pension_holiday',
                    'idx' => $this->uri->segment(5),
                    'holiday_data' => $output_data,
                    'use_yn' => $this->input->post('use_yn', TRUE),
                );

                $result = $this->pension_holiday_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $data['views'] = $this->pension_holiday_m->get_view('tb_pension_holiday', $this->uri->segment(5));
                $this->load->view('admin/pension/holiday_modify', $data);
            }
        } else {
            $data['v'] = $v ;
            $data['views'] = $this->pension_holiday_m->get_view('tb_pension_holiday', $this->uri->segment(5));
            $this->load->view('admin/pension/holiday_modify', $data);
        }
    }
}
