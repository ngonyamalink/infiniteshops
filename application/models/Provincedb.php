<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Provincedb extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getProvinces($countryID) {
        $data = array("province_id", "country_id", "province_name");
        $where = array("country_id" => $countryID);
        $query = $this->db->select($data)->where($where)->get("province");
        return !empty($query) ? $query->result_array() : false;
    }

    public function getProvince($id) {
        $data = array("province_id", "country_id", "province_name");
        $where = array("province_id" => $id);
        $query = $this->db->select($data)->where($where)->get("province");
        return !empty($query) ? $query->row_array() : false;
    }

}
