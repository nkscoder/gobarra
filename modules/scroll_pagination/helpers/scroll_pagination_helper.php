<?php defined('BASEPATH') OR exit('No direct script access allowed.');
function scroll_pagination($base_uri, $total_rows, $record_per = NULL, $uri_segment=3)

{		
	$ci = &get_instance();

	$ci->load->library('scroll_pagination/scroll_pagination');	

//	$config['per_page']			 = $record_per ? $record_per:$ci->config->item('per_page');
$config['per_page']			 = $record_per ? $record_per:$ci->config->item('per_page');

	$config['base_url']          = strpos("*".$base_uri,base_url())?$base_uri:(base_url().$base_uri);

	 	  

    $config['total_rows']			= $total_rows; 

    $config['uri_segment']			= $uri_segment;

	$config['page_query_string']	= FALSE;

	

	$config['additional_param']     = @$param['additional_param']==''?'serialize_form()':$param['additional_param'];

	$ci->scroll_pagination->initialize($config);

	$data = $ci->scroll_pagination->create_links();

	return $data;	

}