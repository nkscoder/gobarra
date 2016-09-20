<?php
class home_model extends CI_Model{
		function __construct(){
			/*$this->load->library('profile_image_thumb');	*/
			parent::__construct();
		}		
		 public function getUserID($email){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('email',$email);
			//$this->db->limit(1);
			$result=$this->db->get();
			if($result->num_rows >0){			
				return $result->result();	
			}
		}		
		
		public function get_traveler($limit = '10', $offset = '0', $param = array()) 
		{
			$travelfrom = @$param['travel_from'];
			$travelto 	= @$param['travel_to'];
			$type     	= @$param['type'];
			$orderby 	= 'travel_id';
			$where 		= @$param['where'];
			$keyword1	=   $this->db->escape_str($travelfrom);
			$keyword2	=   $this->db->escape_str($travelto);
		if ($travelfrom != '') 
		{
			$this->db->where("(wlp.travel_from LIKE '%".$keyword1."%')");
			//$this->db->where("wlp.travel_from","$travelfrom");
        }
		if ($travelto != '') 
		{
			$this->db->where("(wlp.travel_to LIKE '%".$keyword2."%')");
			//$this->db->or_where("wlp.travel_to","$travelto");
		}
		if ($type != '') 
		{
			$this->db->where("wlp.type" ,"$type");
        }
		if ($where != '') 
		{
            $this->db->where($where);
        }
        if ($orderby != '') 
		{
            $this->db->order_by($orderby,'desc');
        }
			$this->db->limit($limit,$offset);
			$this->db->select('SQL_CALC_FOUND_ROWS wlp.*,wlusr.*', FALSE);
			$this->db->from('tbl_travel_plans as wlp');
			$this->db->join('tbl_users AS wlusr','wlp.user_id=wlusr.user_id','left');
			$this->db->where('type =','1');
			$this->db->where('wlp.status =','1');
			$q = $this->db->get();        
			$result = $q->result_array();
			$result = ($limit == '1') ? $result[0] : $result;
          /*   
           echo "<pre/>";
               $i=1;
             print_r($result);
             foreach ($result as $data) {
             	# code...
               echo $data['profile_image'];
               if(!$data['profile_image']==''){
                 $i++;
               
               $url = 'destination'.$i.'.jpg';
              
              $source_url=base_url().'uploaded_files/profile_img/'.$data['profile_image'];
                
                 $info = getimagesize($source_url); 
                 if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url); 

					elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url); 

					elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url); 

                  $image= $data['profile_image'];
                       clearstatcache();
					imagejpeg($image,$url, 80);

                     $this->load->library('upload');					
				      $uploaded_data =  $this->upload->my_upload($url,'profile_img');

					echo $url;
					
					$data=$this->image_thumb_profile($source_url, 100, 100);

					echo $data; 
                   echo "<br>";*/
/*                   

					$data_to_store = array(
                    'first_name' 	=> $this->input->post('first_name'),
                    'last_name' 	=> $this->input->post('last_name'),
                    'couple' 		=> $this->input->post('couple'),
                    'gender' 		=> $this->input->post('gender'),
                    'country_id'	=> $Mycountry,
                    'city_id'		=> $Mycity,
                    'occupation' 	=> $this->input->post('occupation'),
					'mobile' 		=> $this->input->post('mobile'),
					'profile_image' => $uploaded_file,	
                    'status' 		=> 1,
                    'modified' 		=> date('Y-m-d H:i:s')                   
                );*/


           /* }

             }*/

           /*   echo $result[0]['profile_image'];*/

                 /* die; 
                   $source_url=base_url().'uploaded_files/profile_img/'.$result['profile_image'];

					 $info = getimagesize($source_url); 

					if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url); 
					elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url); 
					elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url); 
					imagejpeg($image, $destination_url, $quality); 
					return $destination_url;*/
     /*        die;*/


			return $result;
		}
	/* get registerd members */



	function image_thumb_profile( $image_path, $height, $width ) {
    // Get the CodeIgniter super object
    $CI =& get_instance();

    // Path to image thumbnail
    $image_thumb = dirname( $image_path ) . '/' . $height . '_' . $width . '.jpg';

    if ( !file_exists( $image_thumb ) ) {
        // LOAD LIBRARY
        $CI->load->library( 'image_lib' );

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize( $config );
        $CI->image_lib->resize();
        $CI->image_lib->clear();
    }
   return $image_thumb;
  /*  return '<img src="' . dirname( $_SERVER['SCRIPT_NAME'] ) . '/' . $image_thumb . '" />';*/
}


 public  function get_travelerData(){

	 $this->db->limit(5, 0);
	 $this->db->order_by('travel_id','desc');
	 $this->db->select('SQL_CALC_FOUND_ROWS wlp.*,wlusr.*', FALSE);
	 $this->db->from('tbl_travel_plans as wlp');
	 $this->db->join('tbl_users AS wlusr','wlp.user_id=wlusr.user_id','left');
	 $this->db->where('type =','1');
	 $this->db->where('wlp.status =','1');
	 $q = $this->db->get();
	 $result = $q->result_array();

	 return $result;

 }

	public  function get_traveler_Data($limit, $start){

		$this->db->limit($limit, $start);
		$this->db->order_by('travel_id','desc');
		$this->db->select('SQL_CALC_FOUND_ROWS wlp.*,wlusr.*', FALSE);
		$this->db->from('tbl_travel_plans as wlp');
		$this->db->join('tbl_users AS wlusr','wlp.user_id=wlusr.user_id','left');
		$this->db->where('type =','1');
		$this->db->where('wlp.status =','1');
		$q = $this->db->get();
		$result = $q->result_array();

		return $result;

	}

	public function getMembers()
	{
	$this->db->select('user.*');
	$this->db->from('tbl_users as user');
	$this->db->where('user.status','1');
	$this->db->order_by('user.user_id','DESC');
	$this->db->limit(9);
	$q = $this->db->get();
	$result = $q->result();
	if($result>1) {
	return $result;
	}
	}
	public function get_products($limit='10',$offset='0',$param=array())
	 {
		$country			=   @$param['country_id'];
		$city			    =   @$param['city_id'];
		$user				=	@$param['user_id'];
		$orderby 			= 	'product_id';
		$where 				= 	@$param['where'];
		$keyword1			=   $this->db->escape_str($country);
		//print_r($keyword1);die;
		$keyword2			=   $this->db->escape_str($city);
		if($country!='')
		{
			$this->db->where("(wlp.country_id LIKE '%".$keyword1."%')");
			//$this->db->where("wlp.country_id ","$country");
		}	
		if($city!='')
		{
			$this->db->where("(wlp.city_id LIKE '%".$keyword2."')");
			//$this->db->where("wlp.city_id ","$city");
		}
		if ($orderby != '') 
		{
            $this->db->order_by($orderby,'desc');
        }
		if ($where != '') 
		{
            $this->db->where($where);
        }        
		$this->db->limit($limit,$offset);
		$this->db->select('SQL_CALC_FOUND_ROWS wlp.product_id,wlp.user_id,wlp.country_id,wlp.city_id,wlp.product_name,wlp.description,wlp.status,wlp.img1,,wlp.img2,wlp.product_added_date,wlu.first_name,wlu.last_name,wlu.profile_image',FALSE);
		$this->db->from('tbl_products as wlp');
		$this->db->where('wlp.status =','1');		
		$this->db->join('tbl_users AS wlu','wlp.user_id=wlu.user_id','left');
		$this->db->order_by('wlp.product_added_date','desc');
		$q=$this->db->get();		
		$result = $q->result_array();		
		$result = ($limit=='1') ? @$result[0]: $result;	
		return $result;
	}
	
	public function get_more_products($limit='10',$offset='0',$param=array())
	 {		
			$user				=	@$param['user_id'];
		if($user !='')
		{
			$this->db->where("wlu.user_id ","$user");
		}
			$this->db->limit($limit,$offset);
			$this->db->select('SQL_CALC_FOUND_ROWS wlp.*,wlu.*',FALSE);
			$this->db->from('tbl_products as wlp');
			$this->db->where('wlp.status =','1');		
			$this->db->join('tbl_users AS wlu','wlp.user_id=wlu.user_id','left');
			$this->db->order_by('wlp.product_id ','desc');
			$this->db->group_by("wlp.product_id");
			$q=$this->db->get();		
			$result = $q->result_array();	
			$result = ($limit=='1') ? @$result[0]: $result;	
			return $result;			
	}
			public function getUserInfo($id){
			$this->db->select('*');
			$this->db->from('tbl_users');			
			$this->db->where('user_id',$id);
			//$this->db->limit(1);
			$result=$this->db->get();
			if($result->num_rows >0){			
				return $result->result();	
			}
		}
	public function gettravelInfo($id)
    {
		$this->db->select('*');
		$this->db->from('tbl_travel_plans');
		$this->db->where('travel_id', $id);
		$query = $this->db->get();		
		return $query->result_array(); 
    } 
	
	public function record_count() {
        $this->db->select('*');
		$this->db->from('tbl_products');
		$this->db->where('status','1');
		$result= $this->db->get();
		if($result->num_rows() >0)
		{
			return $result->num_rows();
		}
    }
	
	public function record_count1($ID){
			$this->db->select('*');
			$this->db->from('tbl_products');
			$this->db->where('user_id',$ID);
			$result=$this->db->get();
			//print_r($result); die();
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
		}
	
	/* Funtion for get Details of time line post start*/
    
		public function get_postTime($limit = '10', $offset = '0', $param = array()) 
		{       
			$userID = @$param['user_id'];
			$orderby = @$param['orderby'];
			$where = @$param['where'];       
			if($userID != '') {
				$this->db->where("wlt.user_id ","$userID");
			}
			if ($where != '') {
				$this->db->where($where);
			}						
			$this->db->limit($limit,$offset);
			$this->db->group_by("wlt.travel_id");
			$this->db->select('SQL_CALC_FOUND_ROWS wlt.*,wlusr.*', FALSE);
			$this->db->from('tbl_travel_plans as wlt');		
			$this->db->join('tbl_users AS wlusr','wlt.user_id=wlusr.user_id','left');
			$this->db->where('wlt.status','1');        
			$this->db->order_by("wlt.travel_id","desc");
			$q = $this->db->get();		
			$result = $q->result_array();
			$result = ($limit == '1') ? $result[0] : $result;
			return $result;
		}
			/* Funtion for get Details of time line end start*/
			public function countPlans($ID){
			$this->db->select('*');
			$this->db->from('tbl_travel_plans');
			$this->db->where('user_id',$ID);
			$result=$this->db->get();
			//print_r($result); die();
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
			}	

     public function getGoogleUser($id){

           $this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('google_user_id',$id);
			$result=$this->db->get();
			//print_r($result); die();
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
     }
public function createGoogleUser($id,$name,$email,$picture){

        $data=['google_user_id'=>$id,
                'first_name'=>$name,
                'email'=>$email,
                 'profile_image'=>$picture
                 ];
       return $this->db->insert('tbl_users',$data)? true : false;       

}

public function createFacebookUser(){
    
        /* $_SESSION["id"];
         $_SESSION["first_name"];
         $_SESSION["last_name"];
         $_SESSION["gender"];
         $_SESSION["email"];*/

        $data=['facebook_user_id'=>$_SESSION["id"],
                'first_name'=>$_SESSION["first_name"],
                'last_name'=>$_SESSION["last_name"],
                'email'=> $_SESSION["email"],
                 'profile_image'=>$_SESSION["picture"]
                 ];
       return $this->db->insert('tbl_users',$data)? true : false;       

}
  public function getFacebookUser(){

            $this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('facebook_user_id',$_SESSION["id"]);
			$result=$this->db->get();
			//print_r($result); die();
			if($result->num_rows > 0){
				return $result->num_rows();	
			}
  }

   }