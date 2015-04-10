<?php
defined ( 'BASEPATH' ) or die ( 'no direct access alowed' );
class TextboxInput extends InputAbstract {
	function __construct($id, $name, $value = null) {
		parent::__construct ( 'text', $id, $name, $value );
		$this->addClass ( 'input-sm form-control' );
	}
}
