<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
    /**
	* 템플릿관리
	**/

class Branch extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script', 'manage_files'));
        $this->load->model('admin/branch_m');
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/branch/lists'.$page_url;
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
        $config['total_rows'] = $this->branch_m->lists('tb_branch', 'count','', '', $search_word);

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
        $data['list'] = $this->branch_m->lists('tb_branch', '', $start, $config['per_page'], $search_word);

        $this->load->view('admin/branch/branch', $data);
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
            $this->form_validation->set_rules('branch_name', '지점명', 'required');
            $this->form_validation->set_rules('addr_code', '주소', 'required');
            $this->form_validation->set_rules('addr', '주소', 'required');
            $this->form_validation->set_rules('addr2', '주소', 'required');

            if($this->form_validation->run()) {
                $this->load->library('upload');
                //------------파일 업로드 처리-----------//
                $config['upload_path'] = '.' .$this->config->item("UPLOAD_BRANCH");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if(!$this->upload->do_upload()) {
                    alert_after_history('이미지 업로드에 실패하였습니다', -2);
                    exit;
                }
                //------------파일 업로드 처리-----------//

                $write_data = array(
                    'branch_name' => $this->input->post('branch_name', TRUE),
                    'addr_code' => $this->input->post('addr_code', TRUE),
                    'addr' => $this->input->post('addr', TRUE),
                    'addr2' => $this->input->post('addr2', TRUE),
                    'office_tel' => $this->input->post('office_tel', TRUE),
                    'office_phone' => $this->input->post('office_phone', TRUE),
                    'office_fax' => $this->input->post('office_fax', TRUE),
                    'business_hours' => $this->input->post('business_hours', TRUE),
                    'additional_comment' => $this->input->post('additional_comment', TRUE),
                    'additional_comment2' => $this->input->post('additional_comment2', TRUE),
                    'map_comment' => $this->input->post('map_comment', TRUE),
                    'thumb_img' => $this->upload->data('file_name'),
                    'path' => $this->config->item("UPLOAD_BRANCH"),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_branch'
                );

                $result = $this->branch_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록중 오류가 발생했습니다', -1);
                    exit;
                }
            } else {
                $data['v'] = $v - 1;
                $this->load->view('admin/branch/branch_write', $data);
            }

        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/branch/branch_write', $data);
        }
    }
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->branch_m->get_view('tb_branch', $this->uri->segment(4));
        $return = $this->branch_m->delete('tb_branch', $this->uri->segment(4));
        $v = $this->input->get('v');

        if ($return) {
            remove_file($data->path, $data->thumb_img);
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
            $this->form_validation->set_rules('branch_name', '지점명', 'required');
            $this->form_validation->set_rules('addr_code', '주소', 'required');
            $this->form_validation->set_rules('addr', '주소', 'required');
            $this->form_validation->set_rules('addr2', '주소', 'required');

            if($this->form_validation->run()) {
                $this->load->library('upload');
                //------------파일 업로드 처리-----------//
                $config['upload_path'] = '.' .$this->config->item("UPLOAD_BRANCH");
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '10485760';
                $config['max_width']  = '3000';
                $config['max_height']  = '3000';
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);


                $this->upload->do_upload();
                //------------파일 업로드 처리-----------//


                if($this->upload->data('file_name')==''){
                    $real_file_name = $this->input->post('thumb_chk', TRUE);
                }else{
                    $real_file_name = $this->upload->data('file_name');
                    remove_file($this->config->item("UPLOAD_BRANCH"), $this->input->post('thumb_chk', TRUE));
                }

                $modify_data = array(
                    'table' => 'tb_branch',
                    'idx' => $this->uri->segment(4),
                    'branch_name' => $this->input->post('branch_name', TRUE),
                    'addr_code' => $this->input->post('addr_code', TRUE),
                    'addr' => $this->input->post('addr', TRUE),
                    'addr2' => $this->input->post('addr2', TRUE),
                    'office_tel' => $this->input->post('office_tel', TRUE),
                    'office_phone' => $this->input->post('office_phone', TRUE),
                    'office_fax' => $this->input->post('office_fax', TRUE),
                    'business_hours' => $this->input->post('business_hours', TRUE),
                    'additional_comment' => $this->input->post('additional_comment', TRUE),
                    'additional_comment2' => $this->input->post('additional_comment2', TRUE),
                    'map_comment' => $this->input->post('map_comment', TRUE),
                    'thumb_img' => $real_file_name,
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'path' => $this->config->item("UPLOAD_BRANCH")
                );

                $result = $this->branch_m->modify($modify_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->branch_m->get_view('tb_branch', $this->uri->segment(4));
            $this->load->view('admin/branch/branch_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->branch_m->get_view('tb_branch', $this->uri->segment(4));            
            $this->load->view('admin/branch/branch_modify', $data);
        }
    }
}
