<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

// ADMIN
$route['admin/newFlow'] = "admin/newFlow";
$route['admin/newProcess'] = "admin/newProcess";
$route['admin/newEquipment'] = "admin/newEquipment";

//IS scoping
$route['isscoping'] = "isscoping/index";
$route['isscopingauto'] = "isscoping/auto"; 
$route['isScopingAutoPrjBase'] = "isscoping/autoprjbase";
$route['isScopingPrjBase'] = "isscoping/prjbase"; 
$route['isscopingtooltip'] = "isscoping/tooltip";
$route['isscopingtooltipscenarios'] = "isscoping/tooltipscenarios";

//Cost Benefit
$route['cost_benefit/(:any)/(:any)'] = "cost_benefit/new_cost_benefit/$1/$2";

//Html Parse
$route['euro_dolar'] = "cpscoping/dolar_euro_parse";

//Easy UI Denemeleri
$route['cp_allocation/deneme'] = "cpscoping/deneme";
$route['cp_allocation/deneme_json'] = "cpscoping/deneme_json";

//Cp Scoping Routes
$route['kpi_calculation_chart/(:any)/(:any)'] = "cpscoping/kpi_calculation_chart/$1/$2";
$route['kpi_insert/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cpscoping/kpi_insert/$1/$2/$3/$4/$5";
$route['kpi_calculation/(:any)/(:any)'] = "cpscoping/kpi_calculation/$1/$2";
$route['search_result/(:any)/(:any)'] = "cpscoping/search_result/$1/$2";
$route['cpscoping/file_upload/(:any)/(:any)'] = "cpscoping/cp_scoping_file_upload/$1/$2";
$route['cpscoping/is_candidate_insert/(:any)/(:any)'] = "cpscoping/cp_is_candidate_insert/$1/$2";
$route['cpscoping/is_candidate_control/(:any)'] = "cpscoping/cp_is_candidate_control/$1";
$route['cpscoping/cost_ep/(:any)/(:any)/(:any)'] = "cpscoping/cost_ep_value/$1/$2/$3";
$route['cpscoping/get_allo/(:any)/(:any)/(:any)/(:any)/(:any)'] = "cpscoping/get_allo_from_fname_pname/$1/$2/$3/$4/$5";
$route['cpscoping/(:any)/(:any)/show'] = "cpscoping/cp_show_allocation/$1/$2";
$route['cp_allocation_array/(:any)'] = "cpscoping/cp_allocation_array/$1";
$route['cpscoping/(:any)/(:any)/allocation'] = "cpscoping/cp_allocation/$1/$2";
$route['cpscoping/pro/(:any)'] = "cpscoping/p_companies/$1";
$route['cpscoping'] = "cpscoping/index";

//Password routes
$route['send_email_for_change_pass'] = "password/send_email_for_change_pass";
$route['change_pass/(:any)'] = "password/change_pass/$1";
$route['new_password_email'] = "password/new_password_email";
$route['new_password/(:any)'] = "password/new_password/$1";

$route['cluster'] = "cluster/cluster_to_match_company";

$route['become_consultant'] = "user/become_consultant";
$route['profile_update'] = "user/user_profile_update";
$route['user/(:any)'] = "user/user_profile/$1";
$route['register'] = "user/user_register";
$route['login'] = "user/user_login";
$route['logout'] = "user/user_logout";

//OPen project
$route['closeproject'] = "project/close_project";
$route['openproject'] = "project/open_project";
$route['update_project/(:any)'] = "project/update_project/$1";
$route['newproject'] = "project/new_project";
$route['projects'] = "project/show_all_project";
$route['contactperson']="project/contact_person";
$route['project/(:any)'] = "project/view_project/$1";


$route['companySearch']="company/company_search";
$route['update_company/(:any)'] = "company/update_company/$1";
$route['newcompany'] = "company/new_company";
$route['company'] = "company/show_all_companies";
$route['company/(:any)'] = "company/companies/$1";
$route['addUsertoCompany/(:any)'] = "company/addUsertoCompany/$1";

$route['search'] = "search/search_pro";
$route['search/(:any)'] = "search/search_pro/$1";

$route['flow_and_component'] = "dataset/flow_and_component";
$route['new_flow/(:any)'] = "dataset/new_flow/$1";
$route['new_component/(:any)'] = "dataset/new_component/$1";
$route['delete_flow/(:any)/(:any)'] = "dataset/delete_flow/$1/$2";
$route['delete_component/(:any)/(:any)'] = "dataset/delete_component/$1/$2";

$route['new_product/(:any)'] = "dataset/new_product/$1";
$route['product'] = "dataset/product";
$route['delete_product/(:any)/(:any)'] = "dataset/delete_product/$1/$2";

$route['new_process/(:any)'] = "dataset/new_process/$1";
$route['delete_process/(:any)/(:any)/(:any)'] = "dataset/delete_process/$1/$2/$3";
$route['get_sub_process'] = "dataset/get_sub_process";

$route['new_equipment/(:any)'] = "dataset/new_equipment/$1";
$route['get_equipment_type'] = "dataset/get_equipment_type";
$route['get_equipment_attribute'] = "dataset/get_equipment_attribute";
$route['delete_equipment/(:any)/(:any)'] = "dataset/delete_equipment/$1/$2";

$route['default_controller'] = "homepage";
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
