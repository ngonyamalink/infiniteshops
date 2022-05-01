<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Advert_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_ads($start) {
        $sql = "select advert_id,advert_name,advert_description from advert where active=1 limit $start , 5";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->result_array() : false;
    }

    public function get_each_ad($ad_id) {
        $sql = "select advert_id,advert_name,advert_description from advert where (advert_id=$ad_id and active=1)";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

}

?>