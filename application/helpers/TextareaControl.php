<?php
defined ( 'BASEPATH' ) or die ( 'no direct access allowed' );
class TextareaControl extends ControlAbstract {
	protected $_value;
	function __construct($id, $name, $value = null) {
		$this->setAttribute ( 'id', $id );
		$this->setAttribute ( 'name', $name );
		$this->_value = $value;
		$this->addClass ( 'form-control input-sm' );
	}
	function draw() {
		return '<textarea ' . $this->_getAttributesString () . '>' . $this->_value . '</textarea>';
	}
}
