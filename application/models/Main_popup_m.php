<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Main_popup_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 관리자 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE title like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        
        //$sql = "SELECT * FROM " . $table . $sword .$limit_query;
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
     * 게시물 입력
     * 
     * @param array $arrays 테이블 명, 게시물 제목, 게시물 내용 1차 배열
     * @return boolean 입력 성공여부
     */

    function insert($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $insert_array = array(
           'title' => $arrays['title'],
           's_date' => $arrays['s_date'],
           'e_date' => $arrays['e_date'],
           'popup_type' => $arrays['popup_type'],
           'device_type' => $arrays['device_type'],
           'open_yn' => $arrays['open_yn'],
           'cookie_yn' => $arrays['cookie_yn'],
           'link_url' => $arrays['link_url'],
           'link_target' => $arrays['link_target'],
           'pc_img' => $arrays['pc_img'],
           'mobile_img' => $arrays['pc_img'],
           'reg_date' => date("Y-m-d H:i:s")
        );

        $result = $this->db->insert($arrays['table'], $insert_array);
        
        return $result;
    }

    function delete($table, $no) {
        $delete_array = array(
            'idx' => $no
        );
        
        $result = $this->db->delete($table, $delete_array);
        
        return $result;
    }

    /**
     * 게시물 수정
     * 
     * @param array $arrays 테이블 명, 게시물 번호, 게시물 제목, 게시물 내용
     * @return boolean 성공 여부
     */
    function modify($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $modify_array = array(
           'title' => $arrays['title'],
           's_date' => $arrays['s_date'],
           'e_date' => $arrays['e_date'],
           'status' => $arrays['status'],
           'content_type' => $arrays['content_type'],
           'cookie_yn' => $arrays['cookie_yn'],
           'link_url' => $arrays['link_url'],
           'link_target' => $arrays['link_target'],
           'pc_img' => $arrays['pc_img'],
           'modify_date' => date("Y-m-d H:i:s")
        );

        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
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

    function subMenuList($menu_code,$m_code){
      $sql = "select *, (select menu_name from fr_menu where menu_code='" . $menu_code . "') as top_menu_name  from fr_menu where menu_status='Y' and menu_type='CONTS' and menu_up_code = '" . $menu_code . "' order by menu_order";
      $query = $this -> db -> query($sql);
      $rows = $query -> result();
      $count = $query -> num_rows();

      $result="";
      if($count>0){
        foreach ($rows as $row) {

          if($row->menu_code==$m_code){
           // echo "star";
            $select ="selected";
          }else{
            $select ="";
          }

          $result.="<option value='$row->menu_code'"  .  $select . ">";
          $result.=$row->top_menu_name.">".$row->menu_name;
          $result.="</option>";
        }
      }
      return $result;

    }

    //1depth 아래 서브 메뉴가 있는지 체크한다.
    //count가 0이상이면 서브 메뉴가 있다.
    function subMenuCount($menu_code){
     $sql = "select * from fr_menu where menu_status='Y' and menu_type='CONTS' and menu_up_code = '" . $menu_code . "' order by menu_order";
     $query = $this -> db -> query($sql);
     $rows = $query -> result();

     $count = $query -> num_rows();

     return $count;

    }

    //포스트 신규 생성 시 메뉴를 생성한다.
    function makeMenuList() { 
      $sql = "select * from fr_menu where menu_status='Y' and menu_level=1 and menu_type='CONTS' order by menu_level";
      $query = $this -> db -> query($sql);
      $rows = $query -> result();
      
      //포스트 신규 등록시에는 selected 옵션이 필요 없기 때문에 메뉴만 생성한다.
      $result='';
      foreach ($rows as $row){
        
        if($this ->subMenuCount($row->menu_code) > 0){
          $result.= $this -> subMenuList($row->menu_code,'');
        }else{
          $result .="<option value='$row->menu_code'>"; 
          $result.= $row->menu_name;
          $result.= "</option>";  
        }
      }     
     return $result;
    }

    //콘텐츠 수정 시 메뉴 생성
    function editMenuList($m_code) { 
      //1depth에 대항하는 메뉴만 가져온다.
      $sql = "select * from fr_menu where menu_status='Y' and menu_level=1 and menu_type='CONTS' order by menu_level";
      $query = $this -> db -> query($sql);
      $rows = $query -> result();
  
      $result='';
      foreach ($rows as $row){        
        
        //서브 메뉴가 있는 경우에 서브 메뉴를 만드는 함수를 호출한다.
        if($this ->subMenuCount($row->menu_code) > 0){
          $result.= $this -> subMenuList($row->menu_code,$m_code);
        //서브 메뉴가 없는 경우 1depth로 메뉴를 구성한다.
        }else{

          //option selected 생성
          if($row->menu_code==$m_code){
            $select ="selected";
          }else{
            $select ="";
          }

          $result.="<option value='$row->menu_code'"  .  $select . ">";
          $result.= $row->menu_name;
          $result.= "</option>";  
        }
      }     
     return $result;
    }
}