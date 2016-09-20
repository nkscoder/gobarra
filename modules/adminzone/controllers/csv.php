<?php
class Csv extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('country_model');
        $this->load->library('csvimport');
    }

       public  function index()
       {         
            $pagesize               =  (int) $this->input->get_post('pagesize');            
            $config['limit']        =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
            //$config['overwrite']  = FALSE;            
            $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0; 
            
            $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
                                        
            $res_array              =  $this->country_model->get_country($offset,$config['limit']);
            
            $config['total_rows']   = $this->country_model->total_rec_found; 
            
            $data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'], $offset);
            
            $data['heading_title']  =   'Manage Country';
            
            $data['res']            =  $res_array;

            //print_r($res_array); die(); 
            //echo_sql($res_array); die();
            
            if($this->input->post('status_action')!='')
            {
            
            $this->update_status('tbl_country','country_id');
            
            }       
            
            $this->load->view('country/view_country_list',$data);   
        }

    function importcsv() 
    {
        $data['heading_title'] = 'Upload country';    
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
            $this->load->view('csv/csvindex', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  'uploads'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'country_name'=>$row['country_name'],
                    );
                    $this->csv_model->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                redirect('adminzone/csv','');
                echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $this->load->view('csv/csvindex', $data);
            }  
        } 
}
/*END OF FILE*/
