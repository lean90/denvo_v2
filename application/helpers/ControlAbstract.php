<?php
abstract class ControlAbstract extends HTMLAbstract {
	function is_a($class) {
		return is_a ( $this, $class );
	}
	function get_a($class) {
		return is_a ( $this, $class ) ? $this : false;
	}
}
