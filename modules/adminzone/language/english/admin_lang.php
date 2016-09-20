	<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/*
	|--------------------------------------------------------------------------
	| Global
	|--------------------------------------------------------------------------
	*/
	$lang['activate']             	= "Record has been activated successfully.";
	$lang['deactivate']           	= "Record has been de-activated successfully.";
	$lang['deleted']              	= "Record has been deleted successfully.";
	$lang['successupdate']        	= "Record has been updated successfully.";
	$lang['order_updated']        	= "The Selected Record(s) has been re-ordered.";
	$lang['password_incorrect']   	= "The Old Password is incorrect";
	$lang['recordexits']         	= "Record address already exists.";
	$lang['success']              	= "Record added successfully.";
	$lang['paysuccess']           	= "Payment added successfully.";
	$lang['admin_logout_msg']     	= "Logout successfully ..";
	$lang['admin_mail_msg']      	= "Mail sent Successfully...";
	$lang['forgot_msg']           	= "Email Id does not exist in database";
	$lang['admin_reply_msg']      	= "Enquiry reply sent Successfully...";
	$lang['pic_uploaded']         	= 'Photos has been uploaded successfully.';
	$lang['pic_uploaded_err']	  	= 'Please upload at least one photo.';
	$lang['pic_delete']			  	= 'Photo has been deleted successfully.';
	$lang['child_to_deactivate']  	=  "The selected record(s) has some sub-category/product.Please de-activate them first";
	$lang['child_to_activate']   	=  "The selected record(s) has some sub-category/product.Please activate them first";
	$lang['child_to_delete']      	=  "The selected record(s) has some sub-category/product.Please delete them first";
	$lang['marked_paid']        	= "The selected record(s) has been marked as Paid";
	$lang['payment_succeeded']  	= "The payment has been made successfully.";
	$lang['payment_failed']     	= "The payment has been canceled.";
	$lang['email_sent']	     		= "The Email has been sent successfully to the selected Users/Members.";
	
	$lang['top_menu_list'] 						= array( "Dashboard"=>"adminzone/dashbord/",
		
		"Panel Management"  						=>array(		
			"Left Panel Ads"						=>"adminzone/left_panel/",
			"Top List Ads"							=>"adminzone/top_list",
			"Users Management"						=>"adminzone/users",
			),
		"Other Management"  						=>array(		
			"Country Management"					=>"adminzone/country/",
			//"Import Csv"							=>"adminzone/csv/importcsv",
			"City Management"						=>"adminzone/cities/", 
			"Static Pages"							=>"adminzone/staticpages/", 
			/*"Mail Contents"							=>"adminzone/mailcontents/",  
			"Enquiry/Feedback"						=>"adminzone/enquiry/",  
			"Manage  Meta Tags"						=>"adminzone/meta/",    */                     
			"Admin Settings"						=>"adminzone/setting/"                      
			),
		);		
	$lang['top_menu_icon']       				= array(
		"Other Management"		 					=>"management.png",
		"Panel Management"		 					=>"management.png",
		);			  
	/* Location: ./application/modules/adminzone/language/admin_lang.php */