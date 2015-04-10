<?php
/**
 * class base cho tất cả các dạng http methods.
 * @author ANLT
 * @since 20140318
 */
abstract class AbstractHttpMethods {
	protected abstract function executeMethod();
	protected abstract function setProperties($url, $data, $any);
	
	/**
	 * Thực hiện methods
	 * 
	 * @return string httpResult;
	 */
	function execute() {
		return $this->executeMethod ();
	}
	
	/**
	 *
	 * @param string $url        	
	 * @param mixed $data        	
	 * @param mixed $any        	
	 */
	function setTarget($url, $data, $any) {
		$this->setProperties ( $url, $data, $any );
	}
}