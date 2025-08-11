<?php 
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/**
* Menu 관리
**/

class Menu extends CI_Controller {
     
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'script'));
        $this -> load -> model('admin/menu_m');
        $this->load->model('cke_files_m');
        $this->load->library('form_validation');
        $this->config->load('setting');        
    }

    public function index() {
        $this->lists();
    }

    //상위 메뉴 리스트 페이지
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
        $config['base_url']                 = $this->config->item('ADMIN_ROOT').'/setting/menu/lists'.$page_url;
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
        $config['total_rows'] = $this->menu_m->lists('tb_menu', 'count','', '', $search_word);

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
 
        $data['list'] = $this->menu_m->lists('tb_menu', '', $start, $limit, $search_word);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        $data['limit'] = $config['per_page'];
        $data['page'] = $page;

        $this->load->view('admin/setting/menu', $data);
    }

    //상위 메뉴 등록
    function write() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            
            $this->load->library('upload');
             
            $this->form_validation->set_rules('menu_name', '메뉴명', 'required');
            $this->form_validation->set_rules('menu_code', '메뉴코드', 'required');
            if(empty($_FILES['userfile']['name'][0])) $this->form_validation->set_rules('userfile[0]', 'pc이미지', 'required');
            if(empty($_FILES['userfile']['name'][1])) $this->form_validation->set_rules('userfile[1]', 'mobile이미지', 'required');
            if(empty($_FILES['userfile']['name'][2])) $this->form_validation->set_rules('userfile[2]', 'header이미지', 'required');


            if($this->form_validation->run()) {
                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                //multi file upload 처리
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size'] = $files['userfile'] ['size'][$i];
                    $config['upload_path'] = '.' . $this->config->item("UPLOAD_MENU");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width'] = '5000';
                    $config['max_height'] = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload()) {
                        alert_after_history('이미지 업로드에 실패하였습니다', -2);
                        exit;
                    }

                    $raw_filename[] = $this->upload->data('file_name');
                }

                $write_data = array(
                    'menu_code' => $this->input->post('menu_code', TRUE),
                    'menu_name' => $this->input->post('menu_name', TRUE),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'menu_type' => $this->input->post('menu_type', TRUE),
                    'menu_desc' => $this->input->post('menu_desc', TRUE),
                    'menu_title' => $this->input->post('menu_title', TRUE),
                    'menu_sub_title' => $this->input->post('menu_sub_title', TRUE),
                    'sub_menu_yn' => $this->input->post('sub_menu_yn', TRUE),
                    'template_type' => $this->input->post('template_type', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'menu_bg_pc' => $raw_filename[0],
                    'menu_bg_mobile' => $raw_filename[1],
                    'menu_bg_header' => $raw_filename[2],
                    'path' => $this->config->item("UPLOAD_MENU"),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_menu'
                );

                //메뉴 순서 또는 메뉴 코드가 중복되었는지 체크
                //$test = $this->menu_code_dupl_chk();
                
                $result = $this->menu_m->insert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록록중 오류가 발했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $this->load->view('admin/setting/menu_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/setting/menu_write', $data);
        }
    }

    //상위 메뉴 수정
    function modify() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            
            $this->form_validation->set_rules('menu_name', '메뉴명', 'required');
            $this->form_validation->set_rules('menu_code', '메뉴코드', 'required');

            if($this->form_validation->run()) {

                $this->load->library('upload');

                $files = $_FILES;
                $cpt = count($_FILES['userfile']['name']);
                //multi file upload 처리
                for($i=0; $i<$cpt; $i++){
                    $_FILES['userfile']['name']=$files['userfile'] ['name'][$i];
                    $_FILES['userfile']['type']=$files['userfile'] ['type'][$i];
                    $_FILES['userfile']['tmp_name']=$files['userfile'] ['tmp_name'][$i];
                    $_FILES['userfile']['size']=$files['userfile'] ['size'][$i];

                    $config['upload_path'] = '.'.$this->config->item("UPLOAD_MENU");
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '10485760';
                    $config['max_width']  = '5000';
                    $config['max_height']  = '5000';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);
                    $this->upload->do_upload();

                    $raw_filename[] = $this->upload->data('file_name');
                }

                if($raw_filename[0]=='' || $raw_filename[0]=="" || $raw_filename[0]==null){
                    $raw_filename[0] = $this->input->post('thumb_chk', TRUE);
                }    
                // } else {
                //   $raw_filename[0] = "";
                //   //  remove_file($this->config->item("UPLOAD_MENU"), $this->input->post('thumb_chk', TRUE));
                // }
                
                if($raw_filename[1]=='' || $raw_filename[1]=="" || $raw_filename[1]==null){
                    $raw_filename[1] = $this->input->post('thumb_chk2', TRUE);
                } 
                    // else {
                //    // remove_file($this->config->item("UPLOAD_MENU"), $this->input->post('thumb_chk2', TRUE));
                // }

                if($raw_filename[2]=='' || $raw_filename[2]=="" || $raw_filename[2]==null){
                    $raw_filename[2] = $this->input->post('thumb_chk3', TRUE);
                }

                $modify_data = array(
                    'idx' => $this->input->post('idx', TRUE),
                    'menu_name' => $this->input->post('menu_name', TRUE),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'menu_type' => $this->input->post('menu_type', TRUE),
                    'menu_desc' => $this->input->post('menu_desc', TRUE),
                    'menu_title' => $this->input->post('menu_title', TRUE),
                    'menu_sub_title' => $this->input->post('menu_sub_title', TRUE),
                    'sub_menu_yn' => $this->input->post('sub_menu_yn', TRUE),
                    'template_type' => $this->input->post('template_type', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'menu_bg_pc' => $raw_filename[0],
                    'menu_bg_mobile' => $raw_filename[1],
                    'menu_bg_header' => $raw_filename[2],
                    'path' => $this->config->item("UPLOAD_MENU"),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_menu'
                );

                $result = $this->menu_m->modify($modify_data);

                if ($result) {
                   history($v);
                   exit;
                } else {
                   alert_after_history('수정중 오류가 발생했습니다', -1);
                   exit;
                }
            }else {
                $data['v'] = $v - 1;
                $data['views'] = $this->menu_m->get_view('tb_menu', $this->uri->segment(5));
                $this->load->view('admin/setting/menu_modify', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $data['views'] = $this->menu_m->get_view('tb_menu', $this->uri->segment(5));
            $this->load->view('admin/setting/menu_modify', $data);
        }
    }

    //하위메뉴 리스트 페이지
    //하위메뉴에는 페이징이 필요 없음
    public function subMenu() {
         echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        $data['search_word'] = "";
        $page_url = '';
        if ($search_word = $this->input->get('search_word')) {
            $page_url = '?search_word='.$search_word;
            $data['search_word'] = $search_word;
        }

        $menu_up_code = $this->uri->segment(5);           

        // 게시물 전체 개수    
        $config['total_rows'] = $this -> menu_m -> sub_menu_lists('tb_menu', 'count', $menu_up_code);
        $data['list'] = $this -> menu_m -> sub_menu_lists('tb_menu', '', $menu_up_code);
        
        //게시판 넘버링을 위한 값 전달
        $data['total_row'] = $config['total_rows'];
        
        $this -> load -> view('admin/setting/subMenu', $data);
    }

    //하위메뉴 등록
    function subMenuWrite() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            
            $this->form_validation->set_rules('menu_name', '메뉴명', 'required');
            $this->form_validation->set_rules('menu_code', '메뉴코드', 'required');

             if($this->form_validation->run()) {
             
                $write_data = array(
                    'menu_code' => $this->input->post('menu_code', TRUE),
                    'menu_up_code' => $this->uri->segment(5) ,
                    'menu_name' => $this->input->post('menu_name', TRUE),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'menu_type' => $this->input->post('menu_type', TRUE),
                    'menu_desc' => $this->input->post('menu_desc', TRUE),
                    'menu_title' => $this->input->post('menu_title', TRUE),
                    'menu_sub_title' => $this->input->post('menu_sub_title', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_menu'
                );

                $result = $this->menu_m->subMenuInsert($write_data);

                if ($result) {
                    history($v);
                    exit;
                } else {
                    alert_after_history('등록록중 오류가 발했습니다', -1);
                    exit;
                }
            }else {
                $data['v'] = $v - 1;
                $this->load->view('admin/setting/subMenu_write', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $this->load->view('admin/setting/subMenu_write', $data);
        }
    }

    //하위메뉴 수정
    function subMenuModify() {
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        //validation history
        $v = $this->input->post('v', TRUE);
        $v = $v ? $v : -2;
        //validation history

        //post로 전송된 값이 있을 경우
        if ($_POST) {
            
            $this->form_validation->set_rules('menu_name', '메뉴명', 'required');
            $this->form_validation->set_rules('menu_code', '메뉴코드', 'required');

            if($this->form_validation->run()) {

                $modify_data = array(
                    'idx' => $this->input->post('idx', TRUE),
                    'menu_name' => $this->input->post('menu_name', TRUE),
                    'menu_order' => $this->input->post('menu_order', TRUE),
                    'menu_type' => $this->input->post('menu_type', TRUE),
                    'menu_desc' => $this->input->post('menu_desc', TRUE),
                    'menu_title' => $this->input->post('menu_title', TRUE),
                    'menu_sub_title' => $this->input->post('menu_sub_title', TRUE),
                    'text_color' => $this->input->post('text_color', TRUE),
                    'link_url' => $this->input->post('link_url', TRUE),
                    'open_yn' => $this->input->post('open_yn', TRUE),
                    'table' => 'tb_menu'
                );

                $result = $this->menu_m->subMenuModify($modify_data);

                if ($result) {
                   history($v);
                   exit;
                } else {
                   alert_after_history('수정중 오류가 발생했습니다', -1);
                   exit;
                }
            }else {
                $data['v'] = $v - 1;
                $data['views'] = $this->menu_m->get_view('tb_menu', $this->uri->segment(5));
                $this->load->view('admin/setting/subMenu_modify', $data);
            }
        } else {
            // 쓰기 폼 view 호출
            $data['v'] = $v;
            $data['views'] = $this->menu_m->get_view('tb_menu', $this->uri->segment(5));
            $this->load->view('admin/setting/subMenu_modify', $data);
        }
    } 
   
    //게시물 삭제
    function delete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        $data = $this->menu_m->get_view('tb_menu', $this->uri->segment(5));
        $return = $this->menu_m->delete('tb_menu', $this->uri->segment(5));
        $v = $this->input->get('v');

        if ($return) {
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

    //하위메뉴 삭제
    function subMenuDelete() {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
 
        $return = $this->menu_m->delete('tb_menu', $this->uri->segment(5));
        
        if ( $return ) {
            replace($this->config->item('ADMIN_ROOT').'/setting/menu');
            exit;
        } else {
            alert('삭제 중 오류가 발생했습니다.', $this->config->item('ADMIN_ROOT').'/setting/menu/subMenu/'.$this->uri->segment(5));
            exit;
        }
        
    }

    //서버 단에서 메뉴 코드 중복 확인하기
    function menu_code_dupl_chk(){
       
        $menu_code = $this->input->post('menu_code', TRUE);            
        $result = $this->menu_m -> menu_code_chk($menu_code);
       
        if($result){
          alert_after_history('중복코드', $v);
          exit;
        }
    }


    function menu_code_chk(){
       
        $menu_code = $this->input->post('menu_code', TRUE);            
        

        $result = $this->menu_m -> menu_code_chk($menu_code);
       
        if($result){
           $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
           echo "fail";

        }else{
           $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "success";

        }
    }

    public function order_no_chk() {
        
        $menu_data = array(
            'menu_order' => $this->input->post('menu_order', TRUE),
            'menu_level' => $this->input->post('menu_level', TRUE) 
        );

        $result = $this->menu_m->order_no_chk($menu_data);
        
        if($result){
           $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
           echo "fail";

        }else{
           $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "success";

        }
    }

    public function sub_order_no_chk() {
        
        $menu_data = array(
                'menu_order' => $this->input->post('menu_order', TRUE),
                'menu_level' => $this->input->post('menu_level', TRUE), 
                'menu_up_code' => $this->input->post('menu_up_code', TRUE), 
        );

        $result = $this->menu_m->sub_order_no_chk($menu_data);

        if($result){
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "fail";

        }else{
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "success";

        }
    }

    // 메뉴 order 수정
    // key:menu_code, value : menu_order
    public function modify_menuOrder(){

        $menu = $this->input->post('menu', TRUE);

        for($i=0; $i<count($menu); $i++){
            $data = array(
                'menu_order' => intval($i)+intval(1),
                'menu_code' => $menu[$i],
            );

            $result = $this->menu_m->modify_menuOrder($data);
        }

        if($result){
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "fail";

        }else{
            $this->output->set_header("Content-Type: text/html; charset=UTF-8;"); 
            echo "success";

        }
    }
}
