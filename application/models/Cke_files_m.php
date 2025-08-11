<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cke_files_m extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    function checkKey($key) {
        $sql = "SELECT * FROM tb_cke_files WHERE k = '$key'";

        $query = $this->db->query($sql);
        $result = $query->num_rows();

        if(!$result) return true;
        else return false;
    }
    function setPath($key, $path) {
        if($this->checkKey($key)) {
            $sql = "INSERT INTO tb_cke_files ( k,path )
                    VALUES
                        ('$key', '$path')";

            return $this->db->query($sql);
        } else {
            $path = ','.$path;
            $sql = "UPDATE tb_cke_files SET path = CONCAT(path,'$path') WHERE k='$key'";
            return $this->db->query($sql);
        }
    }
    function getPath($key) {
        $sql = "SELECT path FROM tb_cke_files WHERE k = '$key'";

        $query = $this->db->query($sql);
        $result = $query->row();
        if(@$result->path) {
            return $result->path;
        }
        return FALSE;

    }
    function delete($key) {
        return $this->db->delete('tb_cke_files', array('k' => $key));
    }

}