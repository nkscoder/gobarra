<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Public_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
		// If this page was POSTed to (and there is a search string)
		if ($search = $this->input->post('search', TRUE) )
		{
			
			// LIKE
			$like_search = '%' . $this->db->escape_like_str($search) . '%';

			$query = $this->db->query("
				SELECT first_name, last_name, full_name, bio
				FROM
					(
					SELECT CONCAT(first_name, ' ', last_name) AS full_name, first_name, last_name, bio
					FROM presidents
					) AS q
				WHERE full_name LIKE '$like_search'
				ORDER BY full_name ASC
			");
			
			$results = array();
			
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					//$full_name_highlighted = str_ireplace($search , '<em>' . $search . '</em>', $row->full_name);
					
					// Where does our search appear in the full name?
					$start = stripos($row->full_name, $search);
					
					// Length of our search string
					$length = strlen($search);
					
					// Generate new sub string that reflects case of source
					$new_search = substr($row->full_name, $start, $length);
					
					// Generate highlighted search string
					$full_name_highlighted = str_replace($new_search , '<em>' . $new_search . '</em>', $row->full_name);
					
					$results[] = array(
						'first_name' => $row->first_name,
						'last_name' => $row->last_name,
						'full_name' => $row->full_name,
						'full_name_highlighed' => $full_name_highlighted,
						'bio' => $row->bio,
					);
				}
			}
			
			// If it was an AJAX response
			if ($this->input->is_ajax_request())
			{
				// JSON headers 
				$this->output->set_header("Cache-Control: no-cache, must-revalidate");
				$this->output->set_header("Expires: Mon, 4 Apr 1994 04:44:44 GMT");
				$this->output->set_header("Content-type: application/json");
				
				// Encode results as JSON
				echo json_encode($results);
			}
			
			// If it was not an AJAX response
			else
			{
				$data['results'] = $results;
				die('sdsds');
			//	$this->load->view('home/welcome_message', $data);
			}
		}
		
		// If this page was not posted to
		else
		{
			
			//$this->load->view('home/welcome_message');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
