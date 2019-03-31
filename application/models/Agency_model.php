<?php
class Agency_model extends MY_Model{
    public function __construct(){
        parent:: __construct();
    }

   
    // this function for get all staff my pagination
     public function get_all_agency( $per_page=null, $page=null){
        $result=0;
        if($per_page!=null){
            $this->db->order_by("id", "DESC");
            $this->db->limit($per_page, $page);
        }
       $result = $this->db->get('agency');
        return $result->result();
        
    }
    
    
    /*This function for get all user count */
    public function get_agency_count(){
        $result=0;
        
        $result = $this->db->get('agency');
      
        return $result->num_rows();
        
    }

    /*This fnction for get one single user*/
    public function get_agency($id=null){
         $result = $this->db->get_where('agency', array('id'=>$id));
        return $result->row(0);
    }
    
    public function agency_name($id=null){
        $user = $this->get_agency($id);
        $user_name = 'No Agency';
        if($user){
            $user_name=$user->agency_name;
        }
        return $user_name;
    } 
    
    public function total_passport_count($agency_id){
        $query = $this->db->get_where('passport', array('agency_id'=>$agency_id));
        return $query->num_rows();
    }
    
    
}
?>