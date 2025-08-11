<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Post_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function postList($arr) {
        $menu_code = $arr['menu_code'];
        $menu_up_code = $arr['menu_up_code'];
        $menu_level = $arr['menu_level'];
        $search_word = $arr['search_word'];
        $sword="";

        if ($search_word != '') {        
            $sword .= " AND (title like '%$ %' OR contents like '%$search_word%' OR tags like '%$search_word%')";
        }

        //대메뉴 코드가 널인 경우는 서브 메뉴가 없는 경우이므로 자신의 메뉴코드에 해당하는 것만 리턴한다.
        if($menu_up_code == '' || $menu_up_code == NULL){
            
            if ($menu_code != '') {
                $sword .=" AND menu_code ='".$menu_code."' ";
            }    

        //서브 메뉴가 있는데 1차 대메뉴를 클릭한 경우
        //서브 메뉴에 소속된 모든 콘텐츠 리스트 출력

        }else if($menu_up_code != '' && $menu_level == '1'){
            if ($menu_code != '') {
                $sword .=" AND menu_up_code ='".$menu_up_code."' ";
            }
        
        }else if($menu_up_code != '' && $menu_level != '1'){
            if ($menu_code != '') {
                $sword .=" AND menu_code ='".$menu_code."' ";
            }
        }

        // if ($menu_code != '') {
        //     $sword .=" AND menu_code ='".$menu_code."' ";
        // }

        // if ($menu_up_code != '') {
        //     $sword .=" AND menu_up_code ='".$menu_up_code."' ";
        // }

        $start = ($arr['offset'] - 1) * $arr['limit'];
        $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];

        $sql = " SELECT idx,
                        menu_code,
                        menu_up_code,
                        title,
                        sub_title,
                        s_date,
                        e_date,
                        excerpt,
                        path,
                        thumb_img
                        FROM tb_posts where open_yn='Y' " . $sword.$limit;

        $query = $this->db->query($sql);
        $list = $query->result();

        // 메뉴, 검색어에 따른 포스트 전체 갯수
        $sql_cnt = " SELECT * FROM tb_posts WHERE open_yn ='Y' ".$sword ;
        $query = $this->db->query($sql_cnt);  
        $total_count = $query->num_rows();

        if($list){
            $result = array('total_count' => $total_count, 'data' => $list);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;       
    }

    //포스트 게시물 상세보기
    function postView($idx) {
        
       //게시물 카운터를 증가시킨다.
       $sql_cnt = "update tb_posts set view_cnt=view_cnt+1 WHERE idx=$idx";
       $this->db->query($sql_cnt);


       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_posts WHERE idx=$idx AND open_yn='Y'";
       $query = $this->db->query($sql);
       $data = $query->result();


       $sql = "SELECT idx, title FROM tb_posts WHERE idx > $idx AND open_yn='Y' LIMIT 1";
       $query = $this->db->query($sql);
       $next_data = $query->result();
       $next_data = $next_data ? $next_data : 'NO DATA';

        $sql = "SELECT idx, title FROM tb_posts WHERE idx < $idx AND open_yn='Y' ORDER BY idx DESC LIMIT 1";
        $query = $this->db->query($sql);
        $prev_data = $query->result();
        $prev_data = $prev_data ? $prev_data : 'NO DATA';



       if($data){
           $result = array('data' => $data,
                            'next_data' => $next_data,
                            'prev_data' => $prev_data                     
                           );
       }else{
           $result = array('message' => 'NO DATA');
       }
       return $result;
    }   

    //관련콘텐츠
    function relatedPostList($arr) {
        $menu_code = $arr['menu_code'];
        $tags = $arr['tags'];
        $sword="";

        if ($menu_code != '') {        
            $sword .= " AND ( menu_code like '%$menu_code%' OR tags like '%$tags%')";
        }

        $limit = 'ORDER BY idx DESC LIMIT 3' ;

        $sql = " SELECT idx,
                        menu_code,
                        menu_up_code,
                        title,
                        sub_title,
                        excerpt,
                        view_cnt,
                        path,
                        thumb_img,
                        contents
                        FROM tb_posts where open_yn='Y' " . $sword.$limit;

        $query = $this->db->query($sql);
        $list = $query->result();

        if($list){
            $result = array('data' => $list);
        }else{
            $result = array('message' => 'NO DATA');
        }

        return $result;       
    }
}