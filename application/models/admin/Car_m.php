<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Car_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    /**
     * 템플릿 관리 리스트
     *
     * @param array $auth 폼 전송받은 이름 , 아이디
     * @return array
     */
    function lists($table , $type = '', $offset = '', $limit = '', $search_word = '') {

        $limit_query = '';
        $sword = '';

        if ($search_word != '') {
            // 검색어 있을 경우
            $sword = ' WHERE car_name like "%' . $search_word . '%"';
        }

        if ($limit !== '' OR $offset !== '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' ORDER BY IDX DESC LIMIT ' . $offset . ', ' . $limit;
        }
        $sql = "SELECT * FROM " . $table . $sword .$limit_query;
 
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
     */
    function insert($arrays) {

        //time존 설정
        date_default_timezone_set('Asia/Seoul');

        $insert_array = array(
            'car_name' => $arrays['car_name'],
            'car_type' => $arrays['car_type'],
            'rental_fee_consultation_inquiry' => $arrays['rental_fee_consultation_inquiry'],
            'rental_fee' => $arrays['rental_fee'],
            'rental_fee_12' => $arrays['rental_fee_12'],
            'rental_peak_fee_12' => $arrays['rental_peak_fee_12'],
            'rental_high_peak_fee_12' => $arrays['rental_high_peak_fee_12'],
            'rental_fee_36' => $arrays['rental_fee_36'],
            'rental_peak_fee_36' => $arrays['rental_peak_fee_36'],           
            'rental_high_peak_fee_36' => $arrays['rental_high_peak_fee_36'],           
            'rental_fee_7' => $arrays['rental_fee_7'],           
            'rental_peak_fee_7' => $arrays['rental_peak_fee_7'],           
            'rental_high_peak_fee_7' => $arrays['rental_high_peak_fee_7'],           
            'rental_weekend_fee' => $arrays['rental_weekend_fee'],           
            'add_hours_fee' => $arrays['add_hours_fee'],           
            'operate_svc_fee' => $arrays['operate_svc'],
            'release_svc_fee' => $arrays['release_svc'],
            'insur_fee' => $arrays['insur_fee'],           
            'insur_fee_10' => $arrays['insur_fee_10'],           
            'insur_fee_30' => $arrays['insur_fee_30'],           
            'insur_fee_open_yn' => $arrays['insur_fee_open_yn'],           
            'rental_opt' => $arrays['rental_opt'],           
            'thumb_img' => $arrays['thumb_img'],           
            'open_yn' => $arrays['open_yn'],
            'popular_car' => $arrays['popular_car'],
            'detail_info' => $arrays['detail_info'],
            'path' => $arrays['path'],
            'cke_key' => $arrays['cke_key'],
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
        
        $modify_array = array(
            'car_name' => $arrays['car_name'],
            'car_type' => $arrays['car_type'],
            'rental_fee_consultation_inquiry' => $arrays['rental_fee_consultation_inquiry'],
            'rental_fee' => $arrays['rental_fee'],
            'rental_fee_12' => $arrays['rental_fee_12'],
            'rental_peak_fee_12' => $arrays['rental_peak_fee_12'],
            'rental_high_peak_fee_12' => $arrays['rental_high_peak_fee_12'],
            'rental_fee_36' => $arrays['rental_fee_36'],
            'rental_peak_fee_36' => $arrays['rental_peak_fee_36'],           
            'rental_high_peak_fee_36' => $arrays['rental_high_peak_fee_36'],           
            'rental_fee_7' => $arrays['rental_fee_7'],           
            'rental_peak_fee_7' => $arrays['rental_peak_fee_7'],           
            'rental_high_peak_fee_7' => $arrays['rental_high_peak_fee_7'],           
            'rental_weekend_fee' => $arrays['rental_weekend_fee'],           
            'add_hours_fee' => $arrays['add_hours_fee'],           
            'operate_svc_fee' => $arrays['operate_svc'],
            'release_svc_fee' => $arrays['release_svc'],
            'insur_fee' => $arrays['insur_fee'],           
            'insur_fee_10' => $arrays['insur_fee_10'],           
            'insur_fee_30' => $arrays['insur_fee_30'],           
            'insur_fee_open_yn' => $arrays['insur_fee_open_yn'],
            'detail_info' => $arrays['detail_info'],
            'rental_opt' => $arrays['rental_opt'],           
            'thumb_img' => $arrays['thumb_img'],           
            'open_yn' => $arrays['open_yn'],
            'popular_car' => $arrays['popular_car'],
            'path' => $arrays['path'],
            'modi_date' => date("Y-m-d H:i:s")
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
       // $sql0 = "UPDATE " . $table . " SET view_cnt = view_cnt + 1 WHERE idx='" . $id . "'";
       // $this -> db -> query($sql0);
 
        $sql = "SELECT * FROM " . $table . " WHERE idx = '" . $id . "'";
        $query = $this -> db -> query($sql);
 
        // 게시물 내용 반환
        $result = $query -> row();
 
        return $result;
     }
 
}