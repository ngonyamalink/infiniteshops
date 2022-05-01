<?php

class Marketing_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function AddMember($username, $name, $surname) {
        $data = array("username" => $username, 'name' => $name, 'surname' => $surname);
        $this->db->insert('marketing', $data);
    }

    public function get_all_members() {
        $sql = "select * from member";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->result_array() : FALSE;
    }
}