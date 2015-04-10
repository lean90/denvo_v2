<?php
defined ( 'BASEPATH' ) or die ();
class WrapDecorator extends HTMLDecoratorAbstract {
	protected $_tagName;
	function __construct($tagName, $class, HTMLAbstract $object = null) {
		parent::__construct ( $object );
		$this->_tagName = $tagName;
		$this->addClass ( $class );
	}
	function draw() {
		return "<{$this->_tagName} " . $this->_getAttributesString () . ">{$this->_object}</{$this->_tagName}>";
	}
}
