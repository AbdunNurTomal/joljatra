<?php
class Basic_model extends CI_Model {

// this function for return everything from basic_settings tables
	public function get_setting_data($selector)
	{
		$query = $this->db->get_where('setting', array('data_id' => $selector));
        if($query){return $query->row(0);}else{return false;}
	}
	

}