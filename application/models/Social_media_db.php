<?php

class Social_media_db extends CI_Model{
    
    public function __construct()
    {
        
        parent::__construct();
        $this->load->database();
    }
    
  
    public function get_all_social_media()
    {
        
        $sql ="select * from social_media";
        
        
       
        $query = $this->db->query($sql);
        
        return !empty($query)?$query->result_array():false;
    }
    

    
}

?>