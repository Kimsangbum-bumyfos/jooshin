<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 자동차관리
	**/

class Car extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/car_m');
        $this->load->model('cke_files_m');
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/rent/car/lists'.$page_url;
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
        $config['total_rows'] = $this->car_m->lists('tb_car', 'count','', '', $search_word);

//
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
        $data['list'] = $this->car_m->lists('tb_car', '', $start, $config['per_page'], $search_word);


        $this->load->view('admin/rent/car', $data);
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
        if ($_POST){

            $rental_fee_consultation_inquiry = $this->input->post('rental_fee_consultation_inquiry', TRUE);
            $insur_fee_open_yn = $this->input->post('insur_fee_open_yn', TRUE);

            $this->form_validation->set_rules('car_name', '차량명', 'required');
            $this->form_validation->set_rules('operate_svc', '배차가격', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('release_svc', '회차가격', 'required|is_natural_no_zero');

            if($rental_fee_consultation_inquiry !== 'Y') {
                $this->form_validation->set_rules('rental_fee', '정상가격(1일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_12', '일반가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_12', '성수기가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_12', '극성수기가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_36', '일반가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_36', '성수기가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_36', '극성수기가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_7', '일반가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_7', '성수기가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_7', '극성수기가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_weekend_fee', '주말가격', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('add_hours_fee', '시간당추가요금', 'required|is_natural_no_zero');
            }
            if(!is_array($insur_fee_open_yn)) {
                $this->form_validation->set_rules('insur_fee', '보험금액', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('insur_fee_10', '보험금액', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('insur_fee_30', '보험금액', 'required|is_natural_no_zero');
            } else {
                if(!in_array('01', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee', '보험금액', 'required|is_natural_no_zero');
                if(!in_array('02', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee_10', '보험금액', 'required|is_natural_no_zero');
                if(!in_array('03', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee_30', '보험금액', 'required|is_natural_no_zero');
            }

            if(empty($_FILES['userfile']['name'])) $this->form_validation->set_rules('userfile', '썸네일 이미지', 'required');

            if($this->form_validation->run()) {
                //------------파일 업로드 처리-----------//
                $config['upload_path'] = '.'.$this->config->item("UPLOAD_CAR");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if(!$this->upload->do_upload()) {
//                    $this->upload->display_errors();
                    alert_after_history('이미지 업로드에 실패하였습니다', -2);
                    exit;
                }
                //------------파일 업로드 처리-----------//

                //보험 옵션


                if (empty($insur_fee_open_yn)) {
                    $insur_fee_open_yn="";
                }else{
                    $insur_fee_open_yn = implode(',', $insur_fee_open_yn);
                }

                //렌트 옵션
                $rental_opt = $this->input->post('rental_opt', TRUE);

                if (empty($rental_opt)) {
                    $rental_opt="";
                }else{
                    $rental_opt = implode(',', $rental_opt);
                }

                $write_data = array(
                    'car_name' => $this->input->post('car_name', TRUE),
                    'car_type' => $this->input->post('car_type', TRUE),
                    'rental_fee_consultation_inquiry' => $rental_fee_consultation_inquiry,
                    'rental_fee' => $this->input->post('rental_fee', TRUE),
                    'rental_fee_12' => $this->input->post('rental_fee_12', TRUE),
                    'rental_peak_fee_12' => $this->input->post('rental_peak_fee_12', TRUE),
                    'rental_high_peak_fee_12' => $this->input->post('rental_high_peak_fee_12', TRUE),
                    'rental_fee_36' => $this->input->post('rental_fee_36', TRUE),
                    'rental_peak_fee_36' => $this->input->post('rental_peak_fee_36', TRUE),
                    'rental_high_peak_fee_36' => $this->input->post('rental_high_peak_fee_36', TRUE),
                    'rental_fee_7' => $this->input->post('rental_fee_7', TRUE),
                    'rental_peak_fee_7' => $this->input->post('rental_peak_fee_7', TRUE),
                    'rental_high_peak_fee_7' => $this->input->post('rental_high_peak_fee_7', TRUE),
                    'rental_weekend_fee' => $this->input->post('rental_weekend_fee', TRUE),
                    'add_hours_fee' => $this->input->post('add_hours_fee', TRUE),
                    'operate_svc' => $this->input->post('operate_svc', TRUE),
                    'release_svc' => $this->input->post('release_svc', TRUE),
                    'insur_fee' => $this->input->post('insur_fee', TRUE),
                    'insur_fee_10' => $this->input->post('insur_fee_10', TRUE),
                    'insur_fee_30' => $this->input->post('insur_fee_30', TRUE),
                    'insur_fee_open_yn' => $insur_fee_open_yn,
                    'popular_car' => $this->input->post('popular_car', TRUE),
                    'detail_info' => $this->input->post('contents', TRUE),
                    'rental_opt' => $rental_opt,
                    'thumb_img' => $this->upload->data('file_name'),
                    'path' => $this->config->item("UPLOAD_CAR"),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'cke_key' => $this->input->post('k', TRUE),
                    'table' => 'tb_car'
                );

                $result = $this->car_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            }else {
                $data['hash'] = random_string('alnum', 32);
                while(!$this->cke_files_m->checkKey($data['hash'])) {
                    $data['hash'] = random_string('alnum', 32);
                }
                $data['v'] = $v - 1;
                $this->load->view('admin/rent/car_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }
            $data['v'] = $v;
            $this->load->view('admin/rent/car_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->car_m->get_view('tb_car', $this->uri->segment(5));
        $return = $this->car_m->delete('tb_car', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
            remove_file($data->path, $data->thumb_img);
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
            $rental_fee_consultation_inquiry = $this->input->post('rental_fee_consultation_inquiry', TRUE);
            $insur_fee_open_yn = $this->input->post('insur_fee_open_yn', TRUE);

            $this->form_validation->set_rules('car_name', '차량명', 'required');
            $this->form_validation->set_rules('operate_svc', '배차가격', 'required|is_natural_no_zero');
            $this->form_validation->set_rules('release_svc', '회차가격', 'required|is_natural_no_zero');

            if($rental_fee_consultation_inquiry !== 'Y') {
                $this->form_validation->set_rules('rental_fee', '정상가격(1일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_12', '일반가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_12', '성수기가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_12', '극성수기가격(1~2일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_36', '일반가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_36', '성수기가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_36', '극성수기가격(3~6일)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_fee_7', '일반가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_peak_fee_7', '성수기가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_high_peak_fee_7', '극성수기가격(7일이상)', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('rental_weekend_fee', '주말가격', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('add_hours_fee', '시간당추가요금', 'required|is_natural_no_zero');
            }

            if(!is_array($insur_fee_open_yn)) {
                $this->form_validation->set_rules('insur_fee', '보험금액', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('insur_fee_10', '보험금액', 'required|is_natural_no_zero');
                $this->form_validation->set_rules('insur_fee_30', '보험금액', 'required|is_natural_no_zero');
            } else {
                if(!in_array('01', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee', '보험금액', 'required|is_natural_no_zero');
                if(!in_array('02', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee_10', '보험금액', 'required|is_natural_no_zero');
                if(!in_array('03', $insur_fee_open_yn)) $this->form_validation->set_rules('insur_fee_30', '보험금액', 'required|is_natural_no_zero');
            }

            if($this->form_validation->run()) {
                $config['upload_path'] = '.'.$this->config->item("UPLOAD_CAR");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                $this->upload->do_upload();


                if($this->upload->data('file_name')==''){
                    $real_file_name = $this->input->post('thumb_chk', TRUE);
                }else{
                    $real_file_name = $this->upload->data('file_name');
                    remove_file($this->config->item("UPLOAD_CAR"), $this->input->post('thumb_chk', TRUE));
                }

                if (empty($insur_fee_open_yn)) {
                    $insur_fee_open_yn="";
                }else{
                    $insur_fee_open_yn = implode(',', $insur_fee_open_yn);
                }

                //렌트 옵션
                $rental_opt = $this->input->post('rental_opt', TRUE);

                if (empty($rental_opt)) {
                    $rental_opt="";
                }else{
                    $rental_opt = implode(',', $rental_opt);
                }
//            $contents = $this->security->xss_clean($this->input->post('contents'), FALSE, TRUE);

                $modify_data = array(
                    'table' => 'tb_car',
                    'idx' => $this->uri->segment(5),
                    'car_name' => $this->input->post('car_name', TRUE),
                    'car_type' => $this->input->post('car_type', TRUE),
                    'rental_fee_consultation_inquiry' => $this->input->post('rental_fee_consultation_inquiry', TRUE),
                    'rental_fee' => $this->input->post('rental_fee', TRUE),
                    'rental_fee_12' => $this->input->post('rental_fee_12', TRUE),
                    'rental_peak_fee_12' => $this->input->post('rental_peak_fee_12', TRUE),
                    'rental_high_peak_fee_12' => $this->input->post('rental_high_peak_fee_12', TRUE),
                    'rental_fee_36' => $this->input->post('rental_fee_36', TRUE),
                    'rental_peak_fee_36' => $this->input->post('rental_peak_fee_36', TRUE),
                    'rental_high_peak_fee_36' => $this->input->post('rental_high_peak_fee_36', TRUE),
                    'rental_fee_7' => $this->input->post('rental_fee_7', TRUE),
                    'rental_peak_fee_7' => $this->input->post('rental_peak_fee_7', TRUE),
                    'rental_high_peak_fee_7' => $this->input->post('rental_high_peak_fee_7', TRUE),
                    'rental_weekend_fee' => $this->input->post('rental_weekend_fee', TRUE),
                    'add_hours_fee' => $this->input->post('add_hours_fee', TRUE),
                    'operate_svc' => $this->input->post('operate_svc', TRUE),
                    'release_svc' => $this->input->post('release_svc', TRUE),
                    'insur_fee' => $this->input->post('insur_fee', TRUE),
                    'insur_fee_10' => $this->input->post('insur_fee_10', TRUE),
                    'insur_fee_30' => $this->input->post('insur_fee_30', TRUE),
                    'insur_fee_open_yn' => $insur_fee_open_yn,
                    'detail_info' => $this->input->post('contents', TRUE),
                    'rental_opt' => $rental_opt,
                    'thumb_img' => $real_file_name,
                    'popular_car' => $this->input->post('popular_car'),
                    'path' => $this->config->item("UPLOAD_CAR"),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                );

                $result = $this->car_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['v'] = $v - 1;
                $data['views'] = $this->car_m->get_view('tb_car', $this->uri->segment(5));
                $this->load->view('admin/rent/car_modify', $data);
            }

        } else {
            $data['v'] = $v ;
            $data['views'] = $this->car_m->get_view('tb_car', $this->uri->segment(5));
            $this->load->view('admin/rent/car_modify', $data);
        }
    }
}
