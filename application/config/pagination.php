<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
$config['per_page']             = 10;
$config['num_links']        =4;
$config['num_links_prev']   = 10;
$config['num_links_next']    = 4;
$config['uri_segment']          = 6;
$config['page_query_string']    = TRUE;
$config['use_page_numbers']     = TRUE;
$config['query_string_segment'] = 'page';
$config['first_link'] = FALSE;
$config['last_link'] = FALSE;
 
$config['full_tag_open']        = '<div class="pagination">';
$config['full_tag_close']       = '</div>';