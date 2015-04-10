<?php
defined ( 'BASEPATH' ) or die ( 'No direct script access allowed' );
require_once __DIR__ . '/HTMLAbstract.php';
require_once __DIR__ . '/ControlAbstract.php';
require_once __DIR__ . '/InputAbstract.php';
require_once __DIR__ . '/HTMLDecoratorAbstract.php';

require_once __DIR__ . '/RadioInput.php';
require_once __DIR__ . '/CheckboxInput.php';
require_once __DIR__ . '/TextboxInput.php';
require_once __DIR__ . '/SelectControl.php';
require_once __DIR__ . '/SelectEnumControl.php';
require_once __DIR__ . '/TextareaControl.php';
require_once __DIR__ . '/ckEditorControl.php';
require_once __DIR__ . '/FileInput.php';

require_once __DIR__ . '/LabelDecorator.php';
require_once __DIR__ . '/ControlGroupDecorator.php';
require_once __DIR__ . '/WrapDecorator.php';
class ViewHelpers {
	protected static $_instance;
	
	/**
	 *
	 * @return static
	 */
	static function getInstance() {
		if (! static::$_instance) {
			static::$_instance = new static ();
		}
		return static::$_instance;
	}
	
	/**
	 *
	 * @param array $assoc        	
	 * @param callable $labelCallback        	
	 * @param array $addtionalParams        	
	 * @return html
	 */
	function options($assoc, $selectedValue = null, $labelCallback = false, $addtionalParams = array()) {
		ob_start ();
		foreach ( $assoc as $k => $v ) {
			$selected = $selectedValue == $k ? 'selected' : '';
			?>
<option value="<?php echo $k ?>" <?php echo $selected ?>>
                <?php echo is_callable($labelCallback) ? call_user_func_array($labelCallback, array_merge(array($v), $addtionalParams)) : $v?>
            </option>
<?php
			echo "\n";
		}
		return ob_get_clean ();
	}
	
	/**
	 * Hiển thị hidden
	 * 
	 * @param type $name        	
	 * @param type $value        	
	 * @param type $id        	
	 */
	function hidden($name, $value, $id = null) {
		ob_start ();
		?>
<input type="hidden" name="<?php echo $name ?>"
	value="<?php echo $value ?>" <?php echo $id ? "id='$id'" : '' ?>>
<?php
		return ob_get_clean ();
	}
}
