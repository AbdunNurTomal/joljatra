<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sms{
    
    function __construct() {
        $CI = get_instance();
        $CI->load->model('user_model');
        //$this->load->model('setting_model');
        
        $this->sms_senderid = $CI->user_model->get_setting_data('engineer_bd_sms_sender_id');
        $this->sms_apikey = $CI->user_model->get_setting_data('engineer_bd_sms_api_key');
        $this->sms_type = 'unicode';
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
    
    public function send2($to, $text){
        $to_new = $this->bntoen($to);
        $username="masum3 ";
        $password="habiba9547 ";
        $auth =base64_encode($username.":".$password);
        $curl = curl_init();
        $send_array = array(
          CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{ \"from\":\"zpsylhet\", \"to\":\"".$to_new."\", \"text\":\"".$text."\" }",
          CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: Basic ".$auth,
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
          return $response;
        }
        
    }//This is end of function
    
    
      public function bntoen($number){
        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", 'দিন', 'দিন', 'দিন', 'দিন', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', 'ঘন্টা', "মিনিট", "মিনিট", "মিনিট", "মিনিট");
        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "day", "Day", "days", "Days", "Hour", "hour", "Hours", "hours", "Minute", "minitue", "Minitues", "minitues");
        $en_number = str_replace( $search_array, $replace_array, $number);
        $en_number = rtrim($en_number, 's');
        return $en_number;
    }

    
}//This end of class

