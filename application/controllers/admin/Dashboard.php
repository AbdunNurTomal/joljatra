<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('basic_model');
        $this->load->model('staff_model');
        
    }
	public function index()
	{
        $data['total_booking_room_count'] = 100;
        
         $data['total_income']= $this->basic_model->total_amount('income');
         $data['total_expanse']= $this->basic_model->total_amount('expenditure');
         $data['total_prfit']=$data['total_income']-$data['total_expanse'];
		 $this->load->view('admin/dashboard', $data);
	}
    
    
    public function backup_db(){
        $prefs = array(
        'ignore'        => array(),                     // List of tables to omit from the backup
        'format'        => 'txt',                       // gzip, zip, txt
        'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
        'newline'       => "\n"                         // Newline character used in backup file
        );
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup =& $this->dbutil->backup($prefs); 

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('application/cache/db/joljatra_database_backup_'.date('d_m_Y').'_.sql', $backup); 

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('joljatra_database_backup_'.date('d_m_Y').'_.sql', $backup); 
    }
    
    public function clr_cache(){
        $path='application/cache/db/';
        $this->load->helper("file"); // load the helper
        delete_files($path, true, false, 1); // delete all files/folders
        
        if (!is_dir($path)) {
            mkdir($path, 0777, TRUE);
            $this->session->set_userdata('success_msg', 'Cache data deleted');
        }else{
             $this->session->set_userdata('error_msg', 'Something wrong please try again');
        }
        redirect('admin/dashboard');
    }
    
    
    
}

