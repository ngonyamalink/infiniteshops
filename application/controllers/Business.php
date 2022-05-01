<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Business extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->model(array(
            "businessdb",
            "productservicedb",
            "about_db"
        ));
        $this->load->library(array(
            "session",
            "email",
            "userlib"
        ));

        $this->userdata = $this->session->all_userdata();

    }

    public function mybusinesses()
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("business/all_businesses"));
        }

        $data['businesses'] = $this->businessdb->get_businesses_by_member_id($this->userdata['member_id']);

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("business/mybusinesses", $data);
        $this->load->view("template/welcome_footer");
    }

    public function all_businesses()
    {
        $data['businesses'] = $this->businessdb->get_all_businesses();

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("business/all_businesses", $data);
        $this->load->view("template/welcome_footer");
    }

    // form
    public function business_create_form($processed = 0)
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Business was sucessfully listed on Infinite Shops platform. You are able to list as many businesses and products/services.');
        }

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/business_create_form");
        $this->load->view("template/welcome_footer");
    }

    // submit
    public function submit_business_create()
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        // unset($data['userfile']);
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777",
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];
            $fdata = $this->input->post();
            $fdata['member_id'] = $this->userdata['member_id'];
            $fdata['logo_url'] = $attachment_url;
            $this->businessdb->add_business($fdata);
        } else {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            print_r($error);
            die();
        }

        redirect(base_url("business/business_create_form/1"));
    }

    // form
    public function business_edit_form($business_id = 0, $processed = 0)
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Business record has been updated.');
        }

        $data['business'] = $this->businessdb->owner_get_business($business_id, $this->userdata['member_id']);

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("business/business_edit_form", $data);
        $this->load->view("template/welcome_footer");
    }

    // submit
    public function submit_business_edit()
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        $fdata = $this->input->post();

        // unset($data['userfile']);
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777",
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata['logo_url'] = $attachment_url;
        }

        unset($fdata['userfile']);

        $this->businessdb->update_business($where = array(
            'member_id' => $this->userdata['member_id'],
            'business_id' => $fdata['business_id']
        ), $fdata);

        redirect(base_url("business/business_edit_form/$fdata[business_id]/1"));
    }

    // form
    public function product_service_create_form($business_id, $processed = 0)
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Your product/service has been listed. Email will be sent to you directly should someone show interest in your offering. Wishing you the best.');
        }

        $data['business_id'] = $business_id;

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/product_service_create_form", $data);
        $this->load->view("template/welcome_footer");
    }

    public function submit_product_service_create()
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        $fdata = $this->input->post();

        unset($fdata['category']);
        // unset($data['userfile']);
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777",
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata['url'] = $attachment_url;
        }

        $fdata['member_id'] = $this->userdata['member_id'];

        $this->productservicedb->add_productservice($fdata);
        
        
        
        // START BROADCAST
        
        //send email out
        $keyword = "email";
        $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/welcome/get_subscriptions_json";
        $json = file_get_contents($url_subscriptions . "/" . $keyword);
        $emails =  json_decode($json, true);
        
        
        
        //send sms out
        $keyword = "phone";
        $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/welcome/get_subscriptions_json";
        $json = file_get_contents($url_subscriptions . "/" . $keyword);
        $phones =  json_decode($json, true);
        
        // send email push notifications
        
        $email_string = 'info@ngonyamalink.co.za';
        
        $cnt = 0;
        
        foreach ( $emails as $value) {
            $cnt = $cnt + 1;
            $email_string = $email_string . "," . $value['email'];
        }
        
        if ($email_string != NULL) {
            
            echo ("Email Receipients : " . $email_string);
            
            $this->email->from('no-reply@ngonyamalink.co.za', 'NginyamaLink Wesbite');
            $this->email->bcc($email_string);
            $this->email->subject("Online Shopping : ".$fdata['productservice_name']);
            $this->email->message("A new item - ".$fdata['productservice_description']." - was uploaded on Ngonyama Link system. Proceed to preview ? https://www.ngonyamalink.co.za/infiniteshops");
            $this->email->send();
        }
        
        sleep(3);
        
        $textmessage = str_replace(" ", "+",  "A new item - ".$fdata['productservice_description']." - was uploaded on Ngonyama Link system. Proceed to preview ? https://www.ngonyamalink.co.za/infiniteshops");
        
        
        
        // send sms push notifications
        echo "<br/><br/>";
        
        $phone_string = '+27633861016';
        $cnt = 0;
        foreach ($phones as $value) {
            $cnt = $cnt + 1;
            $phone_string = $phone_string . "," . $value['phone'];
        }
        
        $phone_string = substr($phone_string, 1, strlen($phone_string));
        
        if ($phone_string != NULL) {
            
            echo ("SMS Receipients : " . $phone_string);
            
            $url = "https://platform.clickatell.com/messages/http/send?apiKey=uqTlIWcPRviI0IGfaVtBgg==&to=+27713022315&content=$textmessage.";
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            var_dump($response);
        }
        
        // END BROADCAST
        
        

        redirect(base_url("business/product_service_create_form/$fdata[business_id]/1"));
    }

    public function product_service_edit_form($business_id, $productservice_id, $processed = 0)
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Your product/service has been updated accordingly. Wishing you the best.');
        }

        $psdata['productservice'] = $this->productservicedb->get_productservice__product_id_business_id($business_id, $productservice_id);
        $psdata['business_id'] = $business_id;
        $psdata['productservice_id'] = $productservice_id;

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/product_service_edit_form", $psdata);
        $this->load->view("template/welcome_footer");
    }

    public function submit_product_service_edit()

    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        $fdata = $this->input->post();

        // unset($data['userfile']);
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777",
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata['url'] = $attachment_url;
        }

        unset($fdata['userfile']);

        unset($fdata['category']);
        unset($fdata['userfile']);

        $this->productservicedb->update_productservice($where = array(
            'business_id' => $fdata['business_id'],
            'productservice_id' => $fdata['productservice_id'],
            'member_id' => $this->userdata['member_id']
        ), $fdata);

        redirect(base_url("business/product_service_edit_form/$fdata[business_id]/$fdata[productservice_id]/1"));
    }

    public function product_service_list($business_id = 0)
    {
        
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("business/other_product_service_list/$business_id"));
        }
        if ($this->productservicedb->get_productservice_by_business_id_member_id($business_id, $this->userdata['member_id']) == FALSE) {
            redirect(base_url("business/other_product_service_list/$business_id"));
        }

        $data['business_id'] =  $business_id;
        
        $data['product_service_list'] = $this->productservicedb->get_productservice_by_business_id($business_id);

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/product_service_list", $data);
        $this->load->view("template/welcome_footer");
    }

    public function about_create_form($business_id)
    {
        $udata['udata'] = $this->userdata;
        $data['business_id'] = $business_id;
        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/about_create_form", $data);
        $this->load->view("template/welcome_footer");
    }

    public function submit_about()
    {
        $data = $this->input->post();

        if (! $this->businessdb->is_my_business($data['business_id'], $this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        $this->about_db->add_about($data);

        redirect(base_url("business/about_edit_form/$data[business_id]"));
    }

    public function about_edit_form($business_id)
    {
        if (! isset($this->userdata['member_id'])) {
            redirect(base_url("business/about_view_page/$business_id"));
        }

        if (! $this->businessdb->is_my_business($business_id, $this->userdata['member_id'])) {
            redirect(base_url("business/about_view_page/$business_id"));
        }

        $data['business_id'] = $business_id;
        $data['aboutcontent'] = $this->about_db->get_business_about($business_id);

        if ($data['aboutcontent'] == false) {
            redirect(base_url("business/about_create_form/$business_id"));
        }

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);
        $this->load->view("business/about_edit_form", $data);
        $this->load->view("template/welcome_footer");
    }

    public function about_view_page($business_id)
    {
        $data['business_id'] = $business_id;
        $data['aboutcontent'] = $this->about_db->get_business_about($business_id);
        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/about_view_page", $data);
        $this->load->view("template/welcome_footer");
    }

    public function submit_about_edit()
    {
        $data = $this->input->post();

        if (! $this->businessdb->is_my_business($data['business_id'], $this->userdata['member_id'])) {
            redirect(base_url("login/"));
        }

        $this->about_db->update_about($data['business_id'], $data);

        redirect(base_url("business/about_edit_form/$data[business_id]"));
    }

    public function other_product_service_list($business_id = 0)
    {
        
        $data = $this->input->post();
       
        if ($business_id != 0) {

            $data['product_service_list'] = $this->productservicedb->get_productservice_by_business_id($business_id);
        } else {
            if(isset($data['keyword']) && strlen ($data['keyword'])>0){
                $data['product_service_list'] = $this->productservicedb->get_all_productservices($data['keyword']);
            }else{
                $data['product_service_list'] = $this->productservicedb->get_all_productservices(); 
            }
            
        }

        $udata['udata'] = $this->userdata;

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/other_product_service_list", $data);
        $this->load->view("template/welcome_footer");
    }

    public function product_service_contact_form($productservice_id, $processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'The email message has been sent to the seller and yourself. Please check your emails for further discussion with the seller.');
        }

        $udata['udata'] = $this->userdata;

        $data['productservice'] = $this->productservicedb->get_productserviceByID($productservice_id);

        $this->load->view("template/welcome_header", $udata);

        $this->load->view("business/product_service_contact_form", $data);
        $this->load->view("template/welcome_footer");
    }

    public function submit_product_service_contact_form()
    {
        $data = $this->input->post();

        $reference_url = base_url("business/product_service_preview/$data[productservice_id]");

        sleep(3);

        $this->email->from($data['emailfrom'], 'infiniteshops-noreply');
        $this->email->to($data['emailto']);
        $this->email->cc($data['emailfrom']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message'] . '. Product/Service Preview Link :   ' . $reference_url);

        $this->email->send();

        sleep(3);

        redirect(base_url("business/product_service_contact_form/$data[productservice_id]/1"));
    }

    public function product_service_preview($productservice_id)
    {
        $udata['udata'] = $this->userdata;
        $data['productservice'] = $this->productservicedb->get_productserviceByID($productservice_id);
        $this->load->view("template/welcome_header", $udata);
        $this->load->view("business/product_service_preview", $data);
        $this->load->view("template/welcome_footer");
    }

    public function categorylist($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['categories'] = $this->Businesscategorylist_db->get_categories();
        $data['business_id'] = $business_id;

        $data['thisbusiness'] = $this->businessdb->get_business($business_id);
        if (isset($data['thisbusiness']['logo_url']) && strlen($data['thisbusiness']['logo_url']) > 0) {
            $data['logo_url'] = $data['thisbusiness']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }

        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("business/categorylist", $data);
    }

    public function index()
    {
      
    }

    public function get_business($business_id)
    {
        $data['foldersback'] = '../..';

        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['visitor_email'] = $this->membersession['email'];
        $data['thisbusiness'] = $this->businessdb->get_business($business_id);

        $business = get_business($business_id);
        $data['logo_url'] = $business['logo_url'];

        if (isset($data['thisbusiness']) && sizeof($data['thisbusiness']) < 1) {
            $this->bukaweb_layout("pagestatuses/notfound", $data);
        } else {
            $data['company_social_media_links'] = $this->social_db->get_social_media_by_business_id($business_id);
            $data['own_business'] = FALSE;

            $data['business_id'] = $business_id;
            if ($this->businessdb->is_my_business($business_id, $this->userlib->id)) {
                $data['own_business'] = TRUE;
            }

            $data['onlineuser_data'] = $this->userdata;
            $data['member_id'] = $this->userlib->id;
            if (isset($data['thisbusiness']['logo_url']) && strlen($data['thisbusiness']['logo_url']) > 0) {
                $data['logo_url'] = $data['thisbusiness']['logo_url'];
            } else {
                $data['logo_url'] = phangisa_logo();
            }
            $this->bukaweb_layout("t/get_business", $data);
        }
    }

   
    public function productservice_edit_form($business_id, $productservie_id, $fieldname)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($productservie_id)) {
            die("Something went wrong.");
        }

        $data['back'] = $this->agent->referrer();
        $data['business_id'] = $business_id;
        $data['fieldname'] = $fieldname;
        $data['productservie_id'] = $productservie_id;
        $data['logo_id'] = isset($this->membersession['ideal_business_id']) ? $this->membersession['ideal_business_id'] : false;
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/productservice_edit_form", $data);
    }

    public function submit_create_business()
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        $this->load->library('upload', upload_config());
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata = $this->input->post();
            unset($fdata['submit']);
            $fdata['member_id'] = $this->userlib->id;
            $fdata['logo_url'] = $attachment_url;
            $fdata['active'] = 1;
            $this->businessdb->add_business($fdata);

            // a new service provider has joined Phangisa

            $all_members = $this->memberdb->get_all_members();

            $subject = "Infinite Shops";
            $message = "A new serivice provider <b>'" . $fdata['business_name'] . "'</b> has joined Phangisa community. Go to www.phangisa.co.za for more details.";
            $this->load->library('email'); // load email library
            $this->email->set_mailtype("html");
            $this->email->from('info@phangisa.co.za', $subject); // sender's email

            $cnt = 0;
            foreach ($all_members as $am) {

                $this->email->to($am['member_email']);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                $cnt ++;
                if ($cnt % 5 == 0) {
                    sleep(5);
                }
            }

            redirect("t");
        } else {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            var_dump($error);
        }
    }

    public function get_business_productsservices($business_id)
    {
        $data['foldersback'] = '../..';

        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['company_social_media_links'] = $this->social_db->get_social_media_by_business_id($business_id);
        $data['own_business'] = FALSE;
        $data['business_id'] = $business_id;
        if ($this->businessdb->is_my_business($business_id, $this->userlib->id)) {
            $data['own_business'] = TRUE;
        }
        $business = get_business($business_id);
        $data['logo_url'] = $business['logo_url'];

        $data['businessproductsservices'] = $this->productservicedb->get_productservice_by_business_id($business_id);

        foreach ($data['businessproductsservices'] as $d) {

            if (strlen($d['logo_url']) > 0) {
                $data['logo_url'] = $d['logo_url'];
            }
        }

        if (isset($data['logo_url']) && strlen($data['logo_url']) > 0) {} else {
            $data['logo_url'] = phangisa_logo();
        }

        $data['business_id'] = $business_id;

        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/get_business_productsservices", $data);
    }

    
    public function submit_create_productservice()
    {
        $url = null;
        $this->load->library('upload', upload_config());
        if (! $this->upload->do_upload()) {
            $error = array(
                'error' => $this->upload->display_errors()
            );
        } else {
            $xdata = $this->upload->data();
            $url = base_url() . 'uploads/' . $xdata['file_name'];
        }

        $data = $this->input->post();
        $product_service_id = $this->productservicedb->add_productservice($data['productsevicename'], $data['productsevicedescription'], $data['productsevicecode'], $url, $data['business_id'], $this->userlib->id, $data['businesscategorylist_includes_id'], $data['on_promotion']);

 
        $all_members = $this->memberdb->get_all_members();

        $subject = "Phangisa 'new' product/service";
        $message = "A new product/service <b>'" . $data['productsevicename'] . "'</b> has been added to Phangisa platform by a service provider. Go to www.phangisa.co.za for more details.";
        $this->load->library('email'); // load email library
        $this->email->set_mailtype("html");
        $this->email->from('info@phangisa.co.za', $subject); // sender's email

        $cnt = 0;
        foreach ($all_members as $am) {

            $this->email->to($am['member_email']);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();

            $cnt ++;
            if ($cnt % 5 == 0) {
                sleep(5);
            }
        }

        redirect("/t/view_product_service/$data[business_id]/$product_service_id");
    }

    public function update_business()
    {
        $data = $this->input->post();
   
        unset($data['country_name']);
        unset($data['province_name']);
 
        $this->businessdb->update_business($data['business_id'], $data);
        redirect("/t/get_business/$data[business_id]");
    }

    public function remove_business($business_id)
    {
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        if ($this->businessdb->is_my_business($business_id, $this->userlib->id) == true) {} else {
            die("Url manipulation is not allowed");
        }

        $data['active'] = 0;

        $this->businessdb->update_business($business_id, $data);

        redirect("t");
    }

    public function verify_remove_business($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['business_id'] = $business_id;
        $data['thisbusiness'] = $this->businessdb->get_business($business_id);

        if (isset($data['thisbusiness']['logo_url']) && strlen($data['thisbusiness']['logo_url']) > 0) {
            $data['logo_url'] = $data['thisbusiness']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/verify_remove_business", $data);
    }

    public function view_product_service($business_id, $productservice_id = 0)
    {
        $data['foldersback'] = '../../..';

        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($productservice_id)) {
            die("Something went wrong.");
        }

        $data['own_business'] = FALSE;
        $data['business_id'] = $business_id;
        $data['productservice_id'] = $productservice_id;
        if ($this->businessdb->is_my_business($business_id, $this->userlib->id)) {
            $data['own_business'] = TRUE;
        }

        $data['back'] = $this->agent->referrer();
        $data['product_service'] = $this->productservicedb->get_productservice__product_id_business_id($business_id, $productservice_id);

        if (isset($data['product_service']['logo_url']) && strlen($data['product_service']['logo_url']) > 0) {
            $data['logo_url'] = $data['product_service']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/view_product_service", $data);
    }

    public function verify_remove_product_service($business_id, $product_service_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        $data['business_id'] = $business_id;
        $data['product_service_id'] = $product_service_id;

        $data['thisbusiness'] = $this->businessdb->get_business($business_id);
        if (isset($data['thisbusiness']['logo_url']) && strlen($data['thisbusiness']['logo_url']) > 0) {
            $data['logo_url'] = $data['thisbusiness']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/verify_remove_product_service", $data);
    }

    
    public function remove_product_service($business_id, $product_service_id)
    {
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        $this->productservicedb->update_productservice($business_id, $product_service_id, $this->userlib->id, 'active', 0);
        redirect("/t/get_business_productsservices/$business_id");
    }

    public function update_product_service()
    {
        $data = $this->input->post();
        if (isset($data['vtfileupload']) && $data['vtfileupload'] == 1) {

            $this->load->library('upload', upload_config());
            if ($this->upload->do_upload("userfile")) {
                $data = array(
                    'upload_data' => $this->upload->data()
                );
                $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

                $data = $this->input->post();
                unset($data['submit']);

                $where = array(
                    "business_id" => $data['business_id'],
                    "productservice_id" => $data['productservice_id']
                );

                $new_data = array(
                    "url" => $attachment_url
                );

                $this->productservicedb->update_productservice($where, $new_data);
                redirect("t/view_product_service/$data[business_id]/$data[productservice_id]");
            } else {
                die("error occured.");
            }
        } else {
            $data = $this->input->post();

            unset($data['submit']);

            $where = array(
                "business_id" => $data['business_id'],
                "productservice_id" => $data['productservice_id']
            );

            $this->productservicedb->update_productservice($where, $data);

            redirect("t/view_product_service/$data[business_id]/$data[productservice_id]");
        }
    }

    public function get_other_businesses($start = 1)
    {
        if (! is_numeric($start)) {
            die("Something went wrong.");
        }
        $data['visitor_email'] = $this->membersession['email'];

        $data['back'] = $this->agent->referrer();
        $data = $this->input->post();
        $data['otherbusinesses'] = array();
        $cnt = 0;
        foreach ($this->businessdb->get_other_businesses($this->userlib->id) as $ob) {
            $cnt ++;
            if (($cnt >= $start) && ($cnt < $start + 3)) {

                $data['otherbusinesses'][] = $ob;
            }
        }

        $data['start'] = $start;

        $data['logo_id'] = isset($this->membersession['ideal_business_id']) ? $this->membersession['ideal_business_id'] : false;

        $data['visitor_email'] = $this->membersession['email'];
    }

    public function get_other_business_by_id($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['back'] = $this->agent->referrer();
        $data['thisbusiness'] = $this->businessdb->get_business($business_id);

        if (isset($data['thisbusiness']['logo_url']) && strlen($data['thisbusiness']['logo_url']) > 0) {
            $data['logo_url'] = $data['thisbusiness']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }

        $data['onlineuser_data'] = $this->userdata;

        $data['member_id'] = $this->userlib->id;

        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/other/get_other_business_by_id", $data);
    }

    public function get_other_business_productsservices($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        $data['businessproductsservices'] = $this->productservicedb->get_productservice_by_business_id($business_id);
        $data['business_id'] = $business_id;

        $data['logo_url'] = '';
        foreach ($data['businessproductsservices'] as $p_s) {
            if (strlen($p_s['logo_url']) > 0) {

                $data['logo_url'] = $p_s['logo_url'];
            }
        }

        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/other/get_other_business_productsservices", $data);
    }

    public function view_other_product_service($business_id, $productservice_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($productservice_id)) {
            die("Something went wrong.");
        }

        $data['back'] = $this->agent->referrer();
        $data['email'] = $this->userlib->email;
        $data['product_service'] = $this->productservicedb->get_productservice__product_id_business_id($business_id, $productservice_id);

        if (isset($data['product_service']['logo_url']) && strlen($data['product_service']['logo_url']) > 0) {
            $data['logo_url'] = $data['product_service']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }
        $data['visitor_email'] = $this->membersession['email'];

        $this->bukaweb_layout("t/other/view_other_product_service", $data);
    }

    public function on_edit_categorylist($business_id, $product_service_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        $data['visitor_email'] = $this->membersession['email'];
        $data['categories'] = $this->businesscategorylist_db->get_categories();
        $data['business_id'] = $business_id;
        $data['product_service_id'] = $product_service_id;
        $this->bukaweb_layout("t/on_edit_categorylist", $data);
    }

    public function on_edit_subcategorylist($business_id, $product_service_id, $category_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        if (! is_numeric($category_id)) {
            die("Something went wrong.");
        }

        $data['subcategories'] = $this->businesscategorylist_includes_db->get_subcategories($category_id);
        $data['onlineuser_data'] = $this->userdata;
        $data['product_service_id'] = $product_service_id;
        $data['business_id'] = $business_id;

        $data['logo_id'] = isset($this->membersession['ideal_business_id']) ? $this->membersession['ideal_business_id'] : false;
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/on_edit_subcategorylist", $data);
    }

    public function update_product_service_subcat($business_id, $product_service_id, $field_name, $new_input)
    {
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($product_service_id)) {
            die("Something went wrong.");
        }

        $where = array(
            "business_id" => $business_id,
            "productservice_id" => $product_service_id
        );

        $new_data = array(
            $field_name => $new_input
        );

        $this->productservicedb->update_productservice($where, $new_data);

        redirect("t/view_product_service/$business_id/$product_service_id");
    }

    public function get_my_business_about($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if ($this->businessdb->is_my_business($business_id, $this->userlib->id) == true) {} else {
            die("Url manipulation is not allowed");
        }

        $data['business_id'] = $business_id;

        $data['companydata'] = $this->businessdb->get_business_about($business_id, $this->userlib->id);
        if (isset($data['companydata']['logo_url']) && strlen($data['companydata']['logo_url']) > 0) {
            $data['logo_url'] = $data['companydata']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }
        $data['visitor_email'] = $this->membersession['email'];

        $this->bukaweb_layout("t/get_my_business_about", $data);
    }

    public function get_other_business_about($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['business_id'] = $business_id;

        $data['companydata'] = $this->businessdb->get_business_about($business_id, 0);

        if (isset($data['companydata']['logo_url']) && strlen($data['companydata']['logo_url']) > 0) {
            $data['logo_url'] = $data['companydata']['logo_url'];
        } else {
            $data['logo_url'] = phangisa_logo();
        }

        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/other/get_other_business_about", $data);
    }

    public function calculate_amount($business_id = 0)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $this->load->helper(array(
            "form",
            "url"
        ));
        $fdata = $this->input->post();

        if ($business_id == 0) {

            $business_id = $fdata['business_id'];
        }

        $fdata['business_id'] = $business_id;

        $days = isset($fdata['days']) ? $fdata['days'] : 0;
        $fdata['days'] = $days;
        if (is_numeric($days) && $days > 0) {
            $fdata['calculated_amount'] = $this->starndard_amount * $days;
        }

        $fdata['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/calculate_amount", $fdata);
    }

    public function quotation()
    {}

    public function add_days($business_id, $days)
    {
        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }
        if (! is_numeric($days)) {
            die("Something went wrong.");
        }

        // restrict to specific user to be able to add days for other businesses.
        $email = $this->businessdb->add_business_days_remaining($business_id, $days);
        die("Send email to : " . $email . " Dear Client

We truly appreciate your business, and we're grateful for the trust you've placed in us. Please don't hesitate to call me if ever a problem should arise. We hope to have the pleasure of doing business with you for many years to come.

Sincerely,");
    }

    public function remove_days()
    {
        // restrict to specific user to be able to remove days for other businesses.
        $this->businessdb->remove_business_days_remaining();
        die("Send email to admin to show that the query was run");
    }

    public function accept_quotation($business_id, $days)
    {
        $data['thisbusiness'] = $this->businessdb->get_business($business_id);
        $total_amount = $this->starndard_amount * $days;
        $reference = $total_amount . "_" . $days . "_" . date("Y-m-d");
        $this->load->library('email'); // load email library
        $this->email->set_mailtype("html");
        $this->email->from($this->userlib->email, 'Phangisa Sales'); // sender's email
        $address = 'sales@phangisa.co.za'; // receiver's email
        $subject = "Request For Listing. Ref :" . $reference; // subject
        $message = /* -----------email body starts----------- */
                'Thanks for requesting a  service from us, ' . $this->userlib->name . '!<br><br>
      
        Customer Details.<br>
        -------------------------------------------------<br>
        Customer Name: ' . $this->userlib->name . " " . $this->userlib->surname . '<br>
        Business Name: ' . $data['thisbusiness']['business_name'] . '<br>
        Business Email: ' . $data['thisbusiness']['email'] . '<br>
        User Email: ' . $this->userlib->email . '<br> 
        Location: ' . $data['thisbusiness']['location'] . '<br>
        Contact : ' . $data['thisbusiness']['contact_no'] . '<br>
        Business ID : ' . $data['thisbusiness']['business_id'] . '<br>
        Amount Due : R ' . $total_amount . '<br>
        Days to add : ' . $days . '<br>
        Ref :' . $reference . '<br>
        -------------------------------------------------<br>
         <br>';

        /* -----------email body ends----------- */
        $this->email->to($address);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        redirect("t/listing_request_sent/" . $reference);
    }

    public function listing_request_sent($reference)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        $data['reference'] = $reference;
        $data['visitor_email'] = $this->membersession['email'];
        $this->bukaweb_layout("t/listing_request_sent", $data);
    }

    public function send_contact_message()
    {
        $this->load->helper("url");

        $fdata = $this->input->post();
        if ($fdata['InputSum'] == $fdata['InputReal']) {
            $data['thisbusiness'] = $this->businessdb->get_business($fdata['business_id']);
            $this->send_email($fdata['InputName'], $data['thisbusiness']['email'], $fdata['InputEmail'], $fdata['InputMessage']);
            redirect("t/succesfully_sent/" . $fdata['business_id']);
        } else {
            die("You did not prove you're human :) :) :)");
        }
    }

    function send_email($name, $business_email, $sender_email, $msg)
    {
        $this->load->library('email'); // load email library
        $this->email->set_mailtype("html");
        $this->email->from($sender_email, 'phangisa'); // sender's email
        $address = $business_email; // receiver's email
        $subject = "Business Contact Us"; // subject

        $message = /* -----------email body starts----------- */
                'Sender : ' . $name . '!<br><br>
      
        Message below: <br>
        -------------------------------------------------<br>
         ' . $msg . '<br>
    
        -------------------------------------------------<br>
     <br>';
        /* -----------email body ends----------- */
        $this->email->to($address);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function succesfully_sent($business_id)
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";

        if (! is_numeric($business_id)) {
            die("Something went wrong.");
        }

        $data['visitor_email'] = $this->membersession['email'];
        $data['thisbusiness'] = $this->businessdb->get_business($business_id);

        $this->bukaweb_layout("t/succesfully_sent", $data);
    }

    public function get_promotions()
    {
        $data['authstring'] = isset($this->membersession['authstring']) ? $this->membersession['authstring'] : "ngonyamalink_guest";
        $data['visitor_email'] = $this->membersession['email'];
        $data['promotions'] = $this->productservicedb->get_promotions();
        $this->bukaweb_layout("t/get_promotions", $data);
    }
}

?>