<?php
class BaseRepository extends CI_Model {
	protected static $_date;
	/**
	 *
	 * @param bool $forceQuery
	 *        	Lấy lại date từ DB, false lấy có sẵn
	 * @return string
	 */
	static function getDate($forceQuery = false) {
		if ($forceQuery || ! static::$_date) {
			$CI = get_instance ();
			$CI->load->database ();
			$query = $CI->db->query ( "SELECT NOW() as 'now' " );
			$result = $query->result ();
			static::$_date = $result [0]->now;
		}
		return static::$_date;
	}
	static function getUUID() {
		$CI = get_instance ();
		$CI->load->database ();
		$query = $CI->db->query ( "SELECT UUID() as 'UUID' " );
		$result = $query->result ();
		return $result [0]->UUID;
	}
	protected $_constIntanceName = null;
	public $id;
	public $created_at;
	public $deleted_at;
	public $delete;
	function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	
	/**
	 * get function
	 */
	public function getOneById() {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		$id = $class::id;
		$this->db->where ( $id, $this->id );
		$query = $this->db->get ( $class::tableName );
		$result = $query->result ();
		return $result;
	}
	/**
	 *
	 * @param unknown $col        	
	 * @param string $wildcard
	 *        	(before | after | both | none)
	 * @throws Lynx_Exception
	 */
	public function getWhereLike($col, $wildcard, $limit = null, $offset = null) {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		
		$class = $this->_constIntanceName;
		$this->$col = isset ( $this->$col ) ? $this->$col : '';
		$this->db->like ( $col, $this->$col, $wildcard );
		
		if ($limit != null) {
			if ($offset != null) {
				$this->db->limit ( $offset, $limit );
			} else {
				$this->db->limit ( $limit );
			}
		}
		
		$query = $this->db->get ( $class::tableName );
		$result = $query->result ();
		return $result;
	}
	
	/**
	 *
	 * @param unknown $col        	
	 * @param string $wildcard
	 *        	(before | after | both | none)
	 * @throws Lynx_Exception
	 */
	public function getWhereGte($col, $limit = null) {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		foreach ( $propertiesList as $property ) {
			if ($property == $class::tableName || ! isset ( $this->$property ) || $this->$property === null) {
				continue;
			}
			if ($col == $property) {
				$this->$col = isset ( $this->$col ) ? $this->$col : '';
				$condition [$property . ' >= '] = $this->$property;
				continue;
			}
			$condition [$property] = $this->$property;
		}
		if ($limit != null) {
			$this->db->limit ($limit);
		}
		$query = $this->db->get_where( $class::tableName, $condition);
		$result = $query->result ();
		return $result;
	}
	
