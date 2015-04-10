<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * |-------------------------------------------------------------------------- | File and Directory Modes |-------------------------------------------------------------------------- | | These prefs are used when checking and setting modes when working | with the file system. The defaults are fine on servers with proper | security, but you may wish (or even need) to change the values in | certain environments (Apache running a separate process for each | user, PHP under CGI with Apache suEXEC, etc.). Octal values should | always be used to set the mode correctly. |
 */
define ( 'FILE_READ_MODE', 0644 );
define ( 'FILE_WRITE_MODE', 0666 );
define ( 'DIR_READ_MODE', 0755 );
define ( 'DIR_WRITE_MODE', 0777 );

/*
 * |-------------------------------------------------------------------------- | File Stream Modes |-------------------------------------------------------------------------- | | These modes are used when working with fopen()/popen() |
 */

define ( 'FOPEN_READ', 'rb' );
define ( 'FOPEN_READ_WRITE', 'r+b' );
define ( 'FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb' ); // truncates existing file data, use with care
define ( 'FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b' ); // truncates existing file data, use with care
define ( 'FOPEN_WRITE_CREATE', 'ab' );
define ( 'FOPEN_READ_WRITE_CREATE', 'a+b' );
define ( 'FOPEN_WRITE_CREATE_STRICT', 'xb' );
define ( 'FOPEN_READ_WRITE_CREATE_STRICT', 'x+b' );
define ( 'USER_SESSION', 'LYNX_DENTO_SESSION' );
define ( 'USER_COOKIE', 'LYNX_DENTO_COOKIE' );
class DatabaseFixedValue {
	CONST DEFAULT_FORMAT_DATE = 'Y-m-d H:i:s';
	CONST USER_PLATFORM_DEFAULT = 'PF';
	CONST USER_PLATFORM_FACEBOOK = 'FACEBOOK';
	CONST USER_PLATFORM_TWITTER = 'TWITTER';
	CONST USER_PLATFORM_GOOGLE = 'GOOGLE';
	CONST USER_PLATFORM_ZING = 'ZING';
	CONST USER_TYPE_ADMIN = "ADMIN";
	CONST USER_TYPE_USER = "USER";
	CONST USER_TYPE_COLLABORATORS = "COLLABORATORS";
	CONST USER_STATUS_ACTIVE = 1;
	CONST QUESTION_TYPE_NORMAL = "NORMAL";
	CONST QUESTION_TYPE_MOST = "MOST";
	CONST QUESTION_STATUS_PEDDING = 0;
	CONST QUESTION_STATUS_OK = 1;
	CONST QUESTION_STATUS_REJECT = -1;
	
}


