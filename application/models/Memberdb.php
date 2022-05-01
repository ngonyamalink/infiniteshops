<?php

class Memberdb extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function AddMember($name, $surname, $dob, $gender, $country_id, $provinceID, $email, $password, $activation_code) {
        $data = array("active" => 0, 'member_name' => $name, 'member_surname' => $surname, 'member_dob' => $dob, 'member_gender' => $gender, 'country_id' => $country_id, 'member_province_id' => $provinceID, 'member_email' => $email, 'member_password' => $password, 'member_date_added' => date('Y-m-d H:i:s'), 'activation_code' => $activation_code);
        $this->db->insert('member', $data);
    }

    public function getMemberByAuthKey($AuthKey) {
        $sql = "select member.authstring,member.member_id, member.member_name, member.member_surname, member.member_dob, member.member_gender, member.country_id, member.member_province_id, member.member_location, member.member_contact_no, member.member_email, member.member_password, member.member_date_added, member.member_date_updated, member.profile_pic_url, country.country_name, province.province_id, province.province_name, province.country_id from member left join country on (country.country_id=member.country_id) left join province on (province.province_id=member.member_province_id)  where (member.authstring = '$AuthKey' and  member.active = 1)";
       
        $query = $this->db->query($sql);
      
        return !empty($query) ? $query->row_array() : false;
    }

    public function getMember($email, $password) {
        $where = array('member.member_email' => $email, 'member.member_password' => $password); //, "member.active" => 1
        $data = array('member.member_id', 'member.member_name', 'member.member_surname', 'member.member_dob', 'member.member_gender', 'member.country_id', 'member.member_province_id', 'member.member_location', 'member.member_contact_no', 'member.member_email', 'member.member_password', 'member.member_date_added', 'member.member_date_updated', 'member.profile_pic_url', 'country.country_name', 'province.province_id', 'province.province_name', 'province.country_id');
        $query = $this->db->select($data)->from('member')->join('country', 'country.country_id=member.country_id')->join('province', 'province.province_id=member.member_province_id')->where($where)->get();
        return !empty($query) ? $query->row_array() : false;
    }

    public function updateMember($where,$data) {
         $this->db->where($where)->update('member', $data);
    }

    public function emailExists($email) {
        $query = $this->db->select('member_email')->where('member_email', $email)->get('member');
        return !empty($query) ? $query->row_array() : false;
    }

    public function count_members() {
        $sql = "select count(member_id) as total from member";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function hash_and_username_exist($hash, $username) {
        $sql = "select member_id from member where (activation_code='$hash' and member_email='$username')";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function activate_user($username) {
        $sql = "update member  set active=1 where member_email='$username'";
        $query = $this->db->query($sql);
    }

    public function getUserInfoByEmail($email) {
        $q = $this->db->get_where('member', array('member_email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $email . ')');
            return false;
        }
    }

    public function getUserInfo($id) {
        $q = $this->db->get_where('member', array('member_id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function insertToken($member_id) {
        $token = do_hash(date("Y-m-d H:i:s"), "md5");



        $data = array("activation_code" => $token);
        $where = array('member_id' => $member_id);
        $this->db->where($where)->update('member', $data);

        return $token;
    }

    public function isTokenValid($token) {
        $q = $this->db->get_where('member', array('activation_code' => $token), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function updatePassword($member_id, $new_pass) {
        $data = array("member_password" => $new_pass);
        $where = array('member_id' => $member_id);
        $this->db->where($where)->update('member', $data);
    }

    public function get_all_members() {
        $sql = "select * from member";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->result_array() : FALSE;
    }

}
