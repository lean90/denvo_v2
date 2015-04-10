<?php
/**
 * Cung cấp các hàm mã hóa và giải mã liên quan đến login;
 * @author ANLT
 * @since 20140331
 */
class SecretLogin {
	CONST ALOG = 'MD5';
	CONST SALT = '';
	/**
	 * Thực hiện việc mã hóa secret key.
	 * 
	 * @param string $userid        	
	 * @param string $subSessionId        	
	 * @return string
	 */
	function encrytSecretLogin($userid, $subSessionId) {
		return md5 ( $userid . '|' . $subSessionId );
	}
}