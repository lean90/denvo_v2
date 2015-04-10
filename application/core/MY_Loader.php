<?php
require_once 'lynx_exceptions.php';
require_once 'lynx_masters.php';
require_once APPPATH . 'libraries/layout/layout.inc';

/**
 * Thêm custom loader.
 * 
 * @author ANLT
 *        
 */
class MY_Loader extends CI_Loader {
    
    function __construct(){
        $this->_ci_ob_level  = ob_get_level();
		$this->_ci_library_paths = array(APPPATH, BASEPATH);
		$this->_ci_helper_paths = array(APPPATH, BASEPATH);
		$this->_ci_model_paths = array(APPPATH);
		$this->_ci_view_paths = array(APPPATH.VIEW_PATH	=> TRUE);
    }
    
}