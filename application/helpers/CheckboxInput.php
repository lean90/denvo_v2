<?php
defined ( 'BASEPATH' ) or die ( 'no direct access allowed' );
class CheckboxInput extends InputAbstract {
	function __construct($id, $name, $checked = false) {
		parent::__construct ( 'checkbox', $id, $name, 1 );
		if ($checked) {
			$this->setAttribute ( 'checked', 'checked' );
		}
	}
}
