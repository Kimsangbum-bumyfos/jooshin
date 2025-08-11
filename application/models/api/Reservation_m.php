<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_m extends CI_Model
{
    function insert($arr) {
        $result = $this->db->insert('tb_reservation', $arr);
        return $result;
    }

    function getData($name, $phone, $idx='') {
        if($idx) {
            $sql = "SELECT reserve_name, reserve_date, rental_s_date, rental_e_date, car_name
                FROM tb_reservation WHERE user_idx=$idx ORDER BY idx DESC";
        } else {
            $sql = "SELECT reserve_name, reserve_date, rental_s_date, rental_e_date, car_name
                FROM tb_reservation WHERE reserve_name='$name' AND reserve_phone='$phone' ORDER BY idx DESC";
        }
        $query = $this->db->query($sql);
        $data = $query->result();

        if($data) {
            $result = array('data' => $data);
        } else {
            $result = array('message' => 'NO DATA');
        }

        return $result;
    }
}