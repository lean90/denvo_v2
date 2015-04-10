<?php
class FileInput extends InputAbstract {
	function __construct($id, $name, $accept = null, $multiple = false) {
		parent::__construct ( 'file', $id, $name );
		$this->addClass ( 'form-control' );
		if ($accept) {
			$this->setAttribute ( 'accept', $accept );
		}
		if ($multiple) {
			$this->setAttribute ( 'multiple', true );
		}
	}
}
