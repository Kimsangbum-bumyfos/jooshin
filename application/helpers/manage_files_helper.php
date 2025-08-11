<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function remove_files($path = '', $file) {
    if(is_array($file)) {
        foreach($file as $p) {
            $p = '.'.$path.'/'.$p;
//            log_message('LOG', $p);
            if(is_file($p)) {
                @chmod($p, 777);
                @unlink($p);
            }
        }
    }
}

function remove_file($path='', $file) {
    $path = '.' . $path . '/' . $file;
    if (is_file($path)) {
        @chmod($path, 777);
        @unlink($path);
    }
}