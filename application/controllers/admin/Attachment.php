<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*Thumbnail image size generation*/

class Attachment extends Admin_Controller {
    
    function __construct(){
		parent:: __construct();
        $this->load->model('attachment_model');
	}
    
    //user index function---------------------------------------------------
	public function index()
	{
        redirect('admin/attachment/all');
	}
    
    /*display all post*/
    function all($current_page=null){
         $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/attachment/all/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->attachment_model->get_attachment_count();
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
        $data['attachments']=$this->attachment_model->get_all_attachment( $config['per_page'],  $current_page);
        
        $this->load->view('admin/attachment/all_attachment', $data);
    }
    
    
    /*This function for upload an image and add new attachment*/
    public function add_new(){
        $this->load->view('admin/attachment/new');
    }
    
    
    /*This functin for upload action*/
    public function upload(){
        if($file_name = $this->do_upload()){
           
            $attr = array('action_title'=> 'Upload success', 'action'=>'Your upload successfull.', 'action_class'=>'message-confirm-success');
               $this->session->set_userdata($attr);
                $file_part = explode('.', $file_name);
                $prev_name = $file_part[count($file_part)-2];
                $type = $file_part[count($file_part)-1];
                $attr=array(
                    'attachmen_directory'=>date('Y/m', time()),
                    'attachment_name'=>$prev_name,
                    'attachment_format'=>'.'.$type,
                    'attachment_caption'=>$prev_name,
                    'attachment_title'=>$prev_name
                );
                $this->db->insert('_attachment', $attr);
                redirect('admin/attachment/all');
        }else{
             $attr = array('action_title'=> 'Upload Error', 'action'=>'Something wrong please try again. Remember Only Imge applicable', 'action_class'=>'message-confirm-danger');
            $this->session->set_userdata($attr);
            redirect('admin/attachment/add_new');
        }
    }
    
    
    /*This functin for upload action*/
    public function ajax_upload(){
        if($file_name = $this->do_upload()){
            $attr = array('action_title'=> 'Upload success', 'action'=>'Your upload successfull.', 'action_class'=>'message-confirm-success');
               $this->session->set_userdata($attr);
                $file_part = explode('.', $file_name);
                $prev_name = $file_part[count($file_part)-2];
                $type = $file_part[count($file_part)-1];
                $attr=array(
                    'attachmen_directory'=>date('Y/m', time()),
                    'attachment_name'=>$prev_name,
                    'attachment_format'=>'.'.$type,
                    'attachment_caption'=>$prev_name,
                    'attachment_title'=>$prev_name
                );
                $this->db->insert('_attachment', $attr);
        }else{
             echo'File upload error';
        }
    }
    
    
    /*
    ================================================================================================================
                        FILE UPLOADING FUNCTION
    ================================================================================================================
    
    */
    
