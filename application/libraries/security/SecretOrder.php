<?php
/**
 * Cung cấp các hàm mã hóa và giải mã liên quan đến order;
 * @author ANLT
 * @since 20140331
 */
class SecretOrder {
	CONST ALOG = 'MD5';
	
	/**
	 * create Ecrytion item.
	 * 
	 * @param string $orderid        	
	 * @param string $sessionSub        	
	 * @param string $userId        	
	 * @return string
	 */
	function encrytSecretOrder($orderid, $sessionSub, $userId) {
	}
	
	/**
	 * Mã hóa dữ liệu của order.
	 * 
	 * @param mixed $data        	
	 * @return string
	 */
	function encrytOrderData($data) {
	}
}