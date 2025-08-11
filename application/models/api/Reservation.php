<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends CI_Model
{
    function insert($arr) {
        $result = $this->db->insert('tb_reservation', $arr);
        return $result;
    }

}