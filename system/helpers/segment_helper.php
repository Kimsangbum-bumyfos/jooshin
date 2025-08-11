<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
     * url 중 키 값을 구분하여 값을 가져오도록
     *
     * @param Array $url : segment_explode 한 url 값
     * @param String $key :  가져오려는 값의 key
     * @return String $url[$k] : 리턴 값
     */
 
    function url_explode($url, $key) {
        $cnt = count($url);
    
        for ($i = 0; $cnt > $i; $i++) {
            if ($url[$i] == $key) {
                $k = $i + 1;
                return $url[$k];

            }
        }
    }
 

    /**
     * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꿔 리턴한다.
     *
     * @param String 대상이 되는 문자열
     * @return string[]
     */
    function segment_explode($seg) {
        // 세그먼트 앞 뒤 "/" 제거 후 uri를 배열로 반환
 
        $len = strlen($seg);
 
        if (substr($seg, 0, 1) == '/') {
            $seg = substr($seg, 1, $len);
        }
 
        $len = strlen($seg);
 
        if (substr($seg, -1) == '/') {
            $seg = substr($seg, 0, $len - 1);
        }
 
        $seg_exp = explode("/", $seg);
        return $seg_exp;
    }