<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('basic_model');
        $user_type = $this->session->userdata('current_user_type');
        if($user_type == 'admin' or $user_type == 'accountant'){}else{redirect('admin/dashboard');}
    }
	public function index()
	{
        $data['total_booking_room_count'] = 100;
        
		$this->load->view('admin/dashboard', $data);
	}
    
    // this function for account category page 

	public function account_category($id='')
	{
		// this user login 
		$data['cat_id']=$id;
		
		$this->load->view('admin/account/account_category', $data);
	}

    /*
========================================================================================
    ACCOUNT CATEGORY ADD/UPDATE/DELTE
========================================================================================
    */
    
    // this function for add a new cateogry
    
	public function add_account_category($id='')
	{
		if($this->input->post('add-category')){
			$attr=array(
				'category_for'=>$this->input->post('account_category'),
				'name'=>$this->input->post('category_name'),
				'parent'=>0
				);
			if($this->db->insert('texconomy', $attr)){
				$this->session->set_userdata('success_msg', 'Your category updated');
				redirect('admin/account/account_category');
			}else{
				$this->session->set_userdata('error_msg', 'Something wrong please try again');
				redirect('dashboard/account_category');
			}
		}else{
			$this->session->set_userdata('error_msg', 'Something wrong please try again');
			redirect('admin/account/account_category');
		}
	}
    
    //edit account category
    public function edit_account_category($id='')
	{
		if($this->input->post('add-category')){
			$data=array(
				'category_for'=>$this->input->post('account_category'),
				'name'=>$this->input->post('category_name')
				);
			if($this->basic_model->update_category($id, $data)){
				$this->session->set_userdata('success_msg', 'Your category updated');
				redirect('admin/account/account_category/'.$id);
			}else{
				$this->session->set_userdata('error_msg', 'Something Wrong please try again');
				redirect('admin/account/account_category/'.$id);
			}
		}else{
			$this->session->set_userdata('error_msg', 'Somthing wrong. please try again.');
		
			redirect('admin/account/account_category/'.$id);
		}
	}
    
    
    //account cateogry delete function
    public function delete_account_category($id='')
	{
		
		if($this->db->delete('texconomy', array('id'=>$id))){
			$this->session->set_userdata('success_msg', 'Delete complete');
			redirect('admin/account/account_category');
		}else{
			$this->session->set_userdata('error_msg', 'Somthing wrong. please try again.');
			redirect('admin/account/account_category');
		}
	}
    
    // this function for return this type of category

	public function account_category_by_type($type)
	{
		echo $this->basic_model->account_category_by_type($type);
	}
    
    
        /*
========================================================================================
    ACCOUNT  ADD/UPDATE/DELTE
========================================================================================
    */
    
    
    public function add_account($id=null)
	{
        $data=array();
        $data['ac_id']=$id;
		if($this->input->post('add-account')){
			$date = explode('/', $this->input->post('date'));
			 $attr=array(
				'account'=>$this->input->post('account'),
				'type'=>$this->input->post('account_type'),
				'texconomy_id'=>$this->input->post('account_category'),
				'day'=>$date[1],
				'month'=>$date[0],
				'year'=>$date[2],
				'parpose'=>$this->input->post('parpose'),
				'voucher'=>$this->input->post('voucher'),
				'comment'=>$this->input->post('comment')
				);
				
			if($this->db->insert('accounts', $attr)){
				$this->session->set_userdata('success_msg', 'Account added successfully');
				redirect('admin/account/add_account');
			}else{
				$this->session->set_userdata('error_msg', 'Something wrong');
				redirect('admin/account/add_account');
			}
		}
        
        $this->load->view('admin/account/add_account', $data);
        
	}
	
    
    // this function for account category page 

	public function edit_account($id='')
	{
		if($this->input->post('edit-account')){
			$date = explode('/', $this->input->post('date'));
			 $attr=array(
				'account'=>$this->input->post('account'),
				'type'=>$this->input->post('account_type'),
				'texconomy_id'=>$this->input->post('account_category'),
				'day'=>$date[1],
				'month'=>$date[0],
				'year'=>$date[2],
				'parpose'=>$this->input->post('parpose'),
				'voucher'=>$this->input->post('voucher'),
				'comment'=>$this->input->post('comment')
				);
				
			if($this->basic_model->update_account($id, $attr)){
				$this->session->set_userdata('success_msg', 'Account update successfully');
				redirect('admin/account/add_account/'.$id);
			}else{
				$this->session->set_userdata('error_msg', 'Something wrong');
				redirect('admin/account/add_account/'.$id);
			}
		}else{
			$this->session->set_userdata('error_msg', 'Something wrong');
			redirect('admin/account/add_account/'.$id);
		}
	}
    
    // this function for delete account 

	public function delete_account($id='')
	{
		
		if($this->db->delete('accounts', array('id'=>$id))){
			$this->session->set_userdata('success_msg', 'Delete complete');
			redirect('admin/account/add_account');
		}else{
			$this->session->set_userdata('error_msg', 'Something wrong');
			redirect('admin/account/add_account');
		}
	}
    
    
    
        
        /*
========================================================================================
    ACCOUNT OVSERBATIONS
========================================================================================
    */
    
    // this function for account ovservation
    public function account_observation(){
        
        $this->load->view('admin/account/observe');
    }
    
    
    //this function for make pdf results
	function pdf($month, $year){
		
		$data['month']=$month;
		$data['year']=$year;
		$data['ful_month_income']=$this->basic_model->get_report_full_month('income', $month, $year);
		$data['ful_month_expenditure']=$this->basic_model->get_report_full_month('expenditure', $month, $year);
		
		$data['income']=$this->basic_model->get_this_month_account_report_pdf('income', $month, $year);
		$data['expenditure']=$this->basic_model->get_this_month_account_report_pdf('expenditure', $month, $year);
		
		$this->load->helper('pdf_helper');
		
		$this->load->view('admin/account/pdfreport', $data);
	}
    
    
    
    
    
    
    
    
    
    
//end of the class
}

