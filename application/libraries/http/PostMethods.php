<?php
class PostMethods extends AbstractHttpMethods {
	CONST METHODS = 'POST';
	CONST HTTP_HEADER = 'Content-type: application/x-www-form-urlencoded\r\n';
	private $_url, $_data, $_any;
	/*
	 * (non-PHPdoc) @see AbstractHttpMethods::executeMethod()
	 */
	protected function executeMethod() {
		// TODO Auto-generated method stub
		$options = array (
				'http' => array (
						'header' => "Content-type: application/x-www-form-urlencoded\r\n",
						'method' => 'POST',
						'content' => http_build_query ( $this->_data ) 
				) 
		);
		$context = stream_context_create ( $options );
		$result = file_get_contents ( $this->_url, false, $context );
		return $result;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractHttpMethods::setProperties()
	 */
	protected function setProperties($url, $data, $any) {
		$this->_url = $url;
		$this->_data = $data;
		$this->_any = $any;
	}
}