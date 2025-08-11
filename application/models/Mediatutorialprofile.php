<?php 
/***************************************************************************
* Mediatutorial.web.id
***************************************************************************/
class Mediatutorialprofile extends CI_Model {
    function __construct()
    {
        parent::__construct();	
        $this->load->helper(array('html','url'));
    }
    
    /*
     fungsi untuk men-generate profile thumb
    */
    function genProfileThumb(){
         
        $tmpl = 'admin/_thumbnail_with_status';
        $recent_status = '';
        $recent_profilepic = 'http://127.0.0.1/dev2/'.'templates/images/male_thumb.jpg';
        //
        $data = array(
            'recent_status' => $recent_status,
            'recent_profilepic' => img($recent_profilepic)
        );
        return $this->load->view($tmpl, $data, true);
        
    }
}