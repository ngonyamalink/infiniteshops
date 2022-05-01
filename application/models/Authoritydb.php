<?php
class Authoritydb extends CI_Model{

	public function __construct()
	{
		parent::__construct();

		$this->load->database();

	}


	public function getAuthorities($country_id)
	{
		$data = array('authority_id','authority_name');

		$where = array('country_id'=>$country_id);

		$query = $this->db->select($data)->where($where)->get('authority');

		return !empty($query)?$query->result_array():false;

	}

	public function monthlyCriticismReport($country_id=0,$year=0,$month=0)
	{
		$sql = "SELECT DISTINCT (
		criticism.authority_id), authority.authority_name, COUNT( criticism.authority_id ) AS num_criticisms
		FROM authority
		LEFT JOIN criticism ON ( criticism.authority_id = authority.authority_id and criticism.deleted=0)
		WHERE (
		authority.country_id =  '$country_id'
		AND criticism.year_added =$year
		AND criticism.month_added =$month
		)
		GROUP BY authority.authority_id order by COUNT( criticism.authority_id ) desc";

		$query = $this->db->query($sql);

		return !empty($query)?$query->result_array():false;
	}
}