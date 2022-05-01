<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Visual_trait_pageview_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_hit($member_id, $page, $userip) {
        $data = array("member_id" => $member_id, "page" => $page, "userip" => $userip, "date_added" => date("Y-m-d H:i:s"));
        $this->db->insert("visual_trait_pageview", $data);
    }

}
