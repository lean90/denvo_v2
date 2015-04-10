<?php
defined ( 'BASEPATH' ) or die ( 'no direct script access allowed' );
class LabelDecorator extends HTMLDecoratorAbstract {
	protected $_label;
	function __construct($label, HTMLAbstract $object = null) {
		parent::__construct ( $object );
		$this->_label = $label;
	}
	function draw() {
		$input = $this->get_a ( 'InputAbstract' );
		$inputID = null;
		if ($input) {
			$inputID = $input->attributes ( 'id' );
		}
		return "{$this->_object}<label class=\"inline\" for=\"{$inputID}\">{$this->_label}</label>";
	}
}
