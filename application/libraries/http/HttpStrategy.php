<?php
class HttpStrategy {
	
	/**
	 * Cung cấp các phương thức để thực hiện các http
	 * 
	 * @var AbstractHttpMethods
	 */
	private $_postMethods, $_getMethods, $_putMethods, $_deleteMethods;
	private $_url, $_data, $_any;
	/**
	 *
	 * @param PostMethods $postMethods        	
	 * @param GetMethods $getMethods        	
	 * @param PutMethods $putMethods        	
	 * @param DeleteMethods $deleteMethods        	
	 */
	function __construct($postMethods = null, $getMethods = null, $putMethods = null, $deleteMethods = null) {
		$this->_postMethods = $postMethods == null ? new PostMethods () : $postMethods;
		$this->_getMethods = $getMethods == null ? new GetMethods () : $getMethods;
		$this->_putMethods = $putMethods == null ? new PutMethods () : $putMethods;
		$this->_deleteMethods = $deleteMethods == null ? new DeleteMethods () : $deleteMethods;
	}
	
	/**
	 * Set properties Cho tất cả các methods.
	 * 
	 * @param string $url        	
	 * @param mixed $data        	
	 * @param mixed $any        	
	 * @return HttpStrategy
	 */
	function setProperties($data = null, $any = null) {
		if ($url == null) {
			throw new Lynx_ErrorException ();
		}
		$this->_data = $data;
		$this->_any = $any;
		return $this;
	}
	
	/**
	 * Thực hiện hàm post methods.
	 * 
	 * @param string $url        	
	 * @throws Lynx_ErrorException
	 * @return mixed
	 */
	function post($url) {
		if ($url == null) {
			throw new Lynx_ErrorException ();
		}
		$this->_url = $url;
		$this->_postMethods->setTarget ( $this->_url, $this->_data, $this->_any );
		return $this->_postMethods->execute ();
	}
}