<?php
include_once("config.php");
/*include_once("includes/functions.php");*/
//destroy facebook session if user clicks reset


if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
	$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}else{
	$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
       /* echo "<pre>";
	      print_r($user_profile); 
        echo "</pre>";*/

      /*  $picture=var_dump(array_value_recursive('url' ,$user_profile));*/

       /* echo $picture;*/

          
       
         /* 
          $data = array('email' => $user->email,
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);*/

        /*$conn = new mysqli('localhost', 'nitesh', 'q1w2e3r4', 'gobart4z_gobarra');

        if($conn){*/
            /*echo "string";*/
             $id=$user_profile['id'];
             $first_name=$user_profile['first_name'];
             $last_name=$user_profile['last_name'];
             $gender=$user_profile['gender'];
             $email=$user_profile['email'];
             session_start();

         $_SESSION['id'] =$id;
         $_SESSION['first_name'] =$first_name;
         $_SESSION['last_name'] =$last_name;
         $_SESSION['gender'] =$gender;
         $_SESSION['email'] = $email;
         $_SESSION['picture']=$user_profile['picture']['data']['url'];
         
        


       /*  $newUR="http://localhost/gobarra/home/facebook_login_do/";*/

         header("Location: https://gobarra.com/home/facebook_login_do/");
         exit();
      /*echo base_url();*/
         /*echo  $_SESSION["email"];*/
        /*$query=mysqli_query($conn,INSERT INTO `tbl_users`(`google_user_id`, `first_name`, `last_name`,  `gender`, `email`) VALUES ($user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['gender'],$user_profile['email']));
*/
         /* $sql=mysqli_query($conn,$query);*/


      /*  } */ /*die;*/


       /*$sql = "INSERT INTO tbl_users (google_user_id, first_name, last_name,email)
VALUES ($user_profile['id'], $user_profile['first_name'], $user_profile['last_name'],$user_profile['email'])";*/

     
     
            /* $conn->query($sql);*/

                /* $data=mysqli_query($conn, $sql);*/

                  /*echo  $user_profile['last_name'];*/
                  /*  print_r($user_profile); die;  */
        /* $data=['google_user_id'=>$user_profile['id'],
                'first_name'=>$user_profile['first_name'],
                'last_name'=>$user_profile['last_name'],
                'email'=>$user_profile['email']
                
                 ];
            if($this->db->insert('tbl_users',$data)){
                  print_r($user_profile); 
                  echo "string";die;
            } else{
            	 print_r($user_profile); die;
            }  */


        /* redirect('home/facebook_login/');*/
         /*$this->load->library('session');
         $this->load->model('home_model');*/

          

	 /* $this->home_model->createFacebookUser($user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email']);

	        set_cookie('userName',$user->email, time()+60*60*24*30 );
                       
                          $data = array(
				              'email' => $user->email,
				              'is_logged_in'=> TRUE
			                    );
			               $this->session->set_userdata($data);
			               $this->session->set_flashdata('item', array('message' => 'Login Successfully','class' => 'success'));
			               redirect('home');*/
     
	/*$user = new Users();*/

/*	$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	if(!empty($user_data)){
		$output = '<h1>Facebook Profile Details </h1>';
		$output .= '<img src="'.$user_data['picture'].'">';
        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
        $output .= '<br/>Name : ' . $user_data['fname'].' '.$user_data['lname'];
        $output .= '<br/>Email : ' . $user_data['email'];
        $output .= '<br/>Gender : ' . $user_data['gender'];
        $output .= '<br/>Locale : ' . $user_data['locale'];
        $output .= '<br/>You are login with : Facebook';
        $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>'; 
	}else{
		$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}*/
}
?>
<!-- <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Facebook using PHP by CodexWorld</title>
<style type="text/css">
h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
</style>
</head>
<body>
<div>
<?php echo $output; ?>
</div>

</body>
</html> -->