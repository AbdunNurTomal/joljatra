<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notices extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('front_model');
        $this->load->model('post_model');
    }
	public function index($page=null)
	{
        $post_type='notice';
        $status='publish';
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'/notices/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->post_model->get_post_count($post_type, $status);
		$config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['last_link'] = 'LAST →';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '← FIRST';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a>';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '';
		$config['prev_link'] = '';
		$config['cur_tag_open'] = '<li class="page-item  active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
        $this->pagination->initialize($config); 
        
        $data['links']=$this->pagination->create_links();
        $data['type']=$post_type;
        
     
        $data['notices']=$this->post_model->get_all_post($post_type, $status, $config['per_page'],  $page);
        
		$this->load->view('frontend/notices/notice-list', $data);
	}
    
    public function view($meta=null){
        $data=array();
        $data['page_data']=null;
        $this->db->or_where(array('post_slug'=>urldecode($meta), 'id'=>$meta));
        $result = $this->db->get('_posts');
        $result=$result->row(0);
        if($result){
            $data['notice']=$result;
            $this->load->view('frontend/notices/view', $data);
        }else{
           $this->load->view('frontend/404', $data); 
        }
        
    }
    
   
}


