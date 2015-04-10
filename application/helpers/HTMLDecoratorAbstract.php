<?php
defined ( 'BASEPATH' ) or die ( 'no direct script access allowed' );
abstract class HTMLDecoratorAbstract extends HTMLAbstract {
	protected $_object;
	function __construct(HTMLAbstract $object = null) {
		if (is_object ( $object )) {
			$this->set_object ( $object );
		}
	}
	function set_object(HTMLAbstract $object) {
		$this->_object = $object;
		return $this;
	}
	function decorate(HTMLDecoratorAbstract $object) {
		return $object->set_object ( $this );
	}
	function is_a($class) {
		if (is_a ( $this, $class )) {
			return true;
		} else {
			return $this->_object->is_a ( $class );
		}
	}
	function get_a($class) {
		if (is_a ( $this, $class )) {
			return $this;
		} else {
			return $this->_object->get_a ( $class );
		}
	}
}
