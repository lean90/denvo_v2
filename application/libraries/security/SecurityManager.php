<?php
/**
 * Cung cấp các hàm liên quan bảo mật của hệ thống
 * @author ANLT 
 * @since 20140401
 *
 */
class SecurityManager {
	
	/**
	 *
	 * @return EncryptionStrategy
	 */
	function getEncrytion() {
		return EncryptionStrategy::inital ();
	}
	
	/**
	 *
	 * @return SecurityManager
	 */
	static function inital() {
		return new SecurityManager ();
	}
}