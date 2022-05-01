<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Businessdb extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_business($data) {
        $data['date_added']= date("Y-m-d H:i:s");
        $this->db->insert("business", $data);
    }

    public function get_business($business_id) {
        $sql = "select business.business_id,business.logo_url,package.package_name,  package.package_monthly_fee , business.about_us,business.business_name,business.country_id,
            business.province_id,business.location,business.contact_no,business.fax,business.email,business.website_url,business.member_id,business.date_added,member.member_name,member.member_surname,country.country_name,province.province_name
            from business left join member on (member.member_id=business.member_id)  left join country on (country.country_id = business.country_id)  left join province on (province.province_id=business.province_id) left join package on (package.package_id=business.package_id) where business.business_id=$business_id";
        $query = $this->db->query($sql);

        return !empty($query) ? $query->row_array() : false;
    }
    
    
    public function owner_get_business($business_id, $member_id) {
        $sql = "select business.business_id,business.logo_url,package.package_name,  package.package_monthly_fee , business.about_us,business.business_name,business.country_id,
            business.province_id,business.location,business.contact_no,business.fax,business.email,business.website_url,business.member_id,business.date_added,member.member_name,member.member_surname,country.country_name,province.province_name
            from business left join member on (member.member_id=business.member_id)  left join country on (country.country_id = business.country_id)  left join province on (province.province_id=business.province_id) left join package on (package.package_id=business.package_id) where (business.business_id=$business_id and business.member_id=$member_id)";
        $query = $this->db->query($sql);
        
        return !empty($query) ? $query->row_array() : false;
    }

    public function get_businesses_by_member_id($member_id) {
        $sql = "select business.business_id,business.days_remaining,business.logo_url,package.package_name,package.package_monthly_fee,business.business_name,business.country_id,
            business.province_id,business.location,business.contact_no,business.fax,business.email,business.website_url,business.member_id,business.date_added,member.member_name,member.member_surname,country.country_name,province.province_name
            from business left join member on (member.member_id=business.member_id)  left join   country on (country.country_id = business.country_id)  left join province on (province.province_id=business.province_id) left join package on (package.package_id=business.package_id) where (business.member_id=$member_id )"; //and business.active=1

        $query = $this->db->query($sql);

        return !empty($query) ? $query->result_array() : false;
    }
    
    
    public function get_all_businesses(){
        $sql = "select business.business_id,business.days_remaining,business.logo_url,package.package_name,package.package_monthly_fee,business.business_name,business.country_id,
            business.province_id,business.location,business.contact_no,business.fax,business.email,business.website_url,business.member_id,business.date_added,member.member_name,member.member_surname,country.country_name,province.province_name
            from business left join member on (member.member_id=business.member_id)  left join   country on (country.country_id = business.country_id)  left join province on (province.province_id=business.province_id) left join package on (package.package_id=business.package_id)"; //and business.active=1
        
        $query = $this->db->query($sql);
        
        return !empty($query) ? $query->result_array() : false;
    }

    public function update_business($where, $data) {
        $this->db->where($where)->update("business", $data);
    }

    public function get_other_businesses($member_id) {
        $sql = "select business.business_id,business.business_name,business.country_id,
            business.province_id,business.location,business.contact_no,business.fax,business.email,business.member_id,business.date_added,member.member_name,member.member_surname,country.country_name,province.province_name
            from business left join member on (member.member_id=business.member_id)  left join   country on (country.country_id = business.country_id)  left join province on (province.province_id=business.province_id) where (business.member_id <> $member_id and business.active=1)";

        $query = $this->db->query($sql);

        return !empty($query) ? $query->result_array() : false;
    }

    public function get_business_about($business_id, $member_id = 0) {
        if ($member_id > 0) {
            $sql = "select * from business where (business_id=$business_id and member_id=$member_id)";
        } else {
            $sql = "select * from business where (business_id=$business_id)";
        }

        $query = $this->db->query($sql);

        return !empty($query) ? $query->row_array() : false;
    }

    public function is_my_business($business_id, $member_id) {
        $sql = "select * from business where (business_id=$business_id and member_id=$member_id)";

        $query = $this->db->query($sql);

        return !empty($query) ? $query->row_array() : false;
    }
	public function get_businesses(){
		$sql = "select * from business where (days_remaining>0)";
		$query = $this->db->query($sql);
		return !empty($query)?$query->result_array():false;
	}
	
	public function add_business_days_remaining($business_id,$days)
	{
		$sql = "update business set days_remaining =(days_remaining+$days) where business_id=$business_id";
		$this->db->query($sql);
		
		$sql = "select email from business where business_id=$business_id";
		$query = $this->db->query($sql);
		
		if (!empty($query))
		{
			$row = $query->row_array();
			return $row['email'];
		}else
		{
			die("error has occured");
		}
		
	}
	
		public function remove_business_days_remaining()
	{
		$sql = "update business set days_remaining = (days_remaining-1) where (days_remaining>0)";
		$this->db->query($sql);
    }
}

?>