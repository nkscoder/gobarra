<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$config['bottom.debug'] = 0;
$config['site.status']	= '1';
$config['site_name']	= 'gobarra.com';

$config['auth.password_min_length']	= '6';
$config['auth.password_force_numbers']	= '0';
$config['auth.password_force_symbols']	= '0';
$config['auth.password_force_mixed_case']	= '0';

$config['allow.imgage.dimension']	= '3000x3000';
$config['allow.file.size']	        = '2048'; //In KB

$config['allow_discount_option'] = 1;

$config['Year: %Y Month: %m Day: %d - %h:%i %a']	= date_default_timezone_set('Asia/Kolkata');
$config['Year: %Y Month: %m Day: %d ']	    = date_default_timezone_set('Asia/Kolkata');

$config['analytics_id']	    = '';

$config['no_record_found'] = "No record(s) Found !";

$config['product_set_as_config'] = array(''=>"Product Set As",
//'hot_product'=>'Hot product',
'featured_product'=>'Featured Product',
'new_arrival'=>'New arrival');


$config['product_unset_as_config']	= array(''=>"Product Unset As",
//'hot_product'=>'Hot product',
'featured_product'=>'Featured Product',
'new_arrival'=>'New arrival');

$config['user_title'] =  array(""=>"Select","Mr."=>"Mr.","Miss."=>"Miss.");


$config['login_invalid']            = "Invalid Username/Password. ";

$config['register_thanks']            = "Thanks for registering with <site_name>. We look forward to serving you. ";

$config['register_thanks_activate']   = "Thanks for registering with <website name>.Please Check your mail account to activate your account on the <website name>. ";


$config['enquiry_success']              = "Your enquiry has been submitted successfully.We will revert back to you soon.";
$config['feedback_success']             = "Your Feedback has been submitted successfully.We will revert back to you soon.";
$config['product_enquiry_success']      = "Your product enquiry  has been submitted successfully.We will revert back to you soon.";
$config['product_referred_success']     = "This product has been referred to your friend successfully.";
$config['site_referred_success']        = "Site has been referred to your friend successfully.";
$config['forgot_password_success']      = "Your password has been send to your email address.Please check your email account.";

$config['exists_user_id']              = "Email id  already exists. Please use different email id.";
$config['email_not_exist']             = "Email id does not exist.";