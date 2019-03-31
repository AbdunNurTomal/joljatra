<?php
class Front_model extends CI_Model {
    public function __construct(){
        parent:: __construct();
        $this->user_type = $this->session->userdata('current_user_type');
        $this->user_id = $this->session->userdata('current_user_id');
        
    }
    // this function for change number
    public function entobn($number){
        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", 'দিন', 'দিন', 'দিন', 'দিন', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', "মিনিট", "মিনিট", "মিনিট", "মিনিট");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "day", "Day", "days", "Days", "Hour", "hour", "Hours", "hours", "Minute", "minitue", "Minitues", "minitues");
        $en_number = str_replace( $replace_array, $search_array, $number);
        $en_number = rtrim($en_number, 's');

        return $en_number;
    }
    
    
    /// this function for load all post function by type 
    
     public function get_all_post($type=null, $status=null, $per_page=null, $page=null){
        $result=0;
        $this->db->order_by("id", "DESC");
        if($per_page!=null){
            $this->db->limit($per_page, $page);
        }
         if ($status==null){
            $result = $this->db->get_where('_posts', array('post_type'=>$type));
        }else{
            $result = $this->db->get_where('_posts', array('post_type'=>$type, 'post_status'=>$status));
        }
        return $result->result();
        
    }
 
    /*this function for thumbnail src*/
    
    public function thumbnail_src($id, $thumbnail_id, $main_image=false){
            $thumbnail = config_item('thumbnails');
            $thumbnail = $thumbnail[$thumbnail_id];
            $thumbnail = '-'.implode($thumbnail, 'X');
            $result=null;
            $result = $this->db->get_where('_attachment', array("id"=>$id));
            if($result){
                $thumb_data = $result->row(0);
                if($main_image == true ){
                    return config_item('upload_dir').'/'.$thumb_data->attachmen_directory.'/'.$thumb_data->attachment_name.$thumb_data->attachment_format;
                }else{
                    return config_item('upload_dir').'/'.$thumb_data->attachmen_directory.'/thumbnails/'.$thumb_data->attachment_name.$thumbnail.$thumb_data->attachment_format;
                }
            }else{
                return null;
            }
            
    }
    

}