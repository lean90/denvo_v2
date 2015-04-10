<?php
/**
 * Cung cấp các hàm mã hóa và giải mã liên quan đến account;
 * @author ANLT
 * @since 20140331 
 */
class PasswordSecurity {
	CONST ALOG = 'SHA256';
	CONST SALT = '58f890032923e20b3799e4d70c94d38b';
	/**
	 * Thực hiện việc mã hóa active account id.
	 * 
	 * @param User $user        	
	 * @param string $account        	
	 * @param string $datejoin        	
	 */
	function createChangePasswordencrytion($user, $historyKey) {
		$data = array (
				'userid' => $user->id,
				'history' => $historyKey 
		);
		$string = json_encode ( $data );
		$encode = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, self::SALT, $string, MCRYPT_MODE_CBC, md5 ( self::SALT ) );
		return base64_encode ( $encode );
	}
	
	/**
	 * Giải mã active account id.
	 * 
	 * @param string $encoded        	
	 * @return array()
	 */
	function resetPasswrordDencrytion($encoded) {
		$encryt1 = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, self::SALT, base64_decode ( $encoded ), MCRYPT_MODE_CBC, md5 ( self::SALT ) );
		$data = rtrim ( $encryt1, "\0" );
		return json_decode ( $data );
	}
	
	/**
	 * Tạo mật khẩu mặc định cho hệ thống.
	 */
	function regenPassword() {
		return md5 ( uniqid () );
	}
}