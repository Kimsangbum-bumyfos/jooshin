<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_m extends CI_Model
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

        $sql = "INSERT INTO tb_setting ( k,v )
                    VALUES
                        $insert_value
                    ON DUPLICATE KEY UPDATE 
                    v = VALUES (v)";


        return $this->db->query($sql);
    }
    function getData() {
        $sql = "SELECT * FROM tb_setting";
        $q = $this->db->query($sql);
        return $q->result();

    }

}