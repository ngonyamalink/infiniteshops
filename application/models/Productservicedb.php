<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Productservicedb extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_productservice($data)
    {
        $this->db->insert("productservice", $data);
        return $this->db->insert_id();
    }

    public function get_productservice_by_business_id($business_id)
    {
        $sql = "select productservice.productservice_id,productservice.url,productservice.productservice_name,productservice.price,
                productservice.productservice_description,productservice.productservice_code,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.business_id = $business_id )"; // and productservice.active=1
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }
    
    public function get_all_productservices($keyword = NULL)
    {
        
        
        if($keyword == NULL){
        $sql = "select productservice.productservice_id,productservice.url,productservice.productservice_name,productservice.price,
                productservice.productservice_description,productservice.productservice_code,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) limit 12"; // and productservice.active=1
        
        }else{
            
            $sql = "select productservice.productservice_id,productservice.url,productservice.productservice_name,productservice.price,
                productservice.productservice_description,productservice.productservice_code,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.productservice_name like '%".$keyword."%' OR productservice.productservice_description like '%".$keyword."%')  limit 12"; // and productservice.active=1
            
        }
        
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }
    
    
    
    public function get_productservice_by_business_id_member_id($business_id,$member_id)
    {
        $sql = "select productservice.productservice_id,productservice.url,productservice.productservice_name,productservice.price,
                productservice.productservice_description,productservice.productservice_code,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.business_id = $business_id and productservice.member_id=$member_id)"; // and productservice.active=1
      
        
        
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }
    

    public function get_productservice_by_subcategory_id($businesscategorylist_includes_id, $search_term = null, $ideal_business_id)
    {
        if ($search_term == null) {

            if ($ideal_business_id == 0) {

                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.price,productservice.productservice_code,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.businesscategorylist_includes_id = $businesscategorylist_includes_id and productservice.active=1)";
            } else {

                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.businesscategorylist_includes_id = $businesscategorylist_includes_id and productservice.active=1 and business.business_id=$ideal_business_id)";
            }
        } else {

            if ($ideal_business_id == 0) {

                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.businesscategorylist_includes_id = $businesscategorylist_includes_id and productservice.active=1 and productservice.productservice_name like '%$search_term%' )";
            } else {

                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.businesscategorylist_includes_id = $businesscategorylist_includes_id and productservice.active=1 and business.business_id=$ideal_business_id and productservice.productservice_name like '%$search_term%' )";
            }
        }

        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }

    public function get_productservice($search_term = null, $ideal_business_id)
    {
        if ($search_term == null) {

            if ($ideal_business_id == 0) {
                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email,productservice.url
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.active=1)";
            } else {
                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email,productservice.url
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.active=1 and business.business_id=$ideal_business_id)";
            }
        } else {

            if ($ideal_business_id == 0) {
                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email,productservice.url
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.active=1 and productservice.productservice_name like '%$search_term%' )";
            } else {
                $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.business_id,productservice.member_id,
                 business.business_name,business.location,business.contact_no,business.fax,business.email,productservice.url
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.active=1 and business.business_id =$ideal_business_id and productservice.productservice_name like '%$search_term%' )";
            }
        }

        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }

    public function get_productservice__product_id_business_id($business_id, $productservice_id)
    {
        $sql = "select  productservice.on_promotion,productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,productservice.businesscategorylist_includes_id,
                business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.productservice_id=$productservice_id and productservice.business_id = $business_id)"; // and productservice.active=1
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->row_array() : false;
    }
    
    
    
    public function get_productserviceByID($productservice_id)
    {
        $sql = "select  productservice.on_promotion,productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,productservice.businesscategorylist_includes_id,
                business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.productservice_id=$productservice_id)"; // and productservice.active=1
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->row_array() : false;
    }
    
    

    public function update_productservice($where, $data)
    {
        
         
        $this->db->where($where)->update("productservice", $data);
    }

    public function get_promotions()
    {
        $sql = "select productservice.productservice_id,productservice.productservice_name,
                productservice.productservice_description,productservice.productservice_code,productservice.price,productservice.url,productservice.business_id,productservice.member_id,productservice.businesscategorylist_includes_id,
                business.business_name,business.logo_url,business.location,business.contact_no,business.fax,business.email
                from productservice left join business on (business.business_id = productservice.business_id) left join member on (member.member_id = productservice.member_id) where (productservice.on_promotion=1 and productservice.active=1)";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }
}
