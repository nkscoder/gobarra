<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


// Admin and modules

$route['adminzone/(:any)']		= "adminzone/$1";


$handle = opendir(FCPATH.'modules');

if ($handle)
{
	while ( false !== ($module = readdir($handle)) )
	{
		// make sure we don't map silly dirs like .svn, or . or ..
		
		if (substr($module, 0, 1) != ".")
		{
			if ( file_exists(FCPATH.'modules/'.$module.'/'.$module.'_routes.php') )
			{
				// FCPATH.'modules/'.$module.'/'.$module.'_routes.php'."<br>";
				require_once(FCPATH.'modules/'.$module.'/'.$module.'_routes.php');
			}
				
		}
	}
}

$route['default_controller'] = "home";
$route['404_override'] = '';

// cms pages 




/* End of file routes.php */
/* Location: ./application/config/routes.php */