<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/**
* 상품 관리
**/
class Product extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script','manage_files'));
        $this->load->model('admin/product_m');
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
        $data['depth_1'] = "";
        $data['depth_2'] = "";
        $data['depth_3'] = "";

        $page_url = '';
        if ($search_word = $this->input->get('search_word')) {
            $page_url = '?search_word='.$search_word;
            $data['search_word'] = $search_word;
        }

        if ($depth_1 = $this->input->get('depth_1', TRUE)) {
            $page_url = $page_url ? $page_url.'&depth_1='.$depth_1 : '?depth_1='.$depth_1;
            $data['depth_1'] = $depth_1;
        }

        if ($depth_2 = $this->input->get('depth_2', TRUE)) {
            $page_url = $page_url ? $page_url.'&depth_2='.$depth_2 : '?depth_2='.$depth_2;
            $data['depth_2'] = $depth_2;
        }

        if ($depth_3 = $this->input->get('depth_3', TRUE)) {
            $page_url = $page_url ? $page_url.'&depth_3='.$depth_3 : '?depth_3='.$depth_3;
            $data['depth_3'] = $depth_3;
        }
 
        // 페이징 주소
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/products/product/lists'.$page_url;
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
        $config['total_rows'] = $this->product_m->lists('tb_products', 'count','', '', $search_word, $depth_1, $depth_2, $depth_3);

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
 
        $data['list'] = $this->product_m->lists('tb_products', '', $start, $limit, $search_word, $depth_1, $depth_2, $depth_3);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;


        $this->load->view('admin/products/product', $data);
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
            // $this->form_validation->set_rules('contents', '내용', 'required');
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
                    'sub_title' => htmlspecialchars_decode($this->input->post('sub_title', TRUE),ENT_QUOTES),
                    'depth_1' => $this->input->post('depth_1', TRUE),
                    'depth_2' => $this->input->post('depth_2', TRUE),
                    'depth_3' => $this->input->post('depth_3', TRUE),
                    'model_name' => $this->input->post('model_name', TRUE),
                    'manufacturer' => $this->input->post('manufacturer', TRUE),
                    'type' => $this->input->post('type', TRUE),
                    'sensor_range' => $this->input->post('sensor_range', TRUE),
                    'sensor_outline' => $this->input->post('sensor_outline', TRUE),
                    'key_value' => $this->input->post('key_value', TRUE),
                    'page_fix' => $this->input->post('page_fix', TRUE),
                    'page_main' => $this->input->post('page_main', TRUE),
                    'thumb_img' => $res[0]['upload_data']['file_name'],
                    'img_list' => $this->input->post('img_list', TRUE),
                    'file_law_name' => $this->input->post('file_law_name', TRUE),
                    'file_real_name' => $this->input->post('file_real_name', TRUE),
                    'path' => $this->config->item("UPLOAD_PRODUCTS"),
                    // 'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'reg_date' => date('Y-m-d H:i:s')
                );


                $result = $this->product_m->insert($write_data);

                if ($result) {
                   replace($this->config->item('ADMIN_ROOT').'/products/product');
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
                $this->load->view('admin/products/product_write', $data);
            }
        } else {
            
            // 쓰기 폼 view 호출
            $data['hash'] = random_string('alnum', 32);
            while(!$this->cke_files_m->checkKey($data['hash'])) {
                $data['hash'] = random_string('alnum', 32);
            }

            $data['v'] = $v;
            $this->load->view('admin/products/product_write', $data);
        }
    }

   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->product_m->delete('tb_products', $this->uri->segment(5));
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
            // $this->form_validation->set_rules('contents', '내용', 'required');

            if($this->form_validation->run()) {
                $res = self::proc_file_upload(); // 파일업로드

                if($this->upload->data('file_name')==''){
                    $real_file_name = $this->input->post('thumb_chk', TRUE);
                }else{
                    $real_file_name = $this->upload->data('file_name');
                }

                // 변경 파일 삭제
                $before_list = $this->product_m->modify_file('tb_products', $this->uri->segment(5), 'file_law_name');
                $after_list = $this->input->post('file_law_name', TRUE);
                $compare_str = strcmp($before_list->file_law_name , $after_list);

                if($compare_str){ // 수정됨
                    $n_before_list = explode(',', $before_list->file_law_name);
                    $n_after_list = explode(',', $after_list);

                    $result_list =$after_list;
                    $result_real_name = $this->input->post('file_real_name', TRUE);

                    for($i=0; $i<count($n_before_list); $i++){
                        if(strstr($after_list, $n_before_list[$i])){

                        }
                        else{ // 파일 삭제
                            unlink("./uploads/products/".$n_before_list[$i]);
                        }
                    }
                }
                else{
                    // 같음
                    $result_list = $before_list->file_law_name;
                    $result_real_name = $this->product_m->modify_file('tb_products', $this->uri->segment(5), 'file_real_name')->file_real_name;
                }

                // 변경 파일 이미지
                $img_before_list = $this->product_m->modify_img('tb_products', $this->uri->segment(5));
                $img_after_list = $this->input->post('img_list', TRUE);
                $img_compare_str = strcmp($img_before_list->img_list , $img_after_list);


                if($img_compare_str){ // 수정됨
                    $img_n_before_list = explode(',', $img_before_list->img_list);
                    $img_n_after_list = explode(',', $img_after_list);

                    $img_result_list =$img_after_list;

                    for($i=0; $i<count($img_n_before_list); $i++){
                        if(strstr($img_after_list, $img_n_before_list[$i])){
                            
                        }
                        else{ // 파일 삭제
                            unlink("./uploads/products/".$img_n_before_list[$i]);
                        }
                    }
                }
                else{
                    // 같음
                    $img_result_list = $img_before_list->img_list;
                }

                $modify_data = array(
                    'table' => 'tb_products',
                    'idx' => $this->uri->segment(5),
                    'title' => $this->input->post('title', TRUE),
                    // 'sub_title' => $this->input->post('sub_title', TRUE),
                    'sub_title' => htmlspecialchars_decode($this->input->post('sub_title', TRUE),ENT_QUOTES),
                    'depth_1' => $this->input->post('depth_1', TRUE),
                    'depth_2' => $this->input->post('depth_2', TRUE),
                    'depth_3' => $this->input->post('depth_3', TRUE),
                    'model_name' => $this->input->post('model_name', TRUE),
                    'manufacturer' => $this->input->post('manufacturer', TRUE),
                    'type' => $this->input->post('type', TRUE),
                    'sensor_range' => $this->input->post('sensor_range', TRUE),
                    'sensor_outline' => $this->input->post('sensor_outline', TRUE),
                    'key_value' => $this->input->post('key_value', TRUE),
                    'page_fix' => $this->input->post('page_fix', TRUE),
                    'page_main' => $this->input->post('page_main', TRUE),
                    'thumb_img' => $real_file_name,
                    'img_list' => $img_result_list,
                    'file_law_name' => $result_list,
                    'file_real_name' => $result_real_name,
                    'path' => $this->config->item("UPLOAD_PRODUCTS"),
                    // 'contents' => htmlspecialchars_decode($this->input->post('contents', TRUE),ENT_QUOTES),
                    'open_yn' => $this->input->post('open_yn', TRUE)
                );

                $result = $this->product_m->modify($modify_data);

                if ($result) {
                    replace($this->config->item('ADMIN_ROOT').'/products/product');
                    exit;
                } else {
                    alert_after_history('수정중 오류가 발생했습니다', -1);
                    exit;
                }
            }
            $data['v'] = $v - 1;
            $data['views'] = $this->product_m->get_view('tb_products', $this->uri->segment(5));
            $this->load->view('admin/products/product_modify', $data);
        } else {
            $data['v'] = $v;
            $data['views'] = $this->product_m->get_view('tb_products', $this->uri->segment(5));
            $this->load->view('admin/products/product_modify', $data);
        }
    }

    function proc_file_upload(){
        $config['upload_path'] = '.'.$this->config->item("UPLOAD_PRODUCTS");
        $config['allowed_types'] = 'gif|jpg|png|pdf|pptx|ppt|xlsx|jfif|jpeg';
        $config['max_size'] = '104857600';
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
        $dir = "./uploads/products/";

        for($i=0; $i<$_POST['image_count']; $i++) {
            $image_id = "image_".$i;
            $image_file = time().$i.".".explode('/', $_FILES[$image_id]['type'])[1];

             // && $_FILES[$image_id]['size']<104857600
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

    function file_chk(){
        $result = '';

        $fileKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG','image/JFIF', 'image/X-PNG', 'image/PNG', 'image/png','image/jfif', 'image/x-png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/cdfv2-corrupt', 'application/haansofthwp');      
        $dir = "./uploads/products/";

        for($i=0; $i<$_POST['file_count']; $i++) {
            $file_id = "file_".$i;
            $file = time().$i.".".explode('/', $_FILES[$file_id]['type'])[1];

            // $temp_name = explode('/', $_FILES[$file_id]['type'])[1];
            // $file = time().$i.".".str_replace(',','',$temp_name);
            // && $_FILES[$file_id]['size']<104857600
            if(isset($_FILES[$file_id]) && !$_FILES[$file_id]['error'] ) {
                if(in_array($_FILES[$file_id]['type'], $fileKind)) {
                    if(move_uploaded_file($_FILES[$file_id]['tmp_name'], $dir.$file)) {
                        // echo "Success Upload <br/>";
                        echo $file."/";
                        echo $_FILES[$file_id]['name'].",";
                        // $result = 'success';
                    } else {
                        // echo "Error Upload <br/>";
                    }
                } else {
                    // echo "Not Type <br/>";
                }
            }
            else{
                // echo "Upload Fail <br/>";
            }

        }
    }

}