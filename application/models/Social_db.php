<?php

class Social_db extends CI_Model{
    
    public function __construct()
    {
        
        parent::__construct();
        $this->load->database();
    }
    
    
    public function add_social_media($data){
        $this->db->insert("social_media_links",$data); 
    }
    
    public function get_social_media_by_business_id($business_id)
    {
        
        $sql ="select social_media_links.social_media_links_id,social_media.social_media_name,social_media_links.social_media_links_link,social_media_links.social_media_id from social_media_links
        
        left join social_media on (social_media.social_media_id=social_media_links.social_media_id)
        
        where business_id=$business_id";
        
        $query = $this->db->query($sql);
        
        return !empty($query)?$query->result_array():false;
    }
    
    
    public function remove_social_media_link($business_id,$social_media_links_id)
    {
        $sql = "delete from social_media_links where (business_id=$business_id and social_media_links_id=$social_media_links_id)";
        $this->db->query($sql);
        
    }
    
}

?>