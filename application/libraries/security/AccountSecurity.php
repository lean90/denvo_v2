<?php
/**
 * Cung cấp các hàm mã hóa và giải mã liên quan đến account;
 * @author ANLT
 * @since 20140331 
 */
class AccountSecurity {
	CONST ALOG = 'SHA256';
	CONST SALT = 'bde48788533744a1401e68c684702b7d';
	/**
	 * Thực hiện việc mã hóa active account id.
	 * 
	 * @param string $userId        	
	 * @param string $account        	
	 * @param string $datejoin        	
	 */
	function accountActiveEncrytion($userId, $account, $datejoin) {
		/**
		 * NOTE :
		 */
		$data = array (
				'userid' => $userId,
				'account' => $account,
				'datejoined' => $datejoin 
		);
		return urlencode ( base64_encode ( json_encode ( $data ) ) );
	}
	
	/**
	 * Giải mã active account id.
	 * 
	 * @param string $encoded        	
	 * @return array()
	 */
	function accountActiveDencrytion($encoded) {
		$encoded = urldecode ( $encoded );
		$encoded = base64_decode ( $encoded );
		return json_decode ( $encoded );
	}
}