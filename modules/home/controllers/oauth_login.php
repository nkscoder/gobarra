

<?php

class Oauth_Login extends CI_Controller {

public $user = "";

public function __construct() {
parent::__construct();

// Load facebook library and pass associative array which contains appId and secret key
$this->load->library('facebook', array('appId' => '422534937934457', 'secret' => '610cd9d78ea0a911e2800f85ecf13e7a','email'));

// Get user's login information
$this->user = $this->facebook->getUser();
print_r($this->user); 
}

// Store user information and send to profile page
public function index() {
if ($this->user) {
$data['user_profile'] = $this->facebook->api('/me/');

// Get logout url of facebook
$data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'oauth_login/logout'));

// Send data to profile page
$this->load->view('profile', $data);
} else {

// Store users facebook login url
$data['login_url'] = $this->facebook->getLoginUrl();
$this->load->view('login', $data);
}
}

// Logout from facebook
public function logout() {

// Destroy session
session_destroy();

// Redirect to baseurl
redirect(base_url());
}

}
?>

