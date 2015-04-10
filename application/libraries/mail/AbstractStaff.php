<?php
/**
 * MAIL STAFF
 * @author ANLT
 * @since 20140327
 */
abstract class AbstractStaff {
	CONST MAIL_CONTENT_TYPE_HTML = "MIME-Version: 1.0
         Content-type: text/html; charset=UTF-8
        ";
	CONST MAIL_CONTENT_TYPE_TEXT = "";
	protected $config_key = NULL;
	protected $CI;
	protected abstract function buildTitle();
	protected abstract function buildContent();
	protected $to;
	protected $mailData;
	protected $languageKey;
	protected $config;
	function __construct() {
		$this->CI = & get_instance ();
		if ($this->config_key == null || ! isset ( $this->config_key ) || $this->config_key == '') {
			throw new Lynx_ModelMiscException ( __FILE__ . ' ' . __LINE__ . ' MAIL THIẾU CONFIG' );
		}
		$this->config = $this->CI->config->item ( $this->config_key );
		$config = array ();
		$config ['protocol'] = $this->config [MAILLER_PROTOCOL];
		$config ['useragent'] = $this->config [MAILLER_USERAGENT];
		$config ['smtp_host'] = $this->config [MAILLER_HOST];
		$config ['smtp_user'] = $this->config [MAILLER_USER];
		$config ['smtp_pass'] = $this->config [MAILLER_PASS];
		$config ['smtp_port'] = $this->config [MAILLER_PORT];
		$config ['smtp_timeout'] = $this->config [MAILLER_TIMEOUT];
		$config ['mailtype'] = $this->config [MAILLER_TYPE];
		$config ['newline'] = $this->config [MAILLER_NEWLINE];
		$config ['charset'] = 'utf-8';
		$this->CI->load->library ( 'email' );
		$this->CI->email->initialize ( $config );
	}
	
	/**
	 *
	 * @param field_type $to        	
	 * @return AbstractStaff
	 */
	public function setTo($to, $languageKey = 'VN-VI') {
		$this->to = $to;
		$this->languageKey = $languageKey;
		return $this;
	}
	
	/**
	 *
	 * @param field_type $mailData        	
	 * @return AbstractStaff
	 */
	public function setMailData($mailData) {
		$this->mailData = $mailData;
		return $this;
	}
	
	/**
	 * Thực hiện việc gửi mail
	 */
	function send() {
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->CI->email->from ( $email, $fullName );
		$this->CI->email->to ( $this->to );
		$subject = $this->buildTitle ();
		$msg = $this->buildContent ();
		$this->CI->email->subject ( $subject );
		$this->CI->email->message ( $msg );
		$this->CI->email->send ();
	}
}