<?php
defined ( 'BASEPATH' ) or die ( 'no direct access allowed' );
class RadioInput extends InputAbstract {
	function __construct($id, $name, $value = null) {
		parent::__construct ( 'radio', $id, $name, $value );
	}
}
