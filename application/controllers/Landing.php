<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'userlib',
            'email'
        ));
        $this->load->helper(array(
            'form',
            'url',
            'security'
        ));
        $this->load->model(array(
            'memberdb',
            'businessdb',
            'marketing_db',
            'productservicedb',"Stat_db"
        ));

        $this->userdata = $this->session->all_userdata();
    }

    public function index()
    {
        $data['businesses'] = $this->businessdb->get_all_businesses();
        $data['product_service_list'] = $this->productservicedb->get_all_productservices();

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("landing/index", $data);
        $this->load->view("template/welcome_footer");
    }

    public function submit_tell_a_friend()
    {
        $data = $this->input->post();

        $this->email->from('infiniteshops-noreply@ngonyamalink.co.za', 'infiniteshops-noreply');
        $this->email->to($data['email']);
        $this->email->bcc('ngonyamalink@gmail.com');

        $this->email->subject('InfiniteShops-Friend-Referral');
        $this->email->message('Hi ' . $data['email'] . ', Your friends are referring you to start using InfiniteShops. The link is ' . base_url() . '  This is still a pilot version, Warmest regards, Ngonyama Link Marketing.');

        $this->email->send();

        sleep(5);

        redirect(base_url("landing/tell_a_friend_thankyou"));
    }

    public function tell_a_friend_form()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('tell_a_friend_form');
        $this->load->view('template/welcome_footer');
    }

    public function tell_a_friend_thankyou()
    {
        $this->load->view('template/welcome_header');
        $this->load->view('tell_a_friend_thankyou');
        $this->load->view('template/welcome_footer');
    }

    public function privacypolicy()
    {
        $udata['udata'] = $this->userdata;
        $this->load->view('template/welcome_header', $udata);
        $this->load->view('privacypolicy');
        $this->load->view('template/welcome_footer');
    }

    public function termsandconditions()
    {
        $udata['udata'] = $this->userdata;
        $this->load->view('template/welcome_header', $udata);
        $this->load->view('termsandconditions');
        $this->load->view('template/welcome_footer');
    }
    
    
    public function feedback_form($processed = 0)
    {
        
        if($processed == 1){
            $this->session->set_flashdata('success', 'You have successfully submitted your feedback to Ngonyama Link. We appreciate your contribution.');
            
        }
        
        $udata['udata'] = $this->userdata;
        
        $this->load->view('template/welcome_header', $udata);
        $this->load->view('feedback_form');
        $this->load->view('template/welcome_footer');
    }
    
    public function submit_feedback()
    {
        $data = $this->input->post();
        
        
        if (strlen($data['email'])==0){
            redirect(base_url('landing/index/subscribed'));
        }else{
            
            sleep(2);
            $this->email->from($data['email'], 'Feedback');
            $this->email->to('info@ngonyamalink.co.za');
            $this->email->subject('Infinite Shops : Feedback ' . $data['subject']);
            $this->email->message($data['message'] . " # " . $data['phone'] . " # " . $data['fullnames'].' # '. $data['email']);
            
            $this->email->send();
            
            sleep(2);
            
            redirect(base_url("landing/feedback_form/1"));
        }
    }
    
    public function infititeshops_json($keyword = NULL){
        echo json_encode($this->productservicedb->get_all_productservices($keyword));
    }
    
    public function infititeshops_stat_json(){
        echo json_encode($this->Stat_db->get_stat());
    } 
    
}
