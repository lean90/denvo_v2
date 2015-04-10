<?php
defined ( 'BASEPATH' ) or die ( 'no direct script access allowed' );
class SelectControl extends ControlAbstract {
	protected $_options = array ();
	protected $_value;
	function __construct($id, $name, $options, $value = null) {
		$this->setAttribute ( 'id', $id );
		$this->setAttribute ( 'name', $name );
		$this->_options = $options;
		$this->_value = $value;
		$this->addClass ( 'input-sm form-control' );
		
		if (! is_array ( $options )) {
			throw new InvalidArgumentException ( '$options must be array, ' . gettype ( $options ) . ' passed' );
		}
	}
	function draw() {
		ob_start ();
		?>
<select <?php echo $this->_getAttributesString() ?>>
            <?php foreach ($this->_options as $k => $v): ?>
                <?php $selected = $k == $this->_value ? 'selected' : ''?>
                <option value="<?php echo $k ?>" <?php echo $selected ?>><?php echo $v; ?></option>
            <?php endforeach; ?>
        </select>
<?php
		return ob_get_clean ();
	}
	function addOption($key, $value, $prepend = false) {
		$this->_options = $prepend ? array (
				$key => $value 
		) + $this->_options : $this->_options + array (
				$key => $value 
		);
		return $this;
	}
	function getOptions() {
		return $this->_options;
	}
	function setOption($key, $value) {
		if (isset ( $this->_options [$key] )) {
			$this->_options [$key] = $value;
		} else {
			$this->addOption ( $key, $value );
		}
		return $this;
	}
}
