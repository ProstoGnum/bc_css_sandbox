<?php
class Fb_connect{
	
	public $CI;
	public $config;

    public function __construct(){
        $this->CI = &get_instance();

        $vars = get_cfg_var('aws.param5');
        $explode = explode(',', $vars);

        $app_id = '173070729494386';
        $secret = $explode[0];

        $this->config = array(
            'appId'  => $app_id,
            'secret' => $secret,
        );
        $this->CI->load->library('facebook-php-sdk/src/facebook', $this->config, 'facebook');
    }

	public function get_user_id(){
		return $this->CI->facebook->getUser();
	}
	
	public function get_login_url($redirect_uri = NULL){
        $params = array("scope" => array("email", "user_education_history"));
        if ($redirect_uri != NULL)
            $params['redirect_uri'] = base_url() . 'authentication/student/fb_login/' . $redirect_uri;

	  	return $this->CI->facebook->getLoginUrl($params);
	}
	
	public function get_user_info($user_id){
		if ($user_id):
  			try{
    			// Proceed knowing you have a logged in user who's authenticated.
			    $user_profile = $this->CI->facebook->api('/me');
				return $user_profile;
  			} catch (FacebookApiException $e) {
   			 	error_log($e);
    			$user_id = null;
				return False;
  			}
		endif;
	}
}



?>