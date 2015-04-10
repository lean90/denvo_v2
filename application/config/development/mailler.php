<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

define ( 'MAILLER_PROTOCOL', 'protocol' );
define ( 'MAILLER_USERAGENT', 'useragent' );
define ( 'MAILLER_HOST', 'smtp_host' );
define ( 'MAILLER_FULLNAME', 'smtp_fullName' );
define ( 'MAILLER_USER', 'smtp_user' );
define ( 'MAILLER_PORT', 'smtp_port' );
define ( 'MAILLER_PASS', 'smtp_pass' );
define ( 'MAILLER_TIMEOUT', 'smtp_timeout' );
define ( 'MAILLER_TEMP', 'temp' );
define ( 'MAILLER_TYPE', 'mailtype' );
define ( 'MAILLER_NEWLINE', 'newline' );

$config ['order_completed_admin_email'] = 'lethanhan.bkaptech@gmail.com';
$config ['temp_mail_folder'] = APPPATH . 'temp/mail/';
$config ['RegistorMailler'] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/registor',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);

$config ['AutoSupportTicketMailler'] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/SupportTicketToUser',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);

$config ['LostPasswordMailler'] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/lost_password',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);

$config ['AdminSupportTicketMailler'] = 'lynx.dento@gmail.com';
$config ['AutoSupportTicketForAdminMailler'] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/SupportTicketToAdmin',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);

$config ["AdminInterviewMailler"] = 'lynx.dento@gmail.com';
$config ["AutoSendInterviewMailToAdminMailler"] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/AutoSendInterviewMailToAdmin',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);

$config ["ContactMailler"] = 'lynx.dento@gmail.com';
$config ["ContactMailMailler"] = array (
		MAILLER_PROTOCOL => 'smtp',
		MAILLER_USERAGENT => 'Dento',
		MAILLER_HOST => 'ssl://smtp.gmail.com',
		MAILLER_FULLNAME => 'Hệ thống mail Dento',
		MAILLER_USER => 'lynx.dento@gmail.com',
		MAILLER_PORT => '465',
		MAILLER_PASS => '1234567$',
		MAILLER_TIMEOUT => '1',
		MAILLER_TEMP => 'template/ContactEmail',
		MAILLER_TYPE => 'html',
		MAILLER_NEWLINE => "\r\n" 
);
