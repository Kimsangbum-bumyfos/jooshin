<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Post_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 공지사항 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE (title like "%' . $search_word . '%" OR contents like "%'.$search_word.'%")'." ";
        }


        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }

                
        //$sql = "SELECT * FROM " . $table . $sword .$limit_query;
        //공지유형 공통코드에서 가져오기 위해서 서브쿼리로 변경함

        $sql = " SELECT *, (select menu_name from tb_menu b where b.menu_code = a.menu_code) as menu_name FROM tb_posts a" . $sword .$limit_query;

        $query = $this->db->query($sql);
 
        if ($type == 'count') {
            $result = $query->num_rows();
        } else {
            $result = $query->result();
        }
        return $result;
    }

    /**
    * 포스트 등록
    */
    function insert($arrays) {        


        $result = $this->db->insert('tb_posts', $arrays);
        return $result;
    }

    /**
    * 포스트 삭제
    */
    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    /**
    * 포스트 수정
    */
    function modify($arrays) {

         //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
            'title' => $arrays['title'],
            'sub_title' => $arrays['sub_title'],
            'menu_code' => $arrays['menu_code'],
            'menu_up_code' => $arrays['menu_up_code'],
            'contents' => $arrays['contents'],
            'excerpt' => $arrays['excerpt'],
            'open_yn' => $arrays['open_yn'],
            'tags' => $arrays['tags'],
            'path' => $arrays['path'],
            'thumb_img' => $arrays['thumb_img'],
            'modify_date' => date("Y-m-d H:i:s")
        );

        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
    }


    //메뉴 코드 가져오기
    //포스트 신규 생성 시 메뉴를 생성한다.
    function getMenuList() { 
      //$sql = "select * from fr_menu where menu_status='Y' and menu_level=1 and menu_type='CONTS' order by menu_level";
      $sql = " select * from tb_menu where open_yn ='Y' and menu_type='CONTS' and menu_level= '1' ";
      $query = $this -> db -> query($sql);
      $rows = $query -> result();
      
      $result='';
      foreach ($rows as $row){
        
        if($this -> subMenuList($row->menu_code,$row->menu_name,'')){
            $result.= $this -> subMenuList($row->menu_code,$row->menu_name,'');            
        }else{

            $result .="<option value='$row->menu_code'>"; 
            $result.= $row->menu_name;
            $result.= "</option>";
        }
      }
      return $result;
    }

    //포스트 신규 생성 시 메뉴를 생성한다.
    function getModiMenuList($chk_code) { 
      $sql = " select * from tb_menu where open_yn ='Y' and menu_type='CONTS' and menu_level= '1' ";
      $query = $this -> db -> query($sql);
      $rows = $query -> result();
      
      $result='';
      $seletChk='';

      foreach ($rows as $row){
        
        if($this -> subMenuList($row->menu_code,$row->menu_name,$chk_code)){
            $result.= $this -> subMenuList($row->menu_code,$row->menu_name,$chk_code);            
        }else{

            if($row->menu_code===$chk_code){         
              $seletChk ="selected";
            }else{
              $seletChk ="";
            }      
            $result.="<option value='$row->menu_code'"  .  $seletChk . ">";            
            $result.= $row->menu_name;
            $result.= "</option>";
        }
      }
      return $result;
    }

    //포스트 신규 생성 시 메뉴를 생성한다.
    function subMenuList($menu_code,$menu_name, $chk_code) { 
        $sql = "select * from tb_menu where open_yn='Y' and menu_type='CONTS' and menu_up_code = '" . $menu_code . "' order by menu_order";
        $query = $this -> db -> query($sql);
        $rows = $query -> result();

        $result='';
        $seletChk='';
        
        foreach ($rows as $row){

            if($row->menu_code===$chk_code){         
              $seletChk ="selected";
            }else{
              $seletChk ="";
            }     
            $result.="<option value='$row->menu_code'"  .  $seletChk . ">";
            $result.= $menu_name.'>'.$row->menu_name;
            $result.= "</option>";
        }
        return $result;
    }

    function getMenuUpCode($menu_code) {
        $sql = "SELECT menu_up_code FROM tb_menu WHERE menu_code = '" . $menu_code . "' ";
        $query = $this -> db -> query($sql);

        $rows = $query -> result();

        foreach ($rows as $row) {
            $result = $row->menu_up_code;
        }
        return $result;
    }    
 

    /**
    * 포스트 상세보기
    */
    function get_view($table, $id) {
       // 조횟수 증가
       // $sql0 = "UPDATE " . $table . " SET view_cnt = view_cnt + 1 WHERE idx='" . $id . "'";
       // $this->db->query($sql0);
 
       $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
       $query = $this->db->query($sql);
 
       // 게시물 내용 반환
       $result = $query->row();
 
       return $result;
     }

 
}