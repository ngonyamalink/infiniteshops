<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Countrydb extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    public function getCountries() {

        $data = array("country_id", "country_name");

        $query = $this->db->select($data)->where(array("active"=>1))->get("country");

        return !empty($query) ? $query->result_array() : false;
    }
    
    
      public function allcountries() {

        $data = array("country_id", "country_name");

        $query = $this->db->select($data)->get("country");

        return !empty($query) ? $query->result_array() : false;
    }

    public function getCountry($id) {

        $data = array("country_id", "country_name");

        $where = array("country_id" => $id,"active"=>1);

        $query = $this->db->select($data)->where($where)->get("country");


        return !empty($query) ? $query->row_array() : false;
    }

}

?>
