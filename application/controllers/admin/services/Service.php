<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/**
* 상품 관리
**/
class Service extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script','manage_files'));
        $this->load->model('admin/service_m');
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/services/service/lists'.$page_url;
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
        $config['total_rows'] = $this->service_m->lists('tb_testing_service', 'count','', '', $search_word);


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
 
        $data['list'] = $this->service_m->lists('tb_testing_service', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/services/service', $data);
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
            $this->form_validation->set_rules('contents', '내용', 'required');
            if(empty($_FILES['userfile']['name'])) 
                $this->form_validation->set_rules('userfile', '썸네일 이미지', 'required');


            if($this->form_validation->run()) {
                $res = self::proc_file_upload(); // 파일업로드

                // 썸네일 외 파일 존재시
                $file_list = '';
                if(count($res) > 1){
                    for ($j=0; $j <count($res)-1 ; $j++) { 
                        if($j == count($res)-2)
                            $file_list .= $res[$j+1]['upload_data']['file_name'];
                        else
                            $file_list .= $res[$j+1]['upload_data']['file_name'].',';
                    }
                }

                //file upload..
                $write_data = array(
                    'title' => $this->input->post('title', TRUE),
                    'category' => $this->input->post('category', TRUE),
                    'page_main' => $this->input->post('page_main', TRUE),
                    'region' => $this->input->post('region', TRUE),
                    'terms' => $this->input->post('terms', TRUE),
                    'keyword' => $this->input->post('keyword', TRUE),
                    'thumb_img' => $res[0]['upload_data']['file_name'],
                    'img_list' => $this->input->post('img_list', TRUE),
                    'path' => $this->config->item("UPLOAD_SERVICES"),
                    'addr' => $this->input->post('addr', TRUE),
                    'addr_detail' => $this->input->post('addr_detail', TRUE),
                    'postcode' => $this->input->post('postcode', TRUE),
                    'buyer' => $this->input->post('buyer', TRUE),
                    'scale' => $this->input->post('scale', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'reg_date' => date('Y-m-d H:i:s')
                );


                $result = $this->service_m->insert($write_data);

                if ($result) {
                   replace($this->config->item('ADMIN_ROOT').'/services/service');
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
                $this->load->view('admin/services/service_write', $data);
            }
        } else {
            
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }

            $data['v'] = $v;
            $this->load->view('admin/services/service_write', $data);
        }
    }

   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->service_m->delete('tb_testing_service', $this->uri->segment(5));
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
            $this->form_validation->set_rules('contents', '내용', 'required');

            if($this->form_validation->run()) {

                $res = self::proc_file_upload(); // 파일업로드

                // 썸네일 외 파일 존재시
                $file_list = '';
                if(count($res) > 1){
                    for ($j=0; $j <count($res)-1 ; $j++) { 
                        if($j == count($res)-2)
                            $file_list .= $res[$j+1]['upload_data']['file_name'];
                        else
                            $file_list .= $res[$j+1]['upload_data']['file_name'].',';
                    }
                }

                if($this->upload->data('file_name')==''){
                    $real_file_name = $this->input->post('thumb_chk', TRUE);
                }else{
                    $real_file_name = $res[0]['upload_data']['file_name'];
                }

                // 변경 파일 삭제
                $before_list = $this->service_m->modify_img('tb_testing_service', $this->uri->segment(5));
                $after_list = $this->input->post('img_list', TRUE);
                $compare_str = strcmp($before_list->img_list , $after_list);


                if($compare_str){ // 수정됨
                    $n_before_list = explode(',', $before_list->img_list);
                    $n_after_list = explode(',', $after_list);

                    $result_list =$after_list;

                    for($i=0; $i<count($n_before_list); $i++){
                        if(strstr($after_list, $n_before_list[$i])){
                            
                        }
                        else{ // 파일 삭제
                            unlink("./uploads/services/".$n_before_list[$i]);
                        }
                    }


                }
                else{
                    // 같음
                    $result_list = $before_list->img_list;
                }

                $modify_data = array(
                    'table' => 'tb_testing_service',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    'category' => $this->input->post('category', TRUE),
                    'page_main' => $this->input->post('page_main', TRUE),
                    'region' => $this->input->post('region', TRUE),
                    'terms' => $this->input->post('terms', TRUE),
                    'keyword' => $this->input->post('keyword', TRUE),
                    'thumb_img' =>$real_file_name,
                    'img_list' => $result_list,
                    'path' => $this->config->item("UPLOAD_SERVICES"),
                    'addr' => $this->input->post('addr', TRUE),
                    'addr_detail' => $this->input->post('addr_detail', TRUE),
                    'postcode' => $this->input->post('postcode', TRUE),
                    'buyer' => $this->input->post('buyer', TRUE),
                    'scale' => $this->input->post('scale', TRUE),
                    'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    's_date' => $this->input->post('s_date', TRUE),
                    'e_date' => $this->input->post('e_date', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                );

                $result = $this->service_m->modify($modify_data);

                if ($result) {
                    replace($this->config->item('ADMIN_ROOT').'/services/service');
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->service_m->get_view('tb_testing_service', $this->uri->segment(5));
            $this->load->view('admin/services/service_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->service_m->get_view('tb_testing_service', $this->uri->segment(5));
            $this->load->view('admin/services/service_modify', $data);
        }
    }

    function proc_file_upload(){
        $config['upload_path'] = '.'.$this->config->item("UPLOAD_SERVICES");
        $config['allowed_types'] = 'gif|jpg|png|jpeg|jfif|jpeg';
        // $config['allowed_types'] = '*';
        $config['max_size'] = '10485760';
        $config['max_width']  = '5000';
        $config['max_height']  = '5000';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $files_name = $_FILES['userfile']['name'];
        $files = $_FILES['userfile'];
        $array_cnt = count($files_name)-1; // 전체 갯수(파일업로드 허수포함)


        if($files['name'][$array_cnt] == '')
            $cnt = $array_cnt-1;        // 단일 파일
        else
            $cnt = $array_cnt;          // 멀티파일


        if($cnt >5){ // 최대 저장 갯수 초과시
            alert_after_history('파일 업로드는 최대 5개까지입니다.', -2);
            exit;
        }
        
        /*
            * 파일 업로드
            * 단일 | 멀티 동시처리
        */
        $res = array();
        for ($i=0; $i <=$cnt ; $i++) { 
            $_FILES['userfile'] = array(
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i]
            );
            $res[$i] = self::_do_upload_one();
        }
        return $res;
    }

    /*
        * 개별 파일 업로드
    */
    function _do_upload_one (){
        if(!$this->upload->do_upload()) {
            alert_after_history('파일 업로드에 실패하였습니다', -2);
            exit;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }


    function img_chk(){
        $result = '';

        $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG','image/JPIF', 'image/X-PNG', 'image/PNG', 'image/png','image/jfif', 'image/x-png');
        $dir = "./uploads/services/";

        for($i=0; $i<$_POST['image_count']; $i++) {
            $image_id = "image_".$i;
            $image_file = time().$i.".".explode('/', $_FILES[$image_id]['type'])[1];

             // && $_FILES[$image_id]['size']<10485760
            if(isset($_FILES[$image_id]) && !$_FILES[$image_id]['error'] ) {
                if(in_array($_FILES[$image_id]['type'], $imageKind)) {
                    if(move_uploaded_file($_FILES[$image_id]['tmp_name'], $dir.$image_file)) {
                        // echo "Success Upload <br/>";
                        echo $image_file.",";
                        // $result = 'success';
                    } else {
                        // echo "Error <br/>";
                    }
                } else {
                    // echo "Not Type <br/>";
                }
            } else {
                // echo "Upload Fail <br/>";
            }

        }
    }
}