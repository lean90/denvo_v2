<?php
set_include_path ( APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path () );
require_once APPPATH . 'third_party/zingme-sdk/BaseZingMe.php';
require_once APPPATH . 'third_party/zingme-sdk/ZME_FeedDialog.php';
require_once APPPATH . 'third_party/zingme-sdk/ZME_Me.php';
require_once APPPATH . 'third_party/zingme-sdk/ZME_Photo.php';
require_once APPPATH . 'third_party/zingme-sdk/ZME_Social.php';
require_once APPPATH . 'third_party/zingme-sdk/ZME_User.php';