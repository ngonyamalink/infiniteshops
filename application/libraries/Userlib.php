<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Userlib {

    public $name;
    public $id;
    public $surname;
    public $dob;
    public $gender;
    public $country_id;
    public $country_name;
    public $province_id;
    public $province_name;
    public $location;
    public $contact_no;
    public $email;
    public $password;
    public $profile_pic_url;
    public $authstring;

    public function __construct() {
        
    }

    /*public function getUserByAuthKey($AuthKey) {
        $CI_Instance = &get_instance();
        $CI_Instance->load->model(array("memberdb"));
        $member = $CI_Instance->memberdb->getMemberByAuthKey($AuthKey); //getMember($email, $password);
        if ($member) {
            $this->id = $member['member_id'];
            $this->name = $member['member_name'];
            $this->surname = $member['member_surname'];
            $this->dob = $member['member_dob'];
            $this->gender = $member['member_gender'];
            $this->country_id = $member['country_id'];
            $this->country_name = $member['country_name'];
            $this->province_id = $member['member_province_id'];
            $this->province_name = $member['province_name'];
            $this->location = $member['member_location'];
            $this->contact_no = $member['member_contact_no'];
            $this->email = $member['member_email'];
            $this->password = $member['member_password'];
            $this->profile_pic_url = $member['profile_pic_url'];
            $this->authstring = $member['authstring'];
            return true;
        } else {
            return false;
        }
    }*/

    public function getUser($email, $password) {
        $CI_Instance = &get_instance();
        $CI_Instance->load->model(array("memberdb"));
        $member = $CI_Instance->memberdb->getMember($email, $password);
        if ($member) {
            $this->id = $member['member_id'];
            $this->name = $member['member_name'];
            $this->surname = $member['member_surname'];
            $this->dob = $member['member_dob'];
            $this->gender = $member['member_gender'];
            $this->country_id = $member['country_id'];
            $this->country_name = $member['country_name'];
            $this->province_id = $member['member_province_id'];
            $this->province_name = $member['province_name'];
            $this->location = $member['member_location'];
            $this->contact_no = $member['member_contact_no'];
            $this->email = $member['member_email'];
            $this->password = $member['member_password'];
            $this->profile_pic_url = $member['profile_pic_url'];
            return true;
        } else {
            return false;
        }
    }
}

?>
