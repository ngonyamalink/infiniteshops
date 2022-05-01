<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class Searchmodel_db Extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function search($keyword)
    {
       /* $this->db->like('name',$keyword);
        $query  =   $this->db->get('tablename');
        return $query->result();*/
    }
} 