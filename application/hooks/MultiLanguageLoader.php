<?php
class MultiLanguageLoader{
	
	function initialize() {
		$ci =& get_instance();
		
		$ci->load->helper('language');
		$siteLang = $ci->session->userdata('site_lang');
		if($siteLang) {
			$ci->lang->load('frontend',$siteLang);
			$ci->lang->load('cabin',$siteLang);
			$ci->lang->load('contact',$siteLang);
		}else{
			$ci->lang->load('frontend','en');
			$ci->lang->load('cabin','en');
			$ci->lang->load('contact','en');
		}
	}
}
?>