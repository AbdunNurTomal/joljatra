<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('post_model');
        
    }
    /*This function for about page*/
    public function index($meta=null){
		$language = "'".$this->session->userdata('language')."'";//exit;
		$this->lang->load('cabin',$language);
		$data = array(
						'sidebar_logo_item_joljatra' => $this->lang->line('sidebar_logo_item_joljatra'),
						'sidebar_item_home' => $this->lang->line('sidebar_item_home'),
						'sidebar_item_cabinbooking' => $this->lang->line('sidebar_item_cabinbooking'),
						'sidebar_item_about' => $this->lang->line('sidebar_item_about'),
						'sidebar_item_uses' => $this->lang->line('sidebar_item_uses'),
						'sidebar_item_contact' => $this->lang->line('sidebar_item_contact'),
						'right_menu_item_signup' => $this->lang->line('right_menu_item_signup'),
						'right_menu_item_login' => $this->lang->line('right_menu_item_login'),
						'right_menu_item_profile' => $this->lang->line('right_menu_item_profile'),
						'right_menu_item_logout' => $this->lang->line('right_menu_item_logout'),
						'body_first_name' => $this->lang->line('body_first_name'),
						'body_last_name' => $this->lang->line('body_last_name'),
						'body_phone_no' => $this->lang->line('body_phone_no'),
						'body_user_name' => $this->lang->line('body_user_name'),
						'body_email' => $this->lang->line('body_email'),
						'body_password' => $this->lang->line('body_password'),
						'body_type_user_name' => $this->lang->line('body_type_user_name'),
						'body_forget_password' => $this->lang->line('body_forget_password'),
						'body_password_reset' => $this->lang->line('body_password_reset'),
						'body_reset' => $this->lang->line('body_reset'),
						'body_password_reset_code' => $this->lang->line('body_password_reset_code'),
						'body_reset_code' => $this->lang->line('body_reset_code'),
						'body_reset_password' => $this->lang->line('body_reset_password'),
						'body_again_reset_code' => $this->lang->line('body_again_reset_code')
					);				
		$this->db->cache_on();
        $data['title']='About us';
        
        $data['description']='We are the best web service provider in the world. We are develop professional website, desktop software & mobile apps and we have another services like domain,hosting,seo,graphics design and outsourcing team.So this is your best company to improve your business by our service.Take your decision.';
        
        $data['keyword']='web site development, web site, doftware development, software, domain registration, domain, hosting package, hosting, seo, serch engine optimization, seo';
        
        $data['page_data']=null;
        $this->db->or_where(array('post_slug'=>urldecode($meta), 'id'=>$meta));
        $result = $this->db->get('_posts');
        $result=$result->row(0);
        if($result){
            $data['page_data']=$result;
            $this->load->view('frontend/page', $data);
        }else{
           $this->load->view('frontend/404', $data); 
        }
        
    }
    
    
    //terminal map 
    public function terminalmap(){
		$this->db->cache_off();
		$data=array();
		$this->load->library('googlemaps');
		$this->load->helper('url');
		$this->googlemaps->initialize();
		$marker = array();
		$marker['icon'] = site_url('assets/frontend/images/map-ico.png');
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);
	
		$data['map'] = $this->googlemaps->create_map();   
		$data['result'] = $this->user_model->get_terminal_location();	
		$this->db->cache_on();
        $this->load->view('frontend/terminalmap',$data);
    } 
    
    //prayer time
    public function prayertime(){
        $this->load->view('frontend/prayertime');
    } 
    //weather 
    public function weather(){
        $this->load->view('frontend/weather');
    } 
    
    
    public function __destruct(){
        $this->db->cache_off();
    }
	
}//end of class
