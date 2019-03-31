<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MultiLanguageSwitcher extends CI_Controller{
	
	public function __construct() {
		parent::__construct();     
	}
	
	//public function index(){
	//	$this->load->view('frontend/landing');
	//}
	
	// create language Switcher method
	function language_switch($language = "") {        
		$language = ($language != "") ? $language : "en";
		$this->session->set_userdata('site_lang', $language);     
//echo $_SERVER['HTTP_REFERER'];exit;
		redirect($_SERVER['HTTP_REFERER']);        
	}
}
?>