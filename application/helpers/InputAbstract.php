<?php
defined ( 'BASEPATH' ) or die ();
class InputAbstract extends ControlAbstract {
	function __construct($type, $id, $name, $value = null) {
		$this->setAttribute ( 'type', $type );
		$this->setAttribute ( 'id', $id );
		$this->setAttribute ( 'value', $value );
		$this->setAttribute ( 'name', $name );
	}
	function draw() {
		return "<input " . $this->_getAttributesString () . ">";
	}
}
