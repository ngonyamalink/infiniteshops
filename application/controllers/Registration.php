<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Registration extends CI_Controller
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
            'Memberdb',
            'Businessdb',
            'Marketing_db'
        ));

        $this->userdata = $this->session->all_userdata();
    }

    public function index($processed = 0)
    {
        if($processed == 1){
            $this->session->set_flashdata('success', 'You have sucessfully registered with Infinite Shops. Enjoy the unlimitted hosting of businesses and browsing for products and services. Proceed to login or check your emails for more information.');
            
        }
        
        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("registration/index");
        $this->load->view("template/welcome_footer");
    }

    public function submit_registration()
    {
        $fdata = $this->input->post();
        $activation_code = do_hash($fdata['firstname'], 'md5');
        $this->Memberdb->AddMember($fdata['firstname'], $fdata['lastname'], '1970-01-01', 0, 101, 2, strtolower($fdata['email']), do_hash($fdata['password'], 'md5'), $activation_code);

        sleep(2);
 

        $this->email->from('infiniteshops-noreply@ngonyamalink.co.za', 'infiniteshops-noreply');
        $this->email->to($fdata['email']);
 
        $this->email->subject('InfiniteShops-Registration');
        $this->email->message('You have succesfully registered with InfiniteShops. You can start using the the application - ' . base_url());

        $this->email->send();
 

        redirect(base_url("registration/index/1"));
    }

    public function account_created_thank_you()
    {
        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("registration/account_created_thank_you");
        $this->load->view("template/welcome_footer");
    }

    function send_confirmation($name, $username, $hash, $password)
    {
        $this->load->library('email'); // load email library
        $this->email->set_mailtype("html");
        $this->email->from('infiniteshops-noreply@ngonyamalink.co.za', 'Infinite Shops Registration'); // sender's email
        $address = $username; // receiver's email
        $subject = "Infinite Shops Registration"; // subject
        $link = base_url() . 'index.php/registration/verify?' . 'username=' . $username . '&hash=' . $hash;
        $message = /* -----------email body starts----------- */
                'Thanks for signing up, ' . $name . '!<br><br>
      
        Here are your login details.<br>
        -------------------------------------------------<br>
        Username: ' . $username . '<br>
        Password: ' . $password . '<br>
        -------------------------------------------------<br>
        <a href="' . $link . '">' . $link . '</a><br>';
        /* -----------email body ends----------- */
        $this->email->to($address);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function verify()
    {
        if (isset($_GET['username']) && isset($_GET['hash'])) {
            if ($this->Memberdb->hash_and_username_exist($_GET['hash'], $_GET['username'])) {
                $this->Memberdb->activate_user($_GET['username']);
                redirect("login");
            } else {
                die("Invalid parameters");
            }
        } else {
            die("Please try again");
        }
    }
}
