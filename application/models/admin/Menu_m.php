<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Menu_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
    *  상위 메뉴 관리 리스트
    */
    
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

      $limit_query = '';
      $sword = '';

      if ($search_word != '') {
          // 검색어 있을 경우
          $sword = ' WHERE menu_level=1 and menu_name like "%' . $search_word . '%"';
      }else{
          $sword = ' WHERE menu_level=1 ' ;
      }

      if ($limit !== '' OR $offset !== '') {
          // 페이징이 있을 경우 처리
          $limit_query = ' ORDER BY MENU_ORDER ASC LIMIT ' . $offset . ', ' . $limit;
      }
      
      $sql = " SELECT * FROM " . $table . $sword .$limit_query;

      $query = $this -> db -> query($sql);

      if ($type == 'count') {
          $result = $query -> num_rows();
      } else {
          $result = $query -> result();
      }
      return $result;
    }


    /**
    * 상위메뉴 등록
    */
    function insert($arrays) {

      //time존 설정
      date_default_timezone_set('Asia/Seoul');
    
      $insert_array = array(
         'menu_name' => $arrays['menu_name'],
         'menu_code' => $arrays['menu_code'],
         'menu_order' => $arrays['menu_order'],
         'menu_level' => '1',
         'menu_type' => $arrays['menu_type'],
         'menu_desc' => $arrays['menu_desc'],
         'menu_title' => $arrays['menu_title'],
         'menu_sub_title' => $arrays['menu_sub_title'],
         'sub_menu_yn' => $arrays['sub_menu_yn'],
         'template_type' => $arrays['template_type'],
         'text_color' => $arrays['text_color'],
         'link_url' => $arrays['link_url'],
         'path' => $arrays['path'],
         'menu_bg_pc' => $arrays['menu_bg_pc'],
         'menu_bg_mobile' => $arrays['menu_bg_mobile'],
         'menu_bg_header' => $arrays['menu_bg_header'],
         'open_yn' => $arrays['open_yn'],           
         'reg_date' => date("Y-m-d H:i:s")
      );

      $result = $this->db->insert($arrays['table'], $insert_array);
      
      return $result;
    }

    /**
    * 상위메뉴 수정
    */
    function modify($arrays) {

      //time존 설정
      date_default_timezone_set('Asia/Seoul');

      $modify_array = array(
       'menu_name' => $arrays['menu_name'],
       'menu_order' => $arrays['menu_order'],
       'menu_level' => '1',
       'menu_type' => $arrays['menu_type'],
       'menu_desc' => $arrays['menu_desc'],
       'menu_title' => $arrays['menu_title'],
       'menu_sub_title' => $arrays['menu_sub_title'],
       'sub_menu_yn' => $arrays['sub_menu_yn'],
       'template_type' => $arrays['template_type'],
       'text_color' => $arrays['text_color'],
       'link_url' => $arrays['link_url'],
       'menu_bg_pc' => $arrays['menu_bg_pc'],
       'menu_bg_mobile' => $arrays['menu_bg_mobile'],
       'menu_bg_header' => $arrays['menu_bg_header'],
       'open_yn' => $arrays['open_yn'],           
       'modify_date' => date("Y-m-d H:i:s")
      );

      $where = array(
          'idx' => $arrays['idx']
      );
      
      $result = $this->db->update($arrays['table'], $modify_array, $where);
      
      return $result;
    }


    function subMenuInsert($arrays) {

      //time존 설정
      date_default_timezone_set('Asia/Seoul');
    
      $insert_array = array(
         'menu_name' => $arrays['menu_name'],
         'menu_code' => $arrays['menu_code'],
         'menu_up_code' => $arrays['menu_up_code'],
         'menu_order' => $arrays['menu_order'],
         'menu_level' => '2',
         'menu_type' => $arrays['menu_type'],
         'menu_desc' => $arrays['menu_desc'],
         'menu_title' => $arrays['menu_title'],
         'menu_sub_title' => $arrays['menu_sub_title'],
         'text_color' => $arrays['text_color'],
         'link_url' => $arrays['link_url'],
         'open_yn' => $arrays['open_yn'],           
         'reg_date' => date("Y-m-d H:i:s")
      );

      $result = $this->db->insert($arrays['table'], $insert_array);
      
      return $result;
    }

    /**
     * menu_code 중복체크
     */
    function menu_code_chk($menu_code){
     
      $sword = ' WHERE menu_code = "' . $menu_code . '"';

      $sql = " SELECT * FROM tb_menu" . $sword ;

      $query = $this -> db -> query($sql);

      $result = $query -> result();
     
      return $result;
    }   

     /**
     * 게시물 상세보기 가져오기
     *
     * @param string $table 게시판 테이블
     * @param string $id 게시물 번호
     * @return array
     */
    function get_view($table, $id) {
        // 조횟수 증가
       // $sql0 = "UPDATE " . $table . " SET hits = hits + 1 WHERE board_id='" . $id . "'";
       // $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this -> db -> query($sql);

        // 게시물 내용 반환
        $result = $query -> row();
 
        return $result;
    }

    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function subMenuModify($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
         'menu_name' => $arrays['menu_name'],
         'menu_order' => $arrays['menu_order'],
         'menu_level' => '2',
         'menu_type' => $arrays['menu_type'],
         'menu_desc' => $arrays['menu_desc'],
         'menu_title' => $arrays['menu_title'],
         'menu_sub_title' => $arrays['menu_sub_title'],
         'text_color' => $arrays['text_color'],
         'link_url' => $arrays['link_url'],
         'open_yn' => $arrays['open_yn'],           
         'modify_date' => date("Y-m-d H:i:s")
        );

        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
    }

     function order_no_chk($menu_data){

        $menu_order = $menu_data['menu_order'];
        $menu_level = $menu_data['menu_level'];

        $sql = " SELECT * FROM tb_menu" . " WHERE menu_level = '" . $menu_level . "' and menu_order = '" . $menu_order . "' ";

        $query = $this -> db -> query($sql);

        if($query -> num_rows()>0){
          return TRUE;          
        }else{
          return FALSE;          
        }
    }

    function sub_menu_lists($table , $type = '', $menu_up_code) {

      $limit_query = '';
      $sword = '';

      $sword = ' WHERE menu_level=2 and menu_up_code = "' . $menu_up_code . '"';
       
      $limit_query = ' ORDER BY MENU_ORDER ASC ';
       
        
      $sql = " SELECT * FROM " . $table . $sword .$limit_query;

      $query = $this -> db -> query($sql);
 
      if ($type == 'count') {
          $result = $query -> num_rows();
      } else {
          $result = $query -> result();
      }
      return $result;
    }

     function sub_order_no_chk($menu_data){

        $menu_order = $menu_data['menu_order'];
        $menu_level = $menu_data['menu_level'];
        $menu_up_code = $menu_data['menu_up_code'];

        $sql = " SELECT * FROM tb_menu" . " WHERE menu_level ='" . $menu_level ."' and menu_order ='" . $menu_order . "' and menu_up_code ='". $menu_up_code . "'  ";
        $query = $this -> db -> query($sql);

        if($query -> num_rows() >0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // function delete($table, $idx) {
    //   $delete_array = array(
    //       'idx' => $idx
    //   );

    //   $delete_posts_code_array = array(
    //       'post_menu_code' => $no,
    //   );

    //   $delete_posts_up_code_array = array(
    //       'post_menu_up_code' => $no,
    //   );

    //   $result = $this->db->delete($table, $delete_array);
    //   if($result){
    //     $result = $this->db->delete('fr_posts', $delete_posts_code_array);
    //     $result = $this->db->delete('fr_posts', $delete_posts_up_code_array);
    //   }

    //   return $result;
    // }

    function delete($table, $idx) {
      $delete_array = array(
          'idx' => $idx
      );   
      $result = $this->db->delete($table, $delete_array);
      
      return $result;
    }
    

   //  function insert_sub_menu($arrays) {

   //      //time존 설정
   //      date_default_timezone_set('Asia/Seoul');
      
   //      $insert_array = array(
   //         'menu_name' => $arrays['menu_name'],
   //         'menu_code' => $arrays['menu_code'],
   //         'menu_up_code' => $arrays['menu_up_code'],
   //         'menu_order' => $arrays['menu_order'],
   //         'menu_level' => $arrays['menu_level'],
   //         'menu_type' => $arrays['menu_type'],
   //         'menu_title' => $arrays['menu_title'],
   //         'menu_sub_title' => $arrays['menu_sub_title'],
   //         'link_url' => $arrays['link_url'],
   //         'menu_status' => $arrays['menu_status'],           
   //         'reg_date' => date("Y-m-d H:i:s")
   //      );

   //      $result = $this->db->insert($arrays['table'], $insert_array);
        
   //      return $result;
   //  }
    

   // function delete($table, $no) {
   //      $delete_array = array(
   //          'menu_code' => $no
   //      );

   //      $delete_posts_code_array = array(
   //          'post_menu_code' => $no,
   //      );

   //      $delete_posts_up_code_array = array(
   //          'post_menu_up_code' => $no,
   //      );

   //      $result = $this->db->delete($table, $delete_array);
   //      if($result){
   //        $result = $this->db->delete('fr_posts', $delete_posts_code_array);
   //        $result = $this->db->delete('fr_posts', $delete_posts_up_code_array);
   //      }

   //      return $result;
   //  }

   //  function sub_menu_delete($table, $no) {
   //      $delete_array = array(
   //          'menu_code' => $no
   //      );
        
   //      $result = $this->db->delete($table, $delete_array);
   //      $delete_posts_code_array = array(
   //          'post_menu_code' => $no,
   //      );

   //      $result = $this->db->delete($table, $delete_array);
        
   //      if($result){
   //        $result = $this->db->delete('fr_posts', $delete_posts_code_array);
   //      }
        
   //      return $result;
   //  }

   //  /**
   //   * 게시물 수정
   //   * 
   //   * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
   //   * @return boolean 성공 여부
   //   */
   //  function modify($arrays) {

   //      //time존 설정
   //      date_default_timezone_set('Asia/Seoul');

   //      $modify_array = array(
   //         'menu_name' => $arrays['menu_name'],
   //         'menu_order' => $arrays['menu_order'],
   //         'menu_type' => $arrays['menu_type'],
   //         'menu_title' => $arrays['menu_title'],
   //         'menu_sub_title' => $arrays['menu_sub_title'],
   //         'link_url' => $arrays['link_url'],
   //         'menu_bg_pc' => $arrays['menu_bg_pc'],
   //         'menu_bg_mobile' => $arrays['menu_bg_mobile'],
   //         'menu_status' => $arrays['menu_status'],           
   //         'modify_date' => date("Y-m-d H:i:s")
   //      );

   //      $where = array(
   //          'menu_code' => $arrays['menu_code']
   //      );
        
   //      $result = $this->db->update($arrays['table'], $modify_array, $where);
        
   //      return $result;
   //  }

   //  function sub_menu_modify($arrays) {

   //      //time존 설정
   //      date_default_timezone_set('Asia/Seoul');

   //      $modify_array = array(
   //         'menu_name' => $arrays['menu_name'],
   //         'menu_order' => $arrays['menu_order'],
   //         'menu_type' => $arrays['menu_type'],
   //         'menu_title' => $arrays['menu_title'],
   //         'menu_sub_title' => $arrays['menu_sub_title'],
   //         'link_url' => $arrays['link_url'],
   //         'menu_status' => $arrays['menu_status'],           
   //         'modify_date' => date("Y-m-d H:i:s")
   //      );

   //      $where = array(
   //          'menu_code' => $arrays['menu_code']
   //      );
        
   //      $result = $this->db->update($arrays['table'], $modify_array, $where);
        
   //      return $result;
   //  }

   

   //    function sub_order_no_chk($menu_data){

   //       $menu_order = $menu_data['menu_order'];
   //       $menu_level = $menu_data['menu_level'];
   //       $menu_up_code = $menu_data['menu_up_code'];

   //      $sql = " SELECT * FROM fr_menu" . " WHERE menu_level = '" . $menu_level . "' and menu_order = '" . $menu_order . "' and menu_up_code = '" . $menu_up_code . "'  ";
   //      $query = $this -> db -> query($sql);

   //      if($query -> num_rows() >0){
   //          return TRUE;
   //      }else{
   //          return FALSE;
   //      }
   //  }

    function modify_menuOrder($data){
      $sql = "UPDATE tb_menu SET menu_order =" . $data['menu_order']. "  WHERE menu_code = '" . $data['menu_code'] . "'";
      $query = $this -> db -> query($sql);
    }
}