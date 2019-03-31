<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map{
    function __construct() {
        $CI = get_instance();
        $CI->load->model('user_model');
        
        $this->google_map_created_id = $CI->user_model->get_setting_data('google_map_created_id');
        $this->google_map_api_key = $CI->user_model->get_setting_data('google_map_api_key');
    }
    
    
    
    // this function for sms send 
    public function send($to_contacts, $msg){
        
        $data = json_encode(array(
            "api_key"  => $this->sms_apikey,
            "type" =>  $this->sms_type,
            "contacts" => $to_contacts,
            "senderid" => $this->sms_senderid,
            "msg" => $msg
        ));
        
       
        $curl = curl_init();
        $send_array = array(
          CURLOPT_URL => "http://bulk.engineerbd.net/smsapi",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "content-type: application/json"
          ),
        );
        curl_setopt_array($curl, $send_array);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return  $err;
        } else {
          return  $response;
        }
        
    }//This is end of function
	
}
?>