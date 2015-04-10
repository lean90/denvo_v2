<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/ENVIRONMENT.php';
define ('BASEPATH',dirname(dirname(dirname(__FILE__))));
define ('APPPATH',BASEPATH.'/application/');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','0');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','1');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');
//define('ADD_LAST_ACTIVITY','1');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */
define('_ENGINE', true);
//$db = include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."application".DIRECTORY_SEPARATOR."settings".DIRECTORY_SEPARATOR."database.php";
include_once APPPATH.'config'.DIRECTORY_SEPARATOR.ENVIRONMENT.DIRECTORY_SEPARATOR.'database.php';

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

define('DB_SERVER',				$db['lynx']['hostname']         );
define('DB_PORT',				$db['lynx']['port']             );
define('DB_USERNAME',				$db['lynx']['username']         );
define('DB_PASSWORD',				$db['lynx']['password']         );
define('DB_NAME',				$db['lynx']['database']         );
define('TABLE_PREFIX',				$db['lynx']['dbprefix']         );
define('DB_USERTABLE',				't_user'                        );
define('DB_USERTABLE_NAME',			'full_name'                     );
define('DB_USERTABLE_USERID',                   'id'                            );
define('DB_AVATARTABLE',                        "t_user"                        );
define('DB_AVATARFIELD',		        " (select avartar from t_user as us where us.id = t_user.id) " );
define('DB_USERTABLE_LASTACTIVITY',             'last_activity'                 );
define('ADD_LAST_ACTIVITY',	'1');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
    $userid = 0;

    if (!empty($_COOKIE['LYNX_DENTO_COOKIE'])) {
        $userid = $_COOKIE['LYNX_DENTO_COOKIE'];
    }
    $userid = intval($userid);
    return $userid;
}


function chatLogin($userName,$userPass){
	$userid = 0;
	if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
		$sql ="SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE email ='".$userName."'";
	} else {
		$sql ="SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE username ='".$userName."'"; 
	}
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	$sql1 ="SELECT * FROM `".TABLE_PREFIX."core_settings` WHERE name='core.secret'";
	$result1=mysql_query($sql1);
	$row1 = mysql_fetch_array($result1);
	
	$salted_password = md5($row1['value'].$userPass.$row['salt']);
	
	if($row['password'] == $salted_password){
		$userid = $row['user_id'];
	}
	return $userid;
}

function getFriendsList($userid,$time) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,".DB_AVATARFIELD." avatar, ".TABLE_PREFIX.DB_USERTABLE.".id link, cometchat_status.message, cometchat_status.status from  ".TABLE_PREFIX."user_membership join ".TABLE_PREFIX.DB_USERTABLE."  on ".TABLE_PREFIX."user_membership.user_id = ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX."user_membership.resource_id = '".mysql_real_escape_string($userid)."' and active = 1 order by username asc");

	if (defined('DISPLAY_ALL_USERS') && DISPLAY_ALL_USERS == 1) {
            $sql = ("select " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " userid, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " username, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_LASTACTIVITY . " lastactivity," . DB_AVATARFIELD . " avatar, " . TABLE_PREFIX . DB_USERTABLE . ".id link, cometchat_status.message, cometchat_status.status from  " . TABLE_PREFIX . DB_USERTABLE . "  left join cometchat_status on " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = cometchat_status.userid  where " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " <> '" . mysql_real_escape_string($userid) . "' and ('" . $time . "'-" . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_LASTACTIVITY . " < '" . ((ONLINE_TIMEOUT) * 2) . "') order by username asc");
        }
	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".id link, ".DB_AVATARFIELD." avatar, cometchat_status.message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
        return $sql;
}

function updateLastActivity($userid) {
	$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
	return $sql;
}

function getUserStatus($userid) {
	 $sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
         return $sql;
}

function getLink($link) {
	return BASE_URL."../profile/".$link;
}

function getAvatar($image) {
        if(strpos($image,'http') !== false){
            return $image;
        }
	if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$image)) {
		return BASE_URL."../".$image;
	} else {
		return BASE_URL."../docroot/img/noimage.jpg";
	}
}


function getTimeStamp() {
	return time();
}

function processTime($time) {
	return $time;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* HOOKS */

function hooks_statusupdate($userid,$statusmessage) {
	$sql = ("update ".TABLE_PREFIX.DB_USERTABLE." set status = '".mysql_real_escape_string($statusmessage)."', status_date = '".date("Y-m-d H:i:s",getTimeStamp())."' where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
 	$query = mysql_query($sql);
}

function hooks_forcefriends() {
	
}

function hooks_activityupdate($userid,$status) {

}

function hooks_message($userid,$unsanitizedmessage) {
	
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* Nulled by TrioxX */

$p_ = 4;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////