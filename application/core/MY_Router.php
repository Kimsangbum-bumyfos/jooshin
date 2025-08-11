<?php
/**
 * Created by PhpStorm.
 * User: from
 * Date: 2019-01-04
 * Time: 오후 7:11
 */
defined('BASEPATH') OR exit('No direct script access allowed');
define('EXT' , '.php');
class MY_Router extends CI_Router {

    function _validate_request( $seg ){
        if( $seg[0] === $this->default_controller && $seg[1] === $this->method ){
            return $seg;
        }else{
            $i = 0;
            $dir = '';
            $root = APPPATH.'controllers/';

            while( is_dir( $root.$dir.'/'.$seg[$i] ) ){
                $dir .= '/'.$seg[$i++];
            }
            $this->directory .= $dir.'/';
            array_splice( $seg, 0, $i );
            $path = APPPATH.'controllers'.$dir.'/';
//            echo $path.ucfirst($seg[0]).EXT;
            if( file_exists( $path.ucfirst($seg[0]).EXT ) ){

                if( count($seg) === 1 ) array_push( $seg, $this->method );
                return $seg;
            }else if( file_exists( $path.$this->default_controller.EXT ) ){
                if( count($seg) === 0 ) array_push( $seg, $this->method );
                array_unshift( $seg, $this->default_controller );
                return $seg;
            }
        }
        show_404($seg[0]);
    }

}



