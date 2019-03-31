<?PHP
/*
	Author: Walletmix Ltd.
	Version: 2.5.4.17
	Title: Walletmix Payment Gateway Integration (Class)
	Email: support@walletmix.com

*/
CLASS WALLETMIX {

    PRIVATE $service_access_username;
    PRIVATE $service_access_password;
    PRIVATE $merchant_id;
    PRIVATE $access_app_key;
    PRIVATE $shipping_charge;
    PRIVATE $discount;
    PRIVATE $merchant_order_id;
    PRIVATE $app_name;
    PRIVATE $callback_url;
    PRIVATE $currency;
    PRIVATE $transaction_related_params = array();
    PRIVATE $extra_data;
    PRIVATE $product_description;
    PRIVATE $amount;
    PRIVATE $server_details_url;
    PRIVATE $check_payment_url;
    PRIVATE $database_driver;

    PUBLIC FUNCTION walletmix($service_access_username, $service_access_password, $merchant_id, $access_app_key) {
        $this->service_access_username = $service_access_username;
        $this->service_access_password = $service_access_password;
        $this->merchant_id = $merchant_id;
        $this->access_app_key = $access_app_key;
        $this->amount = 0;
        $this->product_description = '';
        $this->server_details_url = 'https://epay.walletmix.com/check-server';
        $this->check_payment_url = 'https://epay.walletmix.com/check-payment';
    }
    PUBLIC FUNCTION set_shipping_charge($shipping_charge) {
        $this->shipping_charge = $shipping_charge;
    }
    PUBLIC FUNCTION set_discount($discount) {
        $this->discount = $discount;
    }
    PUBLIC FUNCTION set_product_description($products) {
        $quantity = 0;
        foreach($products as $product) {
            $price = $product['price'];
            $total_price = $product['quantity']*$price;
            $this->product_description .= '{'.$product['quantity'] . 'x' . $product['name'] . '['.$price.']=['.$total_price.']}+';
            $quantity += $product['quantity'];
            $this->amount += $total_price;
        }
        $this->amount = $this->amount+$this->shipping_charge-$this->discount;
        $this->product_description.='{shipping rate:'.$this->shipping_charge.'}-{discount amount:'.$this->discount.'}='.number_format( $this->amount, 2, '.', '' );

        return $this->product_description;
    }
    PUBLIC FUNCTION set_merchant_order_id($merchant_order_id) {
        $this->merchant_order_id = $merchant_order_id;
    }
    PUBLIC FUNCTION set_app_name($app_name) {
        $this->app_name = $app_name;
    }
    PUBLIC FUNCTION set_currency($currency) {
        $this->currency = $currency;
    }
    PUBLIC FUNCTION set_callback_url($url) {
        $this->callback_url = $url;
    }
    PUBLIC FUNCTION set_extra_json($extra_data) {
        $this->extra_data = json_encode($extra_data);
    }
    PUBLIC FUNCTION get_auth() {
        $encodeValue = base64_encode($this->service_access_username.':'.$this->service_access_password);
        $auth = 'Basic '.$encodeValue;
        return $auth;
    }
    PUBLIC FUNCTION get_options_value() {
        $options  = base64_encode('s='.$_SERVER['HTTP_HOST'].',i='.$_SERVER['SERVER_ADDR']);
        return $options;
    }
    PUBLIC FUNCTION get_cart_info() {
        $cart_info = $this->merchant_id.','.$_SERVER['HTTP_HOST'].','.$this->app_name;
        return $cart_info;
    }
    PUBLIC FUNCTION get_product_description() {
        return $this->product_description;
    }
    PUBLIC FUNCTION get_extra_json() {
        return $this->extra_data;
    }
    PUBLIC FUNCTION set_transaction_related_params($data) {
        $this->transaction_related_params['wmx_id'] = $this->merchant_id;
        $this->transaction_related_params['app_name'] = $this->app_name;
        $this->transaction_related_params['access_app_key'] = $this->access_app_key;
        $this->transaction_related_params['authorization'] = self::get_auth();
        $this->transaction_related_params['options'] = self::get_options_value();
        $this->transaction_related_params['callback_url'] = $this->callback_url;
        $this->transaction_related_params['currency'] = $this->currency;
        $this->transaction_related_params['merchant_order_id'] = $this->merchant_order_id;
        $this->transaction_related_params['merchant_ref_id'] = uniqid();
        $this->transaction_related_params['amount'] = $this->amount;
        $this->transaction_related_params['cart_info'] = self::get_cart_info();
        $this->transaction_related_params['product_desc'] = self::get_product_description();
        $this->transaction_related_params['extra_json'] = self::get_extra_json();
        foreach($data as $key=>$value){
            $this->transaction_related_params[$key] = $value;
        }
        return $this->transaction_related_params;
    }
    PUBLIC FUNCTION send_data_to_walletmix() {
        $getServerDetails = json_decode(self::curl_request_get($this->server_details_url));
        
        if($getServerDetails->selectedServer){
            $wmx_response = self::curl_request_post($getServerDetails->url,$this->transaction_related_params);
            $wmx_response_d = json_decode($wmx_response);

            if($wmx_response_d->statusCode === '1000'){

                $data = array('wmx_id'=>$this->merchant_id, 'authorization'=>self::get_auth(),'access_app_key'=>$this->access_app_key,'token'=>$wmx_response_d->token,'amount'=>$this->amount);

                if($this->database_driver == 'txt'){
                    self::write_file($data);
                }elseif($this->database_driver == 'session'){
                    self::reset_ression('wmx_token');
                    self::reset_ression('amount');

                    self::put_session('wmx_token',$wmx_response_d->token);
                    self::put_session('amount',$this->amount);
                }
                $wmx_url = $getServerDetails->bank_payment_url."/".$wmx_response_d->token;
                header("Location:".$wmx_url);
                exit;
            }else{
                echo $wmx_response;
            }
        }else{
            echo 'Server Two Temporary Down. Please Try After Sometime.';
        }
    }
	
	PUBLIC FUNCTION curl_request_get($url) {
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false); 
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	
    PUBLIC FUNCTION curl_request_post($url,$params) {
        $postData = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        curl_setopt($ch,CURLOPT_POST, count($postData));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    PUBLIC FUNCTION write_file($data) {
        $file_name = fopen("data.txt", "w") or die("Unable to open file!");
        $data = json_encode($data);
        fwrite($file_name, $data);
        fclose($file_name);
    }
    PUBLIC FUNCTION check_payment($params) {
        $wmx_response = self::curl_request_post($this->check_payment_url,$params);
        return $wmx_response;
    }
    PUBLIC FUNCTION read_file() {
        $file_name = fopen("data.txt", "r") or die("Unable to open file!");
        $data =  fread($file_name,filesize("data.txt"));
        fclose($file_name);
        return $data;
    }
    PUBLIC FUNCTION read_data() {
        $data = array(
            'wmx_id'		=>	$this->merchant_id,
            'authorization'	=>	self::get_auth(),
            'access_app_key'=>	$this->access_app_key,
            'token'			=>	self::get_session('wmx_token'),
            'amount'		=>	self::get_session('amount')
        );
        return json_encode($data);
    }

    PUBLIC FUNCTION put_session($key,$value){
        $_SESSION[$key] = $value;
    }
    PUBLIC FUNCTION set_database_driver($option){
        if($option == 'session'){
            self::start_session();
        }
        $this->database_driver = $option;
    }
    PUBLIC FUNCTION get_database_driver(){
        return $this->database_driver;
    }
    PUBLIC FUNCTION get_session($key){
        return $_SESSION[$key];
    }
    PUBLIC FUNCTION start_session(){
        if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    }
    PUBLIC FUNCTION reset_ression($key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }
    PUBLIC FUNCTION debug($data,$die = false) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if($die){die();}
    }


}
?>