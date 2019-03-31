<?php
class Attachment_Model extends MY_Model{
	function __construct(){
        parent::__construct();
    }
	
    
    /*This cunation for get all post type*/
    
     public function get_all_attachment($per_page=null, $page=null){
         
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "DESC");
            $this->db->limit($per_page, $page);
        }
         
         $result = $this->db->get('_attachment');
         return $result->result(); 
    }
    
    /*get attachemtn count*/
    public function get_attachment_count(){
        $result=0;
        $result = $this->db->get('_attachment');
        return $result->num_rows();
        
    }
    
    /*get attachment src*/
    public function attachment_src($id=null){
        if($id==null){
            return null;
        }
        else{
            $result=0;
            $this->db->where("id", $id);
            $result = $this->db->get('_attachment');
            $result->result();
            return config_item('upload_dir').'/'.$result->row()->attachmen_directory.'/'.$result->row()->attachment_name.$result->row()->attachment_format;
        }
    }
    
    public function thumbnail_src($id, $thumbnail_id){
            $thumbnail = config_item('thumbnails');
            $thumbnail = $thumbnail[$thumbnail_id];
            $thumbnail = '-'.implode($thumbnail, 'X');
            $result=0;
            $this->db->where("id", $id);
            $result = $this->db->get('_attachment');
            $result->result();
            return config_item('upload_dir').'/'.$result->row()->attachmen_directory.'/thumbnails/'.$result->row()->attachment_name.$thumbnail.$result->row()->attachment_format;
    }
    
    public function if_this_thumb_used_any_post($id){
        $result = $this->db->query("SELECT * FROM _posts WHERE thumbnail ='$id'");
        
        if($result->num_rows() > 0){return true;}else{return false;}
    }
    
}
?>