    function do_upload(){
            if (!file_exists(config_item('upload_dir').'/'.date('Y/m', time()).'/thumbnails/')) {
                mkdir(config_item('upload_dir').'/'.date('Y/m', time()).'/thumbnails/', 0777, true);
            }
            $upload_dir = './'.config_item('upload_dir').'/'.date('Y/m', time()).'/';
			$file_name = $_FILES['uploadImage']['name'];
            $type = explode('.', $file_name);
            $type = $type[count($type)-1];
            $file_name= $this->file_new_name($upload_dir, $file_name);
            
			if( in_array($type, array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF' )) ){

					if( is_uploaded_file( $_FILES['uploadImage']['tmp_name'] ) ){

					move_uploaded_file( $_FILES['uploadImage']['tmp_name'], $upload_dir.$file_name );
                    /*This function for thumbnail generation*/
                    foreach(config_item('thumbnails') as $thumb_size){
                        copy( $upload_dir.$file_name, $upload_dir.'thumbnails/'.$file_name);
                        $thumbnail = '-'.implode($thumb_size, 'X');
                        $file_array = explode('.', $file_name);
                        $thumb_name = $file_array[count($file_array)-2];
                        $thumb_type = $file_array[count($file_array)-1];
                        $thumb_file_name = $thumb_name.$thumbnail.'.'.$thumb_type;
                        if(rename($upload_dir.'thumbnails/'.$file_name, $upload_dir.'thumbnails/'.$thumb_file_name)){
                           $this->img_resize($upload_dir.'thumbnails/'.$thumb_file_name, $thumb_size[0], $thumb_size[1]); 
                        }
                        
                    }
					return $file_name;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
    
    
    /*This function fore freate file new unique name*/
    public function file_new_name($dir, $file_name){
        $new_name='';
        if(file_exists($dir.$file_name)){
            for($i=2;$i>=1;$i++){
                $file_part = explode('.', $file_name);
                $prev_name = $file_part[count($file_part)-2];
                $type = $file_part[count($file_part)-1];
                $new_name = time().'-'.$i.'.'.$type;
                if(!file_exists($dir.$new_name)){
                    break;
                }
            }
            return $new_name;
        }else{
             $file_part = explode('.', $file_name);
            $prev_name = $file_part[count($file_part)-2];
            $type = $file_part[count($file_part)-1];
            $file_name = time().'-1.'.$type;
            return $file_name;
        }
    }
    
    /*This function for image resize*/
    public function img_resize($path, $width, $height){
        $config1=array();
        $config1['image_library'] = 'gd2';
        $config1['source_image'] = $path;
        $config1['create_thumb'] = FALSE;
        $config1['maintain_ratio'] = false;
        $config1['width']         = $width;
        $config1['height']       = $height;
        $this->load->library('image_lib', $config1);
        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
    }
     /*
    ================================================================================================================
                        FILE UPLOADING FUNCTION END
    ================================================================================================================
    
    */

    
    /*This function for delete single attachment--------------------------------------------------------------*/
    public function delete($id=null){
        
        if($this->attachment_model->if_this_thumb_used_any_post($id)==false){
            $this->delete_attachment_files($id);
            if($this->db->delete('_attachment', array('id'=>$id))){
                 $attr = array('action_title'=> 'Deletion success', 'action'=>'Your deletion successfull.', 'action_class'=>'message-confirm-success');
                   $this->session->set_userdata($attr);
                   redirect('admin/attachment/all');
            }else{
                $attr = array('action_title'=> 'Deletion Error', 'action'=>'Something wrong please try again.', 'action_class'=>'message-confirm-danger');
                $this->session->set_userdata($attr);
                redirect('admin/attachment/all');
            }
       }else{ redirect('admin/attachment/all');}
       
        
    }
    
    
    
    /*Function for delete all attachment files*/
    
    public function delete_attachment_files($id){
        $files = array($this->attachment_model->attachment_src($id));
        foreach(config_item('thumbnails') as $thumbnail_id=>$value){
            $file = $this->attachment_model->thumbnail_src($id, $thumbnail_id);
            array_push($files, $file);
        }
        foreach($files as $file){
            if(file_exists($file)){
                unlink($file);
            }
        }
    }
    
    
    
     //user user delete  function ------------------------------------------------
	public function delete_all()
	{
        if($this->input->post('all_check')){
            foreach($this->input->post('all_check') as $id){
                if($this->attachment_model->if_this_thumb_used_any_post($id)==false){
                    $this->delete_attachment_files($id);
                    $this->db->delete('_attachment', array('id'=>$id));
                }
            } 
            $attr = array('action_title'=> 'Delete complete', 'action'=>'Your deletion successfully complete', 'action_class'=>'message-confirm-success');
            $this->session->set_userdata($attr);
            redirect('admin/attachment/all');
        }else{
            redirect('admin/attachment/all');
        }
       
	}
    
    
    /*This function for display thikbox*/
/*
======================================================================================================================
                        DISPLAY THIKBOX
======================================================================================================================
*/
    
   public function thikbox($current_page=null){
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/attachment/thikbox/';
        $config['use_page_numbers'] = FALSE;
        $config['total_rows'] = $this->attachment_model->get_attachment_count();
		$config['per_page'] = 18;
        $config['full_tag_open'] = '<ul style="margin: 0;" class="pagination pagination-sm thikbox-magination">';
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
        $data['attachments']=$this->attachment_model->get_all_attachment( $config['per_page'],  $current_page);
       
        $this->load->view('admin/attachment/thikbox', $data);
   }
    
    /*This function for attachment image by id*/
    
    public function get_thumb($id=null, $att_id=null){
        if($id==null or $att_id==null){
            echo '';
        }else{
            echo base_url().$this->attachment_model->thumbnail_src($id, $att_id);
        }
    }
}


