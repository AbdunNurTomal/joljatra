<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('current_user_type')!='admin'){redirect('admin/dashboard');}
    }
	public function index(){
        echo 'Page not found';
	}
    
    public function walletmix(){
        if($this->input->post('save_settings')){
            $attr=array(
                'walletmix_access_username'=>$this->input->post('walletmix_access_username'),
                'walletmix_access_password'=>$this->input->post('walletmix_access_password'),
                'walletmix_access_app_key'=>$this->input->post('walletmix_access_app_key'),
                'walletmix_access_marchent_id'=>$this->input->post('walletmix_access_marchent_id')
            );
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        $this->load->view('admin/settings/payment/walletmix');
    }
    
    // this method for sms settings 
    public function sms(){
        if($this->input->post('save_settings')){
            $attr=array(
                'engineer_bd_sms_api_key'=>$this->input->post('engineer_bd_sms_api_key'),
                'engineer_bd_sms_sender_id'=>$this->input->post('engineer_bd_sms_sender_id'),
                'sign_up_sms'=>$this->input->post('sign_up_sms'),
                'sms_after_booking'=>$this->input->post('sms_after_booking'),
				'sms_broadcast'=>$this->input->post('sms_broadcast')
            );
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        $this->load->view('admin/settings/sms_settings');
    }
	// this method for map settings 
    public function map(){
        if($this->input->post('save_settings')){
            $attr=array(
                'google_map_api_key'=>$this->input->post('google_map_api_key'),
                'google_map_created_id'=>$this->input->post('google_map_created_id')
            );
			
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        $this->terminal();
    }
	
	// this method for terminal settings 
    public function terminal(){
		$data=array();
        $this->load->library('googlemaps');
		$this->load->helper('url');
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		$marker = array();
		$marker['icon'] = site_url('assets/frontend/images/map-ico.png');
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);
	
		$data['map'] = $this->googlemaps->create_map();   
		
		$data['result'] = $this->user_model->get_terminal_location();
		//print_r($data['result']);exit;
        $this->load->view('admin/settings/terminal_settings',$data);
    }
	
	public function add_edit_terminal_map(){
		$result = $this->user_model->terminal_map();		
		if($result==true){ 
		
		}else{
			echo $result;
		}
	}
	
	public function delete_terminal_map(){
		$result = $this->user_model->terminal_map_delete();
		if($result==false){ echo $result; }
	}
    
    // this function for websit header settings 
    public function website_header(){
        if($this->input->post('save_settings')){
            $attr=array(
                'website_title'=>$this->input->post('website_title'),
                'website_meta_keyword'=>$this->input->post('website_meta_keyword'),
                'website_meta_description'=>$this->input->post('website_meta_description')
            );
            
            // if set a logo for upload to the site then upload the logo and delete the current logo then set the new logo and update databse
            if($_FILES['website_logo']["tmp_name"]){
               if($website_logo = $this->do_upload('./uploads/file/', 'website_logo')){
                   if(file_exists('./uploads/file/'.$this->user_model->get_setting_data('website_logo'))){
                       unlink('./uploads/file/'.$this->user_model->get_setting_data('website_logo'));
                   }
                   $attr['website_logo']=$website_logo;
               }
            } // end logo upload of the website
            
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        $this->load->view('admin/settings/webiste_header');
    }
    // this function for websit footer settings 
    public function website_footer(){
        if($this->input->post('save_settings')){
            $attr=array(
                'footer_copyright_text'=>$this->input->post('footer_copyright_text'),
                'footer_facebook_link'=>$this->input->post('footer_facebook_link'),
                'footer_twitter_link'=>$this->input->post('footer_twitter_link'),
                'footer_linkedin_link'=>$this->input->post('footer_linkedin_link'),
                'footer_youtube_link'=>$this->input->post('footer_youtube_link'),
                'footer_google_plus_link'=>$this->input->post('footer_google_plus_link')
            );
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        
        $this->load->view('admin/settings/webiste_footer');
    }
    
    // this function for websit footer settings 
    public function home_download(){
        if($this->input->post('save_settings')){
            $attr=array(
                'download_title'=>$this->input->post('download_title'),
                'download_sub_title'=>$this->input->post('download_sub_title'),
                'android_app_link'=>$this->input->post('android_app_link'),
                'apple_app_link'=>$this->input->post('apple_app_link')
            );
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        
        $this->load->view('admin/settings/home_download');
    }
    
    
    // this function for websit footer settings 
    public function home_testimonial(){
        if($this->input->post('save_settings')){
            $attr=array(
                'testimonial_title'=>$this->input->post('testimonial_title')
            );
            if($this->update_settings_data($attr)){
                $this->session->set_userdata('success_msg', 'Your settings has been updated');
            }else{
                $this->session->set_userdata('success_msg', 'Something wrong please try again');
            }
        }
        
        $this->load->view('admin/settings/home_testimonial');
    }
    
    
    // This method for update settings data 
    public function update_settings_data($attr){
        if($attr){
            $errors=array();
            foreach($attr as $key=>$data){
				//echo $key.'~'.$data;exit;
                if(!empty($data)){
                    if($this->user_model->get_setting_data_old($key)){
                        if($this->db->where('data_id', $key)->update('setting', array('data_id'=>$key, 'data'=>$data))){
                            //nothing 
                        }
                    }else{
                        if($this->db->insert('setting', array('data_id'=>$key, 'data'=>$data))){
                            // nothing
                        }else{
                            $error[$key]=$key.' is not updated';
                        }
                    }
                }
            }
            if($errors){ return false; }
			else{ return true; }
        }else{
            return false;
        }
    }
        
    /*This is a fucntion that upload the hotel image*/
    public function do_upload($upload_path, $file_input_field){
        $path = $upload_path; 
        $fileTmpName=$_FILES[$file_input_field]["tmp_name"];
        $upload_dir = $upload_path; 
        $file_name = $_FILES[$file_input_field]['name'];
        $type = explode('.', $file_name);
        $type = $type[count($type)-1];
        $time = time();
        if( in_array($type, array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'PNG', 'JPG', 'GIF' )) ){
            if( is_uploaded_file( $_FILES[$file_input_field]['tmp_name'] ) ){
                move_uploaded_file( $_FILES[$file_input_field]['tmp_name'], $upload_dir.$time.$file_input_field.$file_name );
                return $time.$file_input_field.$file_name;
            }
        }else{
            $this->session->set_userdata('error_msg', 'File type not supported');
            return false;
        }
   }
}
?>