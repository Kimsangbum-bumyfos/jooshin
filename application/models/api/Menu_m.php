<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
Class Menu_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function lists() {
        
        $sql = " SELECT * FROM tb_menu where open_yn = 'Y' order by idx desc ";
      
        $query = $this -> db -> query($sql);
 
        $result = $query -> result();
        return $result;
    }    
}