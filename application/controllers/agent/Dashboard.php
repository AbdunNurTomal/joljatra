<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Agent_Controller{
    public function __construct(){
        parent::__construct();
        
    }
	public function index()
	{
        
        
		$this->load->view('agent/dashboard');
	}
    
    
    
    public function count_referals(){
        
        $arr=array(1);
        foreach($arr as $single){
            $arr[]=$single+1;
            
            if($single==100){break;}
        }
        var_dump($arr);
        
    }
    
    
    
    
    public function getalldownlines()
        {
            $sqlcmd = "SELECT UserID FROM table";

            // fill array $arr with data from SQL

            foreach ($id as $arr)
            {
                $count = get_all($id);
                $numreferreds[$id] = $count;
            }
        }
    public function get_all($referred=27)
            {
                $referred = $this->db->query("SELECT referredby FROM table WHERE UserId='$id'");

                $count = 0;

                // fill array $arr with data from SQL

                foreach ($referred as $arr)
                {
                    $count += get_all($referred);
                }

                return $count;
            }
    
    
    
    
}

