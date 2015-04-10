<?php
defined ( 'DS' ) or die ( 'no direct access allowed' );
class SelectEnumControl extends SelectControl {
	function __construct($id, $name, $listtypeCode, $value = null) {
		$options = ListMapper::make ()->select ( 'id, name', true )->filterListtype ( $listtypeCode )->findAssoc ();
		parent::__construct ( $id, $name, $options, $value );
	}
}
