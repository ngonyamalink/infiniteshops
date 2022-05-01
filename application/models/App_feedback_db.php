<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class App_feedback_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_feedback($member_id, $page_url, $comments) {
        $data = array("member_id" => $member_id, "page_url" => $page_url, "comments" => $comments);
        $this->db->insert("app_feedback", $data);
    }

}

?>
