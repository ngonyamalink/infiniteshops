<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class About_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_business_about($business_id) {

        
        $sql = "select about.who_are_we,about.what_we_do,about.our_mission,about.we_love_our_clients,business.business_name,business.logo_url from about  left join business on (about.business_id=business.business_id) where about.business_id=$business_id";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function add_about($data) {
        $this->db->insert("about", $data);
    }

    public function update_about($business_id,$data) {
        $where = array("business_id" => $business_id);
        $this->db->where($where)->update("about", $data);
    }
    
  
}
