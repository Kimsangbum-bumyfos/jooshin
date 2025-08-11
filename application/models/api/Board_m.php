<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function faqList_get($arr) {
        $category = $arr['category'];
        $search_word = $arr['search_word'];
        $sword="";

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword .= " AND (title like '%$search_word%' OR contents like '%$search_word%' OR tags like '%$search_word%')";
        }
        if ($category != '') {
            // 검색어 있을 경우
            $sword .=" AND category ='".$category."' ";
        }
        $start = ($arr['offset'] - 1) * $arr['limit'];
        $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];

        $sql = " SELECT idx,
                        category,
                        title,
                        contents
                        FROM tb_board where open_yn='Y' AND board_type='FAQ'". $sword.$limit;

        $query = $this->db->query($sql);
        $list = $query->result();

        //board type에 해당 && 검색어 && 카테고리
        $sql_cnt = " SELECT * FROM tb_board WHERE board_type = 'FAQ' and open_yn ='Y' ".$sword ;
        $query = $this->db->query($sql_cnt);  
        $total_count = $query->num_rows();

        if($list){
          $result = array('total_count' => $total_count ,'data'=>$list);
        }else{
          $result = array('message' => 'NO DATA');
        }

        return $result;
        

    }
    function boardList_get($arr) {

        $board_type = $arr['board_type']; 
        $offset = $arr['offset'];
        $limit = $arr['limit'];
        $category = $arr['category'];
        $search_word = $arr['search_word'];
        $sword="";

        //board type에 해당하는 전체 카운터 리턴
        $sql_cnt = " SELECT * FROM tb_board WHERE board_type = '".$board_type."' and open_yn ='Y' " ;
        $query = $this->db->query($sql_cnt);  
        $total_count = $query->num_rows();  

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword .= ' AND ( title like "%'.$search_word.'%"'. ' OR tags like "% '.$search_word.'%"' .") AND board_type = '" .$board_type."' ";
        }else{
            $sword .=" AND board_type ='".$board_type."' ";
        }

        if ($category != '') {
            // 검색어 있을 경우
            $sword .=" AND category ='".$category."' ";
        }

        //현재 페이지를 받아서 Limit START를 설정한다.
        if ($offset > 1) {
            $start = ($offset - 1) * $limit;
        } else {
            $start = ($offset - 1) * $limit;
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $start . ', ' . $limit;
        }

        $sql = " SELECT * FROM tb_board where open_yn='Y' ". $sword . $limit_query;
        $query = $this->db->query($sql);
        $list_count = $query->num_rows();  

        
        $query = $this->db->query($sql);
        $list = $query->result();
        

        if($list){
          $result = array('total_count' => $total_count ,'page'=> $offset, 'list_count'=>$list_count, 'data'=>$list);
        }else{
          $result = array('list_count' => $list_count ,'message' => 'NO DATA');
        }
      
        return $result;

    }  

    //board 중 갤러리 상세보기
    function galleryView($idx) {
        
       //게시물 카운터를 증가시킨다.
       $sql_cnt = "update tb_board set view_cnt=view_cnt+1 WHERE idx=$idx";
       $this->db->query($sql_cnt);

       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_board WHERE idx=$idx AND open_yn='Y' ";
       $query = $this->db->query($sql);
       $data = $query->result();

       if($data){
           $result = array('data' => $data                           
                           );
       }else{
           $result = array('message' => 'NO DATA');
       }

       return $result;
    }

    function noticeView($idx) {
        
       //게시물 카운터를 증가시킨다.
       $sql_cnt = "update tb_board set view_cnt=view_cnt+1 WHERE idx=$idx";
       $this->db->query($sql_cnt);

       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_board WHERE idx=$idx AND open_yn='Y' AND board_type='NOTICE'";
       $query = $this->db->query($sql);
       $data = $query->result();

       $sql = "SELECT idx, title FROM tb_board WHERE idx > $idx AND board_type='NOTICE' AND open_yn='Y' LIMIT 1";
       $query = $this->db->query($sql);
       $next_data = $query->result();
       $next_data = $next_data ? $next_data : 'NO DATA';

        $sql = "SELECT idx, title FROM tb_board WHERE idx < $idx AND board_type='NOTICE' AND open_yn='Y' ORDER BY idx DESC LIMIT 1";
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

    function board_insert($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
          
        $insert_array = array(
            'board_type' => $arrays['board_type'],
            'title' => $arrays['title'],
            'contents' => $arrays['contents'],
            'passwd' => $arrays['passwd'],
            'user_name' => $arrays['user_name'],
            'user_phone' => $arrays['user_phone'],
            'user_email' => $arrays['user_email'],
            'status' => 'Y',
            'reg_date' => date("Y-m-d H:i:s")
        );
            
        $result = $this->db->insert($arrays['table'], $insert_array);
        
        return $result;
    }

     function board_modify($arrays) {
        //time존 설정
        date_default_timezone_set('Asia/Seoul');
          
        $modify_array = array(
            'title' => $arrays['title'],
            'contents' => $arrays['contents'],
            'passwd' => $arrays['passwd'],
            'user_name' => $arrays['user_name'],
            'user_phone' => $arrays['user_phone'],
            'user_email' => $arrays['user_email'],
            'status' => 'Y',
            'modify_date' => date("Y-m-d H:i:s")
        );
            
        $where = array(
            'idx' => $arrays['idx']
        );
        
        $result = $this->db->update($arrays['table'], $modify_array, $where);
        
        return $result;
     }


     function boardDelete($arrays) {
       
       $delete_array = array(
            'idx' => $arrays['idx'],
            'passwd' => $arrays['passwd']
        );

       //사용자가 입력하 패스워드가 맞는지 체크한다.
       $sql = "SELECT * FROM tb_board where idx = '" .$arrays['idx'] . "' and passwd = '" . $arrays['passwd'] . "' ";    
       $query = $this->db->query($sql);
       $count = $query->num_rows();

       //패스워드 일치 하는 경우 삭제한다.
       if($count>0){
         $result = $this->db->delete('tb_board', $delete_array);          
       }else{
         $result = FALSE;   
       }
        return $result;
     }

     function boardPasswdChk($arrays) {
       
       $passwd_chk_array = array(
            'idx' => $arrays['idx'],
            'passwd' => $arrays['passwd']
        );

       //사용자가 입력하 패스워드가 맞는지 체크한다.
       $sql = "SELECT * FROM tb_board where idx = '" .$arrays['idx'] . "' and passwd = '" . $arrays['passwd'] . "' ";    
       $query = $this->db->query($sql);
       $count = $query->num_rows();

       if($count>0){
         $result = TRUE;          
       }else{
         $result = FALSE;   
       }
        return $result;
     }

     function noticeList($arr) {

         $where = '';
         $search_word = $arr['search_word'];
         if($search_word) {
             $where = " AND (title like '%$search_word%' OR contents like '%$search_word%' OR tags like '%$search_word%')";
         }

         $start = ($arr['offset'] - 1) * $arr['limit'];
         $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];

         $sql = "SELECT COUNT(*) AS cnt FROM tb_board WHERE open_yn='Y' AND board_type='NOTICE'".$where;
         $query = $this->db->query($sql);
         $total_count = $query->result();

         $sql = "SELECT idx, title, sub_title, view_cnt, thumb_img, path, reg_date FROM tb_board WHERE open_yn='Y' AND board_type='NOTICE'".$where.$limit;
         $query = $this->db->query($sql);
         $list = $query->result();


         if($list){
             $result = array('total_count' => $total_count[0]->cnt, 'data'=>$list);
         }else {
             $result = array('message' => 'NO DATA');
         }

         return $result;

    }

    // 이벤트 리스트
    function eventList($arr) {

         $where = '';
         $search_word = $arr['search_word'];
         if($search_word) {
             $where = " AND (title like '%$search_word%' OR contents like '%$search_word%' OR tags like '%$search_word%')";
         }

         $start = ($arr['offset'] - 1) * $arr['limit'];
         $limit = 'ORDER BY idx DESC LIMIT '.$start.','.$arr['limit'];

         $sql = "SELECT COUNT(*) AS cnt FROM tb_board WHERE open_yn='Y' AND board_type='EVENT'".$where;
         $query = $this->db->query($sql);
         $total_count = $query->result();

         $sql = "SELECT idx, title, sub_title, view_cnt, s_date, e_date, thumb_img, path, reg_date FROM tb_board WHERE open_yn='Y' AND board_type='EVENT'".$where.$limit;
         $query = $this->db->query($sql);
         $list = $query->result();


         if($list){
             $result = array('total_count' => $total_count[0]->cnt, 'data'=>$list);
         }else {
             $result = array('message' => 'NO DATA');
         }

         return $result;

    }

    // 이벤트 디테일
    function eventView($idx) {
        
       //게시물 카운터를 증가시킨다.
       $sql_cnt = "update tb_board set view_cnt=view_cnt+1 WHERE idx=$idx";
       $this->db->query($sql_cnt);

       //idx에 해당하는 게시물을 가져온다.
       $sql = "SELECT * FROM tb_board WHERE idx=$idx AND open_yn='Y' AND board_type='EVENT'";
       $query = $this->db->query($sql);
       $data = $query->result();

       $sql = "SELECT idx, title FROM tb_board WHERE idx > $idx AND board_type='EVENT' AND open_yn='Y' LIMIT 1";
       $query = $this->db->query($sql);
       $next_data = $query->result();
       $next_data = $next_data ? $next_data : 'NO DATA';

        $sql = "SELECT idx, title FROM tb_board WHERE idx < $idx AND board_type='EVENT' AND open_yn='Y' ORDER BY idx DESC LIMIT 1";
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
}