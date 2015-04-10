<?php
defined ( 'BASEPATH' ) or die ();
abstract class HTMLAbstract {
	protected $_attributes = array ();
	abstract function draw();
	abstract function is_a($class);
	abstract function get_a($class);
	function setAttribute($name, $value) {
		$this->_attributes [$name] = $value;
		return $this;
	}
	function attributes($name = null) {
		if ($name) {
			return isset ( $this->_attributes [$name] ) ? $this->_attributes [$name] : null;
		} else {
			return $this->_attributes;
		}
	}
	function addClass($class) {
		$attr = $this->attributes ( 'class' );
		if ($attr == null) {
			$this->setAttribute ( 'class', $class );
		} else {
			$classes = explode ( ' ', $attr );
			if (! in_array ( $class, $classes )) {
				$classes [] = $class;
			}
			$this->setAttribute ( 'class', implode ( ' ', $classes ) );
		}
		return $this;
	}
	function removeClass($class) {
		$attr = $this->attributes ( 'class' );
		if ($attr != null) {
			$classes = explode ( ' ', $attr );
			$found = array_search ( $class, $classes );
			if ($found !== false) {
				unset ( $classes [$found] );
				$this->setAttribute ( 'class', implode ( ' ', $classes ) );
			}
		}
		return $this;
	}
	protected function _getAttributesString() {
		$str = '';
		foreach ( $this->attributes () as $attr => $val ) {
			$str .= "$attr=\"$val\" ";
		}
		return $str;
	}
	function __toString() {
		return $this->draw ();
	}
}
