<?php

/**
 * Create tow columns layout.
 * 
 * @author ANLT
 * @author
 *
 */
class MainDetail extends AbstractLayout {
	
	/*
	 * (non-PHPdoc) @see AbstractLayout::render()
	 */
	public function render($view) {
		$data = $this->_data;
		$data = $this->attachedView ( $view, $data );
		$this->_CI->load->view ( $this->_layout, $data );
		return $this;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractLayout::__construct()
	 */
	public function __construct() {
		parent::__construct ();
		$this->_layout = 'layout/maindetail';
	}
}