<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Businesscategorylist_includes_db extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function get_subcategories($category_id) {

        $sql = "select * from businesscategorylist_includes where category_id=$category_id";
        $query = $this->db->query($sql);

        return !empty($query) ? $query->result_array() : false;
    }

    public function get_subcategory_by_id($id) {
        $sql = "select * from businesscategorylist_includes where id=$id";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }
    
    public function get_all_subcategories() {
        $sql = "select * from businesscategorylist_includes";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->result_array() : false;
    }

}
