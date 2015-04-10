<?php

       include dirname(dirname(dirname(_FILE_))).DIRECTORY_SEPARATOR."cometchat_init.php";
       
       if(isset($_REQUEST['username']) && isset($_REQUEST['password']) && $_REQUEST['password']!= '' && $_REQUEST['username']!= '' ) {
               echo chatLogin($_REQUEST['username'],$_REQUEST['password']);    
       }
?>