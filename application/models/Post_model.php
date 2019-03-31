<?php
class Post_Model extends MY_Model{
	function __construct(){
        parent::__construct();
    }
	
    
    /*This cunation for get all post type*/
    
     public function get_all_post($type=null, $status=null, $per_page=null, $page=null){
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "DESC");
            $this->db->limit($per_page, $page);
        }
         if ($status==null){
            $result = $this->db->get('_posts', array('post_type'=>$type));
        }else{
            $result = $this->db->get_where('_posts', array('post_type'=>$type, 'post_status'=>$status));
        }
        return $result->result();
        
    }
    
    
    /*get post count*/
    public function get_post_count($type=null, $status=null){
        $result=0;
        
        if ($status==null){
            $result = $this->db->get('_posts', array('post_type'=>$type));
        }else{
            $result = $this->db->get_where('_posts', array('post_type'=>$type, 'post_status'=>$status));
        }
        return $result->num_rows();
        
    }
    
    public function get_post($id){
        $result=0;
        $result = $this->db->get_where('_posts', array('id'=>$id));
        return $result=$result->result();
        
    }
    
    
    /*get all category--------------------------------------------------------------------------------------*/
    public function get_all_category($type){
        $result = $this->db->get_where('_category', array('category_post_type'=>$type));
        return $result->result();
    }
    public function get_category_by_id($id){
        $result = $this->db->get_where('_category', array('id'=>$id));
        return $result->result();
    }
    
    /*This function for update category*/
    public function update_category($table, $data, $id){
        $this->db->where('id', $id);
        if( $this->db->update($table, $data)){
            return true;
        }else{return false;}
    }
    
    
    
    /*This function for category url converter */
    public function url_converter($str){
        $data=$str;
        $data= ltrim($data);
        $data= rtrim($data);
        $data= explode(' ', $data);
        $data= implode('-', $data);
        return $data;
    }
    
    /*This function for check uniqe category slugs*/
    //this function for select uniq email 
    public function is_unique_category_slug($str, $id=null){
        $str= $this->url_converter($str);
        if($id!=null){
           $query = $this->db->query("SELECT * from _category WHERE category_slug='$str' AND id!='$id'");
        }else{
             $query = $this->db->query("SELECT * from _category WHERE category_slug='$str'");
        }
      
        if($query->result()){
            return false;
        }else{
            return true;
        }
    }
    
    public function is_unique_post_slug($post_slug, $id=null){
        if($id!=null){
            $query = $this->db->query("SELECT * from _posts WHERE post_slug='$post_slug' AND id!='$id'");
        }else{
            $query = $this->db->query("SELECT * from _posts WHERE post_slug='$post_slug'");
        }
        if($query->result()){
            return false;
        }else{
            return true;
        }
    }
    

}
?>