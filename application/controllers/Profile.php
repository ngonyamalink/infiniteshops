<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->model(array(
            "Businessdb",
            "Productservicedb",
            "About_db",
            'Memberdb'
        ));
        $this->load->library(array(
            "session",
            "email",
            "userlib"
        ));

        $this->userdata = $this->session->all_userdata();
    }

    public function profile_edit_form($processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Profile successfully updated.');
        }

        $udata = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("profile/profile_edit_form", $udata);
        $this->load->view("template/welcome_footer");
    }

    public function update_profie()
    {
        $fdata = $this->input->post();

        $where = array(
            "member_id" => $this->userdata['member_id'],
            "member_email" => $fdata['member_email']
        );
        $this->Memberdb->updateMember($where, $fdata);

        $this->session->set_userdata(array(
            "email" => $fdata['member_email'],
            "member_name" => $fdata['member_name'],
            "member_surname" => $fdata['member_surname']
        ));

        redirect(base_url("profile/profile_edit_form/1"));
    }
}