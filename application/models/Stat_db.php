<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stat_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_stat()
    {
        $sql = "select
(select count(business_id) from business) as numbusinesses,
(select count(productservice_id) from productservice) as numproductservices,
(select count(member_id) from member) as nummembers";

        $query = $this->db->query($sql);

        return ! empty($query) ? $query->row_array() : FALSE;
    }
}