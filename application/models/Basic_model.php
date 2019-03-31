<?php
class Basic_model extends CI_Model {

// this function for return everything from basic_settings tables
	public function basic_settings($selector)
	{
		$query = $this->db->get_where('basic_settings', array('selector' => $selector));

		foreach ($query->result() as $row)
			{
			    return $row->data;
			}
	}
	

// this function for return user name form
	public function user_display_name($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));

		foreach ($query->result() as $row)
			{
			    return $row->display_name;
			}
	}


// this function for return user name form
	public function user_profile_picture($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));

		foreach ($query->result() as $row)
			{
			    return $row->profile_picture;
			}
	}

// the category list for account
	public function the_account_category_list()
	{
		$query = $this->db->get('texconomy');
		return $query->result();
	}
	
// the category property by id 
	public function category_property($id)
	{
		$cat_name=null;
		$cat_type=null;
		$property=array();
		$query = $this->db->get_where('texconomy', array('id' => $id));
		foreach ($query->result() as $row){
			$cat_name= $row->name;
			$cat_type= $row->category_for;
		}
		return $property=array('cat_name'=>$cat_name, 'cat_type'=>$cat_type);
	}
	
	
// the category list for account
	public function recent_account_list()
	{
		$this->db->order_by("id", "DESC");
		$query = $this->db->get('accounts', 1000);
		return $query->result();
	}
	
	
//this function for update account category 
	public function update_category($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('texconomy', $data)){
			return 1;
		}else{
			return 0;
		}
	}
	
	
	//this function for category list by type
	function account_category_by_type($type){
		$list='';
		$query = $this->db->get_where('texconomy', array('category_for' => $type));
		foreach ($query->result() as $row){
			$list.='
				<option value="'.$row->id.'" >'.$row->name.'</option>
			';
		}
		return $list;
	}
	
	
	
// the function for all about account property 
	public function get_accouts_property($id)
	{
		$property=array();
		$query = $this->db->get_where('accounts', array('id' => $id));
		foreach ($query->result() as $row){
			$id= $row->id;
			$account= $row->account;
			$type= $row->type;
			$texconomy_id= $row->texconomy_id;
			$day= $row->day;
			$month= $row->month;
			$year= $row->year;
			$parpose= $row->parpose;
			$voucher= $row->voucher;
			$comment= $row->comment;
		}
		return $property=array('id'=>$id, 'account'=>$account, 'type'=>$type, 'texconomy_id'=>$texconomy_id, 'day'=>$day, 'month'=>$month, 'year'=>$year, 'parpose'=>$parpose, 'voucher'=>$voucher, 'comment'=>$comment);
	}
	
	
	
	
//this function for update account category 
	public function update_account($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('accounts', $data)){
			return 1;
		}else{
			return 0;
		}
	}
	
	
// the function for return total income 
	public function get_account($type)
	{
		$accounts=0;
		$query = $this->db->get_where('accounts', array('type' => $type));
		foreach ($query->result() as $row){
			$accounts=$accounts+$row->account;
		}
		return $accounts;
	}

	
// the function for return total income 
	public function get_this_month_account($type)
	{
		$accounts=0;
		$query = $this->db->get_where('accounts', array('type' => $type, 'month'=> date('m', time()), 'year'=>date('Y', time())));
		foreach ($query->result() as $row){
			$accounts=$accounts+$row->account;
		}
		return $accounts;
	}
	
// the function for return total income 
	public function get_this_month_account_list($type)
	{
		$list='';
		$query = $this->db->get_where('accounts', array('type' => $type, 'month'=> date('m', time()), 'year'=>date('Y', time())));
		foreach ($query->result() as $row){
			$category = $this->category_property($row->texconomy_id);
			$list.='
			<tr>
				<th scope="row">'.$row->day.'/'.$row->month.'/'.$row->year.'</th>
				<td> <i class="fa fa-gbp"> </i> '.$row->account.'</td>
				<td>'.$category['cat_name'].'</td>
				<td>'.$row->comment.'</td>
			  </tr>
			';
		}
		return $list;
	}
	
	

// this function for if habe users 
	public function if_hav_user($id){
		$query = $this->db->get_where('users', array('id'=>$id));
		if($query->num_rows() > 0){
			return true;
		}else{return false;}
	}

// this function for if have user name
	public function if_hav_user_name($user_name){
		$query = $this->db->get_where('users', array('user_name'=>$user_name));
		if($query->num_rows() > 0){
			return true;
		}else{return false;}
	}


// the category list for account
	public function users()
	{
		$this->db->order_by("id", "DESC");
		$query = $this->db->get('users');
		return $query->result();
	}
	
	
	
// the function for all about account property 
	public function get_users_property($id)
	{
		$property=array();
		$query = $this->db->get_where('users', array('id' => $id));
		foreach ($query->result() as $row){
			$id= $row->id;
			$user_name= $row->user_name;
			$email= $row->email;
			$first_name= $row->first_name;
			$last_name= $row->last_name;
			$nick_name= $row->nick_name;
			$display_name= $row->display_name;
			$profile_picture= $row->profile_picture;
			$role= $row->role;
		}
		return $property=array('id'=>$id, 'profile_picture'=>$profile_picture, 'email'=>$email, 'first_name'=>$first_name, 'last_name'=>$last_name, 'nick_name'=>$nick_name, 'display_name'=>$display_name, 'user_name'=>$user_name, 'role'=>$role);
	}
	
	
	//this function for update user data 
	public function update_user_data($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('users', $data)){
			return 1;
		}else{
			return 0;
		}
	}
	
	
	

// monthly account report
	public function get_this_month_account_report($type, $month=0, $year=0)
	{
		$list='';
		if($month){
			$month=$month;
		}else{
			$month=date('m', time());
		}
		if($year){
			$year=$year;
		}else{
			$year=date('Y', time());
		}
		$query = $this->db->get_where('accounts', array('type' => $type, 'month'=> $month, 'year'=> $year));
		foreach ($query->result() as $row){
			$list.='
			<tr>
				<th scope="row">'.$row->day.'/'.$row->month.'/'.$row->year.'</th>
				<td> <i class="fa fa-gbp"> </i> '.$row->account.'</td>
				<td>'.$row->parpose.'</td>
				<td>'.$row->voucher.'</td>
				<td>'.$row->comment.'</td>
				<td>
					<a class="btn btn-default btn-xs" href="'. base_url().'admin/account/add_account/'.$row->id.'"><i class="fa fa-edit"> </i> Edit</a>
							<a style="" href="" class="btn btn-danger btn-xs" data-href="'.base_url().'admin/account/delete_account/'.$row->id.'" data-toggle="modal" data-target="#confirm-delete"><i class="fa-times fa"> </i> Delete</a>
				</td>
			  </tr>
			';
		}
		return $list;
	}
	
	
	
// the function for return total income 
	public function get_report_full_month($type, $month=0, $year=0)
	{
		if($month){
			$month=$month;
		}else{
			$month=date('m', time());
		}
		if($year){
			$year=$year;
		}else{
			$year=date('Y', time());
		}
		
		$accounts=0;
		$query = $this->db->get_where('accounts', array('type' => $type, 'month'=> $month, 'year'=> $year));
		foreach ($query->result() as $row){
			$accounts=$accounts+$row->account;
		}
		return $accounts;
	}
	
	

// monthly account report
	public function get_this_month_account_report_pdf($type, $month, $year)
	{
		$list='';
		$content='';
		if($month){
			$month=$month;
		}else{
			$month=date('m', time());
		}
		if($year){
			$year=$year;
		}else{
			$year=date('Y', time());
		}
		$query = $this->db->get_where('accounts', array('type' => $type, 'month'=> $month, 'year'=> $year));
		foreach ($query->result() as $row){
			$category = $this->category_property($row->texconomy_id);
			$list.='
			<tr>
				<th scope="row">'.$row->day.'/'.$row->month.'/'.$row->year.'</th>
				<td>  '.$row->account.' TK.</td>
				<td>  '.$category['cat_name'].'</td>
				<td>  '.$row->parpose.'</td>
				<td>  '.$row->voucher.'</td>
				<td>  '.$row->comment.'</td>
			  </tr>
			';
		}
		
		$content='
		  <table class="table table-bordered" border="1" cellpadding="3">
			<thead>
			  <tr style="background-color:#000;color:#FFF">
				<th>  Date</th>
				<th>  Amount</th>
				<th>  Category</th>
				<th>  Parpose</th>
				<th>  Voucher</th>
				<th>  Comment</th>
			  </tr>
			</thead>
			<tbody>
			  '.$list.'
			</tbody>
		  </table>
		';
		return $content;
	}
	
    
    
    
    //total income
    public function total_amount($type){
       $query= $this->db->query("SELECT SUM(account) FROM accounts WHERE type='$type'");
        $result = $query->result_array();
        return $result[0]["SUM(account)"];
    }
}