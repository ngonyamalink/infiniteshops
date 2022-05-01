<?php

class Login extends CI_Controller
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
            'Businessdb'
        ));
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->membersession = $this->session->all_userdata();

        $this->userdata = $this->session->all_userdata();
    }

    public function index()
    {
        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("login/index");
        $this->load->view("template/welcome_footer");
    }

    public function login_auth()
    {
        $data = $this->input->post();

        $result = $this->userlib->getUser($data['email'], do_hash($data['password'], 'md5'));

        if ($result) {
            $this->session->set_userdata(array(
                "email" => $this->userlib->email,
                "member_id" => $this->userlib->id,
                "member_name" => $this->userlib->name,
                "member_surname" => $this->userlib->surname
            ));

            redirect(base_url("business/mybusinesses"));
        } else {
            redirect(base_url("login/"));
        }
    }

    public function auth($authstring = null)
    {
        $data = $this->input->post();

        $this->userlib->getUserByAuthKey($authstring);

        if ($this->userlib->id) {
            $this->session->set_userdata(array(
                "email" => strtolower($this->userlib->email),
                "password" => $this->userlib->password,
                'authstring' => $authstring
            ));
            $ideal_business_id = isset($this->membersession['ideal_business_id']) ? $this->membersession['ideal_business_id'] : 0;

            if ($ideal_business_id > 0) {
                redirect("t/get_business/$ideal_business_id");
            } else {
                redirect("catalogue/index");
            }
        } else {
            redirect("login");
        }
    }

    public function shop_handle($business_id = 0)
    {
        // $business_id = base64_decode(urldecode($business_id));
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        if ($business_id == 0) {
            $this->session->sess_destroy();
            die($business_id);
            redirect("login/index");
        }

        if ($this->businessdb->get_business($business_id) == false) {
            $this->session->sess_destroy();
            redirect("login/index");
        }

        $ideal_business_id = $business_id;

        if (isset($this->membersession['email']) && $this->membersession['email'] != get_default_username()) {} else {

            $this->userlib->getUser(strtolower(get_default_username()), get_default_password());
            $this->session->set_userdata(array(
                "email" => strtolower($this->userlib->email),
                "password" => $this->userlib->password,
                "ideal_business_id" => 0
            ));
            $this->membersession = $this->session->all_userdata();
        }

        if ($ideal_business_id > 0) {
            $ideal_business_id = $ideal_business_id; // urlencode( base64_encode( $ideal_business_id ) );
            redirect("about/index/$ideal_business_id");
        } else {
            redirect("t/get_my_businesses");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
    }

    public function forgot_password()
    {
        $this->load->view('template/welcome_header');

        $this->load->view('login/forgot_password');

        $this->load->view('template/welcome_footer');
    }

    public function submit_forgot_password()
    {
        $data = $this->input->post();

        $password_hash = do_hash(date('l jS \of F Y h:i:s A'), "md5");

        $this->Memberdb->updateMember(array(
            "member_email" => $data['email']
        ), array(
            'resetpassword_hash' => $password_hash
        ));

        sleep(2);


        $this->email->from('infiniteshops-noreply@ngonyamalink.co.za', 'infiniteshops-noreply');
        $this->email->to($data['email']);
        $this->email->subject('InfiniteShops-Forgot-Password');


        $this->email->message('Click on the link to reset password - ' . base_url("login/new_password_form/$password_hash"));

        $this->email->send();
        
        redirect(base_url("login/forgot_password"));
    }

    public function submit_new_password()
    {
        $data = $this->input->post();

        $this->Memberdb->updateMember(array(
            'resetpassword_hash' => $data['resetpassword_hash']
        ), array(
            "member_password" => do_hash($data['password'], "md5")
        ));

        redirect(base_url("login"));
    }

    public function new_password_form($resetpassword_hash)
    {
        $udata['udata'] = $this->userdata;
        $udata['resetpassword_hash'] = $resetpassword_hash;
        $this->load->view('template/welcome_header', $udata);
        $this->load->view('login/new_password_form', $udata);
        $this->load->view('template/welcome_footer');
    }

    // reset pass
    public function forgot()
    {
        $data['visitor_email'] = null;
        $registrations = $this->Memberdb->count_members();
        $data['cnt_registrations'] = $registrations['total'];
        if (isset($this->membersession['email']) && $this->membersession['email'] != get_default_username()) {
            $data['visitor_email'] = $this->membersession['email'];
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->bukaweb_layout_out("login/forgot", $data);
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->Memberdb->getUserInfoByEmail($clean);

            if (! $userInfo) {
                $this->session->set_flashdata('flash_message', 'We cant find your email address');
                redirect(site_url() . 'login');
            }

            if ($userInfo->active != 1) { // if status is not approved
                $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                redirect(site_url() . 'login');
            }

            // build token

            $token = $this->Memberdb->insertToken($userInfo->member_id);

            $url = site_url() . 'login/reset_password/token/' . $token;

            $link = '<a href="' . $url . '">' . $url . '</a>';

            $message = '';
            $message .= '<strong>A password reset has been requested for this email account</strong><br>';
            $message .= '<strong>Please click:</strong> ' . $link;
            // echo $message; //send this through mail

            $this->load->library('email'); // load email library
            $this->email->set_mailtype("html");
            $this->email->from('info@phangisa.co.za', 'Phangisa Forgot Password'); // sender's email
            $subject = "Phangisa Forgot Password"; // subject

            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            redirect("login/reset_link_sent");
        }
    }

    public function reset_link_sent()
    {
        $data['visitor_email'] = isset($this->membersession['email']) ? $this->membersession['email'] : false;

        $this->bukaweb_layout_out("login/reset_link_sent", $data);
    }

    public function reset_password()
    {
        $token = $this->uri->segment(4);
        $user_info = $this->Memberdb->isTokenValid($token); // either false or array();
        if (! $user_info) {
            $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
            redirect(site_url() . 'login');
        }
        
        $data = array(
            'user_id' => $user_info->member_id,
            'firstName' => $user_info->member_name,
            'email' => $user_info->member_email,
            'token' => $token
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->bukaweb_layout_out("login/reset_password", $data);
        } else {

            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = do_hash($cleanPost['password'], "md5");

            // new password
            $cleanPost['password'] = $hashed;

            // member_id
            $cleanPost['member_id'] = $user_info->member_id;

            unset($cleanPost['passconf']);
            if (! $this->memberdb->updatePassword($cleanPost['member_id'], $cleanPost['password'])) {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
            } else {
                $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
            }
            redirect(site_url() . 'login');
        }
    }
}
