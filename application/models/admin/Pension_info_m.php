<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pension_info_m extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    function save($arr) {
        $insert_value = '';
        foreach ($arr as $key => $value) {
            $insert_value .= "('$key', '$value'),";
        }
        $insert_value = substr($insert_value, 0, -1);

        $sql = "INSERT INTO tb_pension_basic_info ( p_key,p_value )
                    VALUES
                        $insert_value
                    ON DUPLICATE KEY UPDATE 
                    p_value = VALUES (p_value)";


        return $this->db->query($sql);
    }
    function getData() {
        $sql = "SELECT * FROM tb_pension_basic_info";
        $q = $this->db->query($sql);
        return $q->result();

    }

}