<?php

/**
 * base for view render.
 * @author ANLT
 * @since 20140312
 */
abstract class AbstractLayout {
	protected $_CI;
	abstract function render($view);
	protected $_metaData = array ();
	protected $_javascript = array ();
	protected $_contentView = '';
	protected $_title = '';
	protected $_css = array ();
	protected $_layout = '';
	protected $_data = array ();
	protected $_autoLoadLanguage = true;
	protected $_breadcrums = array ();
	function __construct() {
		$this->_CI = &get_instance ();
	}
	
	/**
	 * auto attached view
	 * 
	 * @param string $view        	
	 * @param array $data        	
	 */
	protected function attachedView($view, $data = array()) {
		if (! is_array ( $data )) {
			throw new Lynx_ErrorException ( 'data bắt buộc phải là array' );
		}
		if (array_key_exists ( 'view', $data )) {
			throw new Lynx_ErrorException ( 'key [view] đã tồn tại' );
		}
		$item = new warper ();
		$item->view = $view;
		$item->css = $this->_css;
		$item->javascript = $this->_javascript;
		$item->breadcrums = $this->_breadcrums;
		$item->title = $this->_title;
		$data ['view'] = $item;
		return $data;
	}
	function setTitles($title) {
		$this->_title = $title;
		return $this;
	}
	function setBreadcrums($arr) {
		$this->_breadcrums = $arr;
		return $this;
	}
	
	/**
	 * set data for view.
	 * 
	 * @param array $data        	
	 * @param boolean $autoLoadLanguage        	
	 */
	public function setData($data = array()) {
		$this->_data = $data;
		return $this;
	}
	
	/**
	 * set css style.
	 * 
	 * @param string $css        	
	 */
	public function setCss($css = array()) {
		$this->_css += $css;
		return $this;
	}
	
	/**
	 * set javascript
	 * 
	 * @param array $js        	
	 */
	public function setJavascript($js = array()) {
		$this->_javascript += $js;
		return $this;
	}
}
class warper {
}

;
