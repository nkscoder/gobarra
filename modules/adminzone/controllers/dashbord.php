<?php
class Dashbord extends Admin_Controller {

  public function __construct() {
	
	 parent::__construct();	
	
	  $this->load->model(array('adminzone/adminzone_model'));	 
	  $this->config->set_item('menu_highlight','dashboard');
  }
	  
    public  function index()
	{
			
		$data['title'] =  $this->config->item("site_name");
		$data['total_users']  = $this->count_record('tbl_users',"status !='2' ");
		//$data['total_member'] = $this->count_record('tbl_adop_herds',"status !='2' ");
		//$data['total_testimonial'] = $this->count_record('wl_testimonial',"status !='2' ");			
		$this->load->view('dashboard/dashbord_index_view',$data);	
        
	  // $table_fields = $this->table_info('wl_testimonial');
	  // trace($table_fields);
	 
   }		
	
   public function count_record ($table,$condition="")
   {
				
		if($table!="" && $condition!="")
		{
			
			  $this->db->from($table);
			  $this->db->where($condition);	        
			  $num = $this->db->count_all_results();
			
		 }else
		 {			
			 $num = $this->db->count_all($table);
			
		}
		
		return $num;
	

    }
  
		 	 
	public function remove_thumb_cache()
	{			
		$path = IMG_CACH_DIR;	
		$this->load->helper("file");
        delete_files($path);
				
	}	
	
	public function php_info()
	{			
		phpinfo();
		
	}
	
	public function make_folder($name='')
	{			
		if($name!='')
		{						
			make_missing_folder($name);			
		}
				
	}	
	
	public function get_ini()
	{

		trace(ini_get_all());
		
	}
	
	private function table_info($table_name)
    {
        $fields = array();

        // check that the table exists in this database
        if ($this->db->table_exists($table_name))
        {

            $query_string = "SHOW COLUMNS FROM ".$this->db->dbprefix.$table_name;
            if($query = $this->db->query($query_string))
            {
                // We have a title - Edit it
                foreach($query->result_array() as $field)
                {
                    $field_array = array();

                    $field_array['name'] = $field['Field'];

                    $type = '';
                    if(strpos($field['Type'], "("))
                    {
                        list($type, $max_length) = explode("--", str_replace("(", "--", str_replace(")", "", $field['Type'])));
                    }
                    else
                    {
                        $type = $field['Type'];
                    }

                    $field_array['type'] = strtoupper($type);

                    $values = '';
                    if(is_numeric($max_length))
                    {
                        $max_length = $max_length;
                    }
                    else
                    {
                        $values = $max_length;
                        $max_length = 1;
                    }

                    $field_array['max_length'] = $max_length;
                    $field_array['values'] = $values;

                    $primary_key = 0;
                    if($field['Key'] == "PRI") {
                        $primary_key = 1;
                    }
                    $field_array['primary_key'] = $primary_key;

                    $field_array['default'] = $field['Default'];

                    $fields[] = $field_array;
                } // end foreach

                return $fields;

            }//end if
        }//end if

        return FALSE;

    }//end table_info()
		
		
		
	

}
/* End of file student.php */
/* Location: ./system/application/controllers/student.php */