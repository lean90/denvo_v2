<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	/*
 * | ------------------------------------------------------------------------- | URI ROUTING | ------------------------------------------------------------------------- | This file lets you re-map URI requests to specific controller functions. | | Typically there is a one-to-one relationship between a URL string | and its corresponding controller class/method. The segments in a | URL normally follow this pattern: | | example.com/class/method/id/ | | In some instances, however, you may want to remap this relationship | so that a different class/function is called than the one | corresponding to the URL. | | Please see the user guide for complete details: | | http://codeigniter.com/user_guide/general/routing.html | | ------------------------------------------------------------------------- | RESERVED ROUTES | ------------------------------------------------------------------------- | | There area two reserved routes: | | $route['default_controller'] = 'welcome'; | | This route indicates which controller class should be loaded if the | URI contains no data. In the above example, the "welcome" class | would be loaded. | | $route['404_override'] = 'errors/page_missing'; | | This route will tell the Router what URI segments to use if those provided | in the URL cannot be matched to a valid route. |
 */

$route ['default_controller'] = "Home/ShowPage";
$route ['404_override'] = 'error/notFound';
if (array_key_exists ( 'REQUEST_METHOD', $_SERVER )) {
	if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
		$route ['home'] = 'home/ShowPage';
		$route ['login'] = 'Authen/ShowPage';
		$route ['logout'] = 'Authen/logout';
		$route ['files'] = 'Files/ShowPage';
		$route ['register'] = 'Authen/register';
		$route ['danh-sach-cau-hoi'] = 'Question/showPage';
		$route ['cau-hoi/(:num)'] = 'Question/detail/$1';
		$route ['question/delete/(:num)'] = 'Question/del/$1';
		$route ['questions/get/(:any)'] = 'Question/getQuestions/$1';
		$route ['questions/set-to-most/(:any)'] = 'Question/setToMostQuestion/$1';
		$route ['questions/remove-to-most/(:any)'] = 'Question/removeToMostQuestion/$1';
		$route ['question/public/(:any)'] = 'Question/publicQuestion/$1';
		$route ['question/reject/(:any)'] = 'Question/rejectQuestion/$1';
		$route ['map/get-near-position/(:num)'] = 'Hospital/LoadTopPositionNearCurrentPosition/$1';
		 
		$route ['answer/remove/(:any)'] = 'Question/removeAnswer/$1';
		$route ['answer/like/(:num)'] = 'Question/like/$1';
		
		$route ['report/sys'] = 'report/report_system';
		$route ['report/usr/(:num)'] = 'report/report_user/$1';
		
		$route ['timeline/rang-vinh-vien'] = 'Timeline/rvv';
		$route ['timeline/rang-sua'] = 'Timeline/rs';
		$route ['lost-password'] = "lost_password/show_page";
		$route ['reset_password'] = "lost_password/reset_password";
		
		$route ['__admin'] = 'admin/MainAdminCtrl/ShowPage';
		$route ['__admin/setting'] = 'admin/Setting/ShowPage';
		$route ['__admin/setting_support'] = 'admin/SettingSupport/ShowPage';
		$route ['__admin/account'] = 'admin/Account/ShowPage';
		$route ['__admin/account/export'] = 'admin/Account/export';
		$route ['__admin/maps'] = 'admin/Location/ShowPage';
		$route ['__admin/search-localtion'] = 'admin/Location/getLocationByName';
		
		
		$route ['api/__admin/account/(:num)/history'] = 'admin/Account/history/$1';
		$route ['api/__admin/account/(:num)/ticket_support'] = 'admin/Account/ticketSupport/$1';
		
		$route ['send_mail'] = 'SendEmail/ShowPage';
		$route ['twitter/auth'] = 'twitter/auth';
		$route ['twitter/callback'] = 'twitter/callback';
		$route ['google/auth'] = 'Google/auth';
		$route ['google/callback'] = 'Google/callback';
		$route ['zing/auth'] = 'Zing/auth';
		$route ['zing/callback'] = 'Zing/callback';
		
		$route ['phong-kham'] = 'Hospital/ShowPage';
		
		$route ['api/categories/get_child/(:any)'] = "CategoryAPI/getCategories/$1";
		$route ['api/tags/search'] = "TagAPI/searchTag";
		$route ['interview'] = 'Interview/ShowPage';
		$route ['search'] = 'Search/ShowPage';
		$route ['api/search/post/by_name'] = 'Search/searchPostXHR';
		$route ['api/search/user/by_full_name'] = 'UserAPI/searchUserByFullName';
		$route ['profile/(:num)'] = "User/profile/$1";
		$route ['profile/(:num)/ho-so-rang-mieng'] = "Profiles/ShowPage/$1";
		$route ['profile/(:num)/tuoi-moc-rang'] = "TeethGrow/ShowPage/$1";
		$route ['user/(:num)/show_information'] = "User/ShowPage/$1";
		$route ['api/(:any)/(:any)'] = 'CategoryAPI/getPostsByCategoryId/$2/$1';
		$route ['api/(:any)'] = 'CategoryAPI/getPostsByCategoryId/$1';
		$route ['(:any)/([\w\-]+)-([0-9]+).html/edit.html'] = 'EditPost/ShowPage/$1/$3';
		$route ['(:any)/([\w\-]+)-([0-9]+).html/remove.html'] = 'RemovePost/ShowPage/$1/$3';
		$route ['(:any)/(:any)/add.html'] = 'NewPost/ShowPage/$2/$1';
		$route ['(:any)/add.html'] = 'NewPost/ShowPage/$1';
		$route ['(:any)/([a-zA-Z0-9\-]+)-([0-9]+).html'] = 'DetailScreen/ShowPage/$3';
		$route ['(:any)/(:any)'] = 'ListScreen/ShowPage/$2/$1';
		$route ['(:any)'] = 'ListScreen/ShowPage/$1';
	}
	if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
	    $route ['danh-sach-cau-hoi'] = 'Question/addQuestion';
	    $route ['cau-hoi/(:num)'] = 'Question/addAnswer/$1';
	    
		$route ['__admin/setting/save_banner'] = 'admin/Setting/SaveBanner';
		$route ['__admin/setting/save_banner_url'] = 'admin/Setting/SaveBannerUrl';
		$route ['__admin/setting/save_home_video'] = 'admin/Setting/SaveHomeVideo';
		$route ['__admin/setting/save_general_knowledge'] = 'admin/Setting/SaveGeneralKnowledge';
		$route ['__admin/setting/save_product'] = 'admin/Setting/SaveProduct';
		$route ['__admin/setting/save_game'] = 'admin/Setting/SaveGame';
		$route ['__admin/setting_support/(:num)'] = 'admin/SettingSupport/save/$1';
		$route ['__admin/add-position'] = 'admin/Location/add';
		$route ['__admin/update-position'] = 'admin/Location/update';
		$route ['__admin/del-position'] = 'admin/Location/del';
		$route ['__admin/add-area'] = 'admin/Location/addArea';
		$route ['__admin/del-area'] = 'admin/Location/removeArea';
		$route ['__admin/update-area'] = 'admin/Location/updateArea';
		
		
		
				
		$route ['__admin/account/(:num)/set_permission'] = 'admin/Account/setPermission/$1';
		$route ['__admin/account/(:num)/set_banned_status'] = 'admin/Account/setBannedStatus/$1';
		$route ['files'] = 'Files/saveFile';
		$route ['lost-password'] = "lost_password/reset";
		$route ['send_mail'] = 'SendEmail/send';
		$route ['profile/(:num)/ho-so-rang-mieng'] = "Profiles/Save/$1";
		$route ['profile/(:num)/tuoi-moc-rang'] = "TeethGrow/Save/$1";
		$route ['reset_password'] = "lost_password/reset_password_save";
		
		$route ['interview'] = 'Interview/send';
		$route ['user/(:num)/show_information'] = "User/UpdateInformation/$1";
		$route ['register/(:any)'] = 'Authen/registor/$1';
		$route ['api/login/(:any)'] = 'UserApi/Login/$1';
		$route ['profile/(:num)/ho-so-rang-mieng/send_support'] = "Profiles/SendSupport/$1";
		$route ['profile/(:num)/ho-so-rang-mieng/response_support'] = "Profiles/UpdateSupportResponse/$1";
		
		$route ['profile/(:num)/tuoi-moc-rang/send_support'] = "TeethGrow/SendSupport/$1";
		$route ['profile/(:num)/tuoi-moc-rang/response_support'] = "TeethGrow/UpdateSupportResponse/$1";
		
		$route ['(:any)/([a-zA-Z0-9\-]+)-([0-9]+).html/edit.html'] = 'EditPost/editPost/$1/$3';
		$route ['(:any)/(:any)/add.html'] = 'NewPost/addPost';
		$route ['(:any)/add.html'] = 'NewPost/addPost';
	}
}






/* End of file routes.php */
/* Location: ./application/config/routes.php */