	/**
	 *
	 * @param unknown $col        	
	 * @param string $wildcard
	 *        	(before | after | both | none)
	 * @throws Lynx_Exception
	 */
	public function getWhereLte($col, $limit = null) {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		foreach ( $propertiesList as $property ) {
			if ($property == $class::tableName || ! isset ( $this->$property ) || $this->$property === null) {
				continue;
			}
			if ($col == $property) {
				$this->$col = isset ( $this->$col ) ? $this->$col : '';
				$condition [$property . ' <= '] = $this->$property;
				continue;
			}
			
			$condition [$property] = $this->$property;
		}
		if ($limit != null) {
			$this->db->limit ($limit);
		}
		$query = $this->db->get_where ( $class::tableName, $condition );
		$result = $query->result ();
		return $result;
	}
	public function insert() {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		$this->created_at = self::getDate ();
		$data = array ();
		foreach ( $propertiesList as $property ) {
			
			if ($property == $class::tableName || ! isset ( $this->$property ) || $this->$property == null) {
				continue;
			}
			$data [$property] = $this->$property;
		}
		
		$this->db->insert ( $class::tableName, $data );
		return $this->db->insert_id ();
	}
	public function delete() {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		$id = $class::id;
		$this->delete = 1;
		$this->deleted_at = $this->getDate ();
		$data = array ();
		foreach ( $propertiesList as $property ) {
			
			if ($property == $class::tableName || ! isset ( $this->$property )) {
				continue;
			}
			$data [$property] = $this->$property;
		}
		$this->db->where ( $id, $this->$id );
		$this->db->update ( $class::tableName, $data );
		return $this->db->insert_id ();
	}
	public function updateById() {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( 'Model không hỗ trợ' );
		}
		
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		$id = $class::id;
		$data = array ();
		foreach ( $propertiesList as $property ) {
			
			if ($property == $class::tableName || ! isset ( $this->$property )) {
				continue;
			}
			$data [$property] = $this->$property;
		}
		$this->db->where ( $id, $this->$id );
		$this->db->update ( $class::tableName, $data );
		return $this->db->insert_id ();
	}
	
	/**
	 *
	 * @param array $array
	 *        	là danh sách của model tương ứng
	 */
	public function bacthInsert($objects) {
		if (! isset ( $this->_constIntanceName ) || $this->_constIntanceName == null) {
			throw new Lynx_Exception ( __CLASS__ . ' ' . __FUNCTION__ . 'Model không hỗ trợ' );
		}
		$ids = array ();
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		$id = $class::id;
		
		$data = array ();
		foreach ( $objects as &$obj ) {
			if (get_class ( $this ) != get_class ( $obj )) {
				throw new Lynx_Exception ( __CLASS__ . ' ' . __FUNCTION__ . ' Gói dữ liệu chưa đúng' );
			}
			$oneRow = array ();
			foreach ( $propertiesList as $property ) {
				if ($property == $class::tableName || ! isset ( $obj->$property ) || $obj->$property == null) {
					continue;
				}
				$oneRow [$property] = $obj->$property;
			}
			
			$this->db->insert ( $class::tableName, $oneRow );
			$oneRow [$id] = $this->db->insert_id ();
			$obj->id = $oneRow [$id];
			array_push ( $data, $oneRow );
		}
		return $objects;
	}
	
	/**
	 *
	 * @param
	 *        	array row of query result
	 */
	public function autoMappingObj($result) {
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		
		$class = $this->_constIntanceName;
		$data = array ();
		foreach ( $propertiesList as $property ) {
			if ($property == $class::tableName || ! isset ( $result->$property )) {
				continue;
			}
			$this->$property = $result->$property;
		}
	}
	/**
	 * lấy dữ liệu trong trường hợp có nhiều điều kiện.
	 * chỉ lấy từ 1 table.
	 * 
	 * @param string $orderProperty        	
	 * @param string $orderLogic        	
	 * @param number $limit        	
	 * @param number $offset        	
	 * @return multitype:
	 */
	public function getMutilCondition($orderProperty = null, $orderLogic = 'asc', $limit = null, $offset = null) {
		$condition = array ();
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		foreach ( $propertiesList as $property ) {
			if ($property == $class::tableName || ! isset ( $this->$property ) || $this->$property === null) {
				continue;
			}
			
			$condition [$property] = $this->$property;
		}
		if ($orderProperty != null) {
			$this->db->order_by ( $orderProperty, $orderLogic );
		}
		if ($limit != null) {
			if ($offset != null) {
				$this->db->limit ( $limit, $offset );
			} else {
				$this->db->limit ( $limit );
			}
		}
		
		$queryResult = $this->db->get_where ( $class::tableName, $condition );
		
		$result = $queryResult->result ();
		return $result;
	}
	
	/**
	 * lấy dữ liệu trong trường hợp có nhiều điều kiện.
	 * chỉ lấy từ 1 table.
	 * 
	 * @param string $orderProperty        	
	 * @param string $orderLogic        	
	 * @param number $limit        	
	 * @param number $offset        	
	 * @return multitype:
	 */
	public function getCountCondition($orderProperty = null, $orderLogic = 'asc', $limit = null, $offset = null) {
		$condition = array ();
		$refl = new ReflectionClass ( $this->_constIntanceName );
		$propertiesList = $refl->getConstants ();
		$class = $this->_constIntanceName;
		foreach ( $propertiesList as $property ) {
			if ($property == $class::tableName || ! isset ( $this->$property ) || $this->$property === null) {
				continue;
			}
			
			$condition [$property] = $this->$property;
		}
		$this->db->where ( $condition );
		$queryResult = $this->db->count_all_results ( $class::tableName );
		return $queryResult;
	}
	
	/**
	 * Get Where in expected one col
	 * 
	 * @param unknown $property        	
	 * @param unknown $values        	
	 * @return multitype:
	 */
	public function getWhereIn($property, $values) {
		if (count ( $values ) == 0) {
			return array ();
		}
		$class = $this->_constIntanceName;
		$this->db->where_in ( $property, $values );
		$query = $this->db->get ( $class::tableName );
		$result = $query->result ();
		return $result;
	}
}