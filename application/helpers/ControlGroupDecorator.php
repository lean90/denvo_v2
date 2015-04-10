<?php
defined ( 'BASEPATH' ) or die ( 'no direct script access allowed' );
class ControlGroupDecorator extends HTMLDecoratorAbstract {
	protected $_labelFor;
	function __construct($labelFor = null, HTMLAbstract $object = null) {
		parent::__construct ( $object );
		$this->_labelFor = $labelFor;
	}
	function draw() {
		ob_start ();
		$input = $this->get_a ( 'ControlAbstract' );
		$inputID = null;
		if ($input) {
			$inputID = $input->attributes ( 'id' );
			if ($input->attributes ( 'data-rule-required' )) {
				$this->_labelFor = "<span class='red' style='font-weight:bolder;'>* </span>" . $this->_labelFor;
			}
		}
		?>
<div class="form-group control-group">
	<label for="<?php echo $inputID ?>" class="col-xs-2 control-label"><?php echo $this->_labelFor ?></label>
	<div class="col-xs-10 controls">
                <?php echo $this->_object?>
            </div>
</div>
<?php
		return ob_get_clean ();
	}
}
