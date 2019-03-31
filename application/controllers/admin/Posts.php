<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Admin_Controller {
   public $post_types = array('post', 'page', 'slider', 'notice', 'lonch', 'lonch_facility', 'testimonial');
    public $post_status = array('publish', 'unpublish', 'trashed');
    function __construct(){
		parent:: __construct();
        $this->load->model('post_model');
        if($this->session->userdata('current_user_type')!='admin'){
            redirect('admin/dashboard');
        }
	}
    
    //user index function---------------------------------------------------
	public function index($post_type='post', $status='publish'){
       redirect('admin/posts/type/'.$post_type.'/'.$status);
	}
    
    /*display all post*/
    function type($post_type='post', $status='publish'){
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/posts/type/'.$post_type.'/'.$status.'/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->post_model->get_post_count($post_type, $status);
		$config['per_page'] = 10;
        $config['full_tag_open'] = '<ul style="margin: 0;" class="pagination pagination-sm">';
		$config['full_tag_close'] = '</ul>';
		$config['last_link'] = 'LAST →';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '← FIRST';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<a>';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '';
		$config['prev_link'] = '';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
        $this->pagination->initialize($config); 
        $data['links']=$this->pagination->create_links();
        $data['type']=$post_type;
        
        $current_page = $this->uri->segment(6);
        if(in_array($post_type, $this->post_types) and in_array($status, $this->post_status)){  }else{redirect('404_error');}
        
        
         $data['post_type']=$post_type;
         $data['post_status']=$this->post_status;
        $data['post_data']=$this->post_model->get_all_post($post_type, $status, $config['per_page'],  $current_page);
        
        $this->load->view('admin/posts/all_post', $data);
    }
    
    /*add new post function--------------------------------------------------------------*/
    public function add_new($type){
        if($this->input->post('post_title')){
            $post_slug = $this->make_unique_post_slug($this->input->post('post_title'));
            $post_category = $this->input->post('post_category');
            if($post_category){
                $post_category = implode(',', $post_category);
            }else{
                $post_category='';
            }
            $post_attr=array(
                'post_title'=>$this->input->post('post_title'),
                'post_title_eng'=>$this->input->post('post_title_eng'),
                'post_content'=>$this->input->post('post_content'),
				'post_content_eng'=>$this->input->post('post_content_eng'),
                'post_slug'=>$post_slug,
                'post_type'=>$type,
                'post_category'=>$post_category,
                'post_excerpt'=>$this->input->post('post_excerpt'),
				'post_excerpt_eng'=>$this->input->post('post_excerpt_eng'),
                'thumbnail'=>$this->input->post('fetured_image_id'),
                'post_author'=>$this->session->userdata('current_user_id'),
                'post_youtube_video_id'=>$this->input->post('youtube_video_id'),
                'post_status'=>'publish'
            );
            
            if($this->db->insert('_posts', $post_attr)){
                /*update category for category table*/
                $last_insert_id = $this->db->insert_id();
                
                $this->update_post_category($last_insert_id, $this->input->post('post_category'));
                
                $this->facebook_auto_post($last_insert_id);
                
                $attr = array('success_msg'=> 'Post add success', 'action'=>'This post add successfully', 'action_class'=>'message-confirm-success');
                   $this->session->set_userdata($attr);
                    redirect('admin/posts/type/'.$type);
            }else{
                 $attr = array('error_msg'=> 'Add post error', 'action'=> 'Something wrong please try again', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
            }
        }
        
        
        
        $data['categories']=$this->post_model->get_all_category($type);
        $data['type']=$type;
        $this->load->view('admin/posts/new_post',$data);
    }
    
    /*add new post function--------------------------------------------------------------*/
    public function edit($post_id, $type){
        if($this->input->post('post_title')){
            $post_slug = $this->make_unique_post_slug($this->input->post('post_title'));
            $post_category = $this->input->post('post_category');
            if($post_category){
                $post_category = implode(',', $post_category);
            }else{
                $post_category='';
            }
            $post_attr=array(
                'post_title'=>$this->input->post('post_title'),
				'post_title_eng'=>$this->input->post('post_title_eng'),
                'post_content'=>$this->input->post('post_content'),
				'post_content_eng'=>$this->input->post('post_content_eng'),
                'post_slug'=>$post_slug,
                'post_type'=>$type,
                'post_category'=>$post_category,
                'post_excerpt'=>$this->input->post('post_excerpt'),
				'post_excerpt_eng'=>$this->input->post('post_excerpt_eng'),
                'thumbnail'=>$this->input->post('fetured_image_id'),
                'post_author'=>$this->session->userdata('current_user_id'),
                'post_youtube_video_id'=>$this->input->post('youtube_video_id'),
            );
            $this->db->where('id', $post_id); 
            if($this->db->update('_posts', $post_attr)){
                
			/*update post category*/
			$this->update_post_category($post_id, $this->input->post('post_category'));
			$attr = array('success_msg'=> 'Post update success', 'action'=>'This post update successfully', 'action_class'=>'message-confirm-success');
				$this->session->set_userdata($attr);
				redirect('admin/posts/edit/'.$post_id.'/'.$type);
            }else{
                $attr = array('error_msg'=> 'Add post error', 'action'=> 'Something wrong please try again', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
            }
        }
        
        $data['categories']=$this->post_model->get_all_category($type);
        $data['post_data']=$this->post_model->get_post($post_id);
        $data['type']=$type;
        $data['post_id']=$post_id;
        $this->load->view('admin/posts/edit_post',$data);
    }
    
    
    /*update post category in _post_category tabel*/
    public function update_post_category($post_id, $category_ids){
        $this->db->query("DELETE FROM _posts_category WHERE post_id=$post_id");
        if($category_ids){
            foreach($category_ids as $id){
                $this->db->insert('_posts_category', array('post_id'=>$post_id, 'category_id'=>$id));
            }
        }
    }
    
    
    /*This function for make unique post title----------------------------------------*/
    
      public function make_unique_post_slug($post_title){
        $post_title = url_title($post_title, '-', TRUE);
        $post_title = str_replace("/","-",$post_title);
        $post_title = ltrim($post_title);
        $post_title = rtrim($post_title);
        $post_title = explode(' ', $post_title);
        $post_title = implode('-', $post_title);
        if($this->post_model->is_unique_post_slug($post_title)){
            return $post_title;
        }else{
            for($counter=1;$counter>0;$counter++){
                $new_title = $post_title.'-'.$counter;
                if($this->post_model->is_unique_post_slug($new_title)){
                    $post_title = $new_title;
                    break;
                }
            }
            return $post_title;
        }
    }
    
    public function facebook_auto_post($id){
        //lagbena apatoto
      
        
    }
    
    public function make_short_description($content, $count=25){
        $filter_txt='';
        if($content){
            $content = strip_tags($content);
            $content = explode($content, ' ');
            if(count($content)>1){
                for($counter=0;$counter<=$count;$counter++){

                    if($content[$counter]){
                        $filter_txt .=$content[$counter].' ';
                    }

                }
            }
        }
        
        return $filter_txt;
    }
    
    
    
    
    /*This function for delete single post--------------------------------------------------------------*/
    public function delete($id=null, $post_type=null){
        if($this->db->delete('_posts', array('id'=>$id))){
             $this->db->query("DELETE FROM _posts_category WHERE post_id=$id");
             $attr = array('success_msg'=> 'Deletion success', 'action'=>'Your deletion successfull.', 'action_class'=>'message-confirm-success');
               $this->session->set_userdata($attr);
               redirect('admin/posts/type/'.$post_type);
        }else{
            $attr = array('error_msg'=> 'Deletion Error', 'action'=>'Something wrong please try again.', 'action_class'=>'message-confirm-danger');
            $this->session->set_userdata($attr);
            redirect('admin/posts/type/'.$post_type);
        }
       
        
    }
    
    
    public function delete_all($post_type)
	{
        if($this->input->post('all_check')){
            foreach($this->input->post('all_check') as $id){
                $this->db->delete('_posts', array('id'=>$id));
                $this->db->query("DELETE FROM _posts_category WHERE post_id=$id");
            } 
            $attr = array('success_msg'=> 'Delete complete', 'action'=>'Your deletion successfully complete', 'action_class'=>'message-confirm-success');
            $this->session->set_userdata($attr);
            redirect('admin/posts/type/'.$post_type);
        }else{
           redirect('admin/posts/type/'.$post_type);
        }
       
	}
    
    
    
    
    
    /*
    ============================================================================================================
                POST CATEGORY HANDALLER
    ============================================================================================================
    */
    
    public function category($type='post'){
        $data['categories']=$this->post_model->get_all_category($type);
        $data['type']=$type;
        $this->load->view('admin/posts/category',$data);
    }
    /*add post category*/
    public function add_category($type='post'){
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|callback__is_unique_slug');
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        if($this->form_validation->run()){
            $data_attr = array(
                'category_name'=>$this->input->post('name'),
                'category_slug'=>$this->post_model->url_converter($this->input->post('slug')),
                'category_post_type'=>$type,
                'category_keyword'=>$this->input->post('keyword'),
                'category_description'=>$this->input->post('description'),
            );
            if($this->db->insert('_category', $data_attr)){
                $attr = array('success_msg'=> 'Category add success', 'action'=>'This category add successfully', 'action_class'=>'message-confirm-success');
                   $this->session->set_userdata($attr);
            }else{
                $attr = array('error_msg'=> 'Add category error', 'action'=> 'Something wrong please try again', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
            }
        }else{
            $attr = array('error_msg'=> 'Add category error', 'action'=>validation_errors('<p>', '</p>'), 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
        }
        $data['categories']=$this->post_model->get_all_category($type);
        $data['type']=$type;
        $this->load->view('admin/posts/category',$data);
    }
    
    /*edit post category*/
    public function edit_category($type='post', $id){
        if(!isset($id)){
            redirect('admin/posts/'.$type);
        }
        
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|callback__is_unique_slug['.$id.']');
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        if($this->form_validation->run()){
            $data_attr = array(
                'category_name'=>$this->input->post('name'),
                'category_slug'=>$this->post_model->url_converter($this->input->post('slug')),
                'category_post_type'=>$type,
                'category_keyword'=>$this->input->post('keyword'),
                'category_description'=>$this->input->post('description'),
            );
            if($this->post_model->update_category('_category', $data_attr, $id)){
                $attr = array('success_msg'=> 'Category update success', 'action'=>'This category update successfully', 'action_class'=>'message-confirm-success');
                   $this->session->set_userdata($attr);
            }else{
                $attr = array('error_msg'=> 'Update category error', 'action'=> 'Something wrong please try again', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
            }
        }else{
            $attr = array('error_msg'=> 'Add category error', 'action'=>validation_errors('<p>', '</p>'), 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
        }
        
       $data['categories']=$this->post_model->get_all_category($type);
        $data['category']=$this->post_model->get_category_by_id($id);
        $data['type']=$type;
        $data['id']=$id;
        $this->load->view('admin/posts/edit_category',$data);
    }
    
    /*Delete single post*/
    function delete_single_category($type, $id){
        if($this->db->delete('_category', array('id'=>$id))){
             $attr = array('success_msg'=> 'Category delete success', 'action'=>'This category delete successfully', 'action_class'=>'message-confirm-success');
            redirect('admin/posts/category/'.$type);
        }else{
             $attr = array('error_msg'=> 'Delete category error', 'action'=> 'Something wrong please try again', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
             redirect('admin/posts/category/'.$type);
        }
    }
    
    //post category delete all function delete  function ------------------------------------------------
	public function delete_all_category($type)
	{
        if($this->input->post('all_check')){
            foreach($this->input->post('all_check') as $id){
                  $this->db->delete('_category', array('id'=>$id));
            } 
            $attr = array('success_msg'=> 'Delete complete', 'action'=>'Your deletion successfully complete', 'action_class'=>'message-confirm-success');
            $this->session->set_userdata($attr);
            redirect('admin/posts/category/'.$type);
        }else{
            redirect('admin/posts/category/'.$type);
        }
       
	}
    
    
    /*category slug unique or not*/
    public function _is_unique_slug($str, $id=null){
        $result = $this->post_model->is_unique_category_slug($str, $id);
        if($result==false){
            $this->form_validation->set_message('_is_unique_slug', 'You need to define a unique slug for category');
            return false;
        }
        return true;
    }
    
}


