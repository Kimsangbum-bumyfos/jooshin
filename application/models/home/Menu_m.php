<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
Class Menu_m extends CI_Model {
  function __construct() {
      parent::__construct();
      $this->config->load('setting');
  }

 
  function makeMenuList() { 
   
    //Menu Level이 1이고 Menu Type이 콘텐츠, 게시판 전부 가져온다.
    $sql = "select * from fr_menu where menu_status='Y' and menu_level=1 order by menu_order asc";
    $query = $this -> db -> query($sql);
    $rows = $query -> result();
    
    $result="";

    $active = "";
    $this->uri->segment(2);


    foreach ($rows as $row){
      
      //서브 메뉴가 있는 경우 서브 메뉴를 생성한다.
      if($this ->subMenuCount($row->menu_code) > 0){

        //메뉴 활성화 class check
        if($this->uri->segment(2)==$row->menu_code){
          $active = "active";
        }

        //custom url 체크
        if($row->link_url !==""){
          $link_url = $row->link_url;
          $link_target = "_blank";
        }else{
          $link_url = '/dev2/manual/index/sub/'.$row->menu_code;
          $link_target = "_self";
        }

        //Dropdown 메뉴 대메뉴 생성 
        $result.="<li class='nav-item dropdown'>";
        $result.="<a class='dropdown-toggle' data-toggle='dropdown' data-hover='dropdown' data-delay='0' data-close-others='false' href='$link_url'>$row->menu_name <i class='fa fa-angle-down'></i></a>";
        $result.=" <ul class='dropdown-menu'>";

        $result.= $this -> subMenuList($row->menu_code,'');
        $result.="</ul>";
        $result.="</li>";

      //서브 메뉴가 없는 경우 1Depth메뉴만 생성한다.   
      }else{

        //custom url 체크
        if($row->link_url !==""){
          $link_url = $row->link_url;
          $link_target = "_blank";
        }else{
          $link_url = '/dev2/manual/index/sub/'.$row->menu_code;
          $link_target = "_self";
        }
        $result .="<li class='nav-item $active'><a href='$link_url' target='$link_target'>$row->menu_name</a></li>"; 
      }
    }     
   return $result;
  }

  //1depth 아래 서브 메뉴가 있는지 체크한다.
  //count가 0이상이면 서브 메뉴가 있다.
  function subMenuCount($menu_code){
   $sql = "select * from fr_menu where menu_status='Y' and menu_up_code = '" . $menu_code . "' order by menu_order asc";
   $query = $this -> db -> query($sql);
   $rows = $query -> result();

   $count = $query -> num_rows();

   return $count;

  }    

  function get_menu_up_code($menu_code) {

    $sql = "SELECT menu_up_code FROM fr_menu WHERE menu_code = '" . $menu_code . "' ";
    $query = $this -> db -> query($sql);

    $rows = $query -> result();

    foreach ($rows as $row) {
      $result = $row->menu_up_code;
    }

    return $result;
   }


  //메뉴 코드에 해당하는 서브 메뉴 리스트를 생성한다. 
  function subMenuList($menu_code,$m_code){
    $sql = "select *, (select menu_name from fr_menu where menu_code='" . $menu_code . "') as top_menu_name  from fr_menu where menu_status='Y' and menu_up_code = '" . $menu_code . "' order by menu_order asc";
    
    $query = $this -> db -> query($sql);
    $rows = $query -> result();
    $count = $query -> num_rows();

    $result="";

    if($count>0){
      
      foreach ($rows as $row) {
        
        //custom url 체크
        if($row->link_url !==""){
          $link_url = $row->link_url;
          $link_target = "_blank";
        }else{
          $link_url = '/dev2/manual/index/sub/'.$row->menu_code;
          $link_target = "_self";
        }
        $result.="<li><a href='$link_url' target='$link_target'>$row->menu_name</a></li>";
      }
    }
    return $result;

  }
}