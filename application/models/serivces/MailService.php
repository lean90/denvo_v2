<?php
class MailService {
	CONST CONFIG_KEY = 'RegistorMailler';
	CONST CONFIG_ADMIN_SUPPORT_KEY = 'AutoSupportTicketMailler';
	CONST CONFIG_ADMIN_SUPPORT_FOR_ADMIN_KEY = 'AutoSupportTicketForAdminMailler';
	CONST CONFIG_ADMIN_INTERVIEW_FOR_ADMIN_KEY = 'AutoSendInterviewMailToAdminMailler';
	CONST CONFIG_CONTACT_MAIL_ADMIN_KEY = 'ContactMailMailler';
	CONST CONFIG_LOST_PASSWORD = 'LostPasswordMailler';
	protected $_CiInstance;
	protected $config;
	function __construct($ciInstance) {
		$this->_CiInstance = $ciInstance;
	}
	
	/**
	 *
	 * @param array $data        	
	 * @param string $to
	 *        	- email
	 */
	function sendMailRegistor($data, $to) {
		$this->initalEmail ( self::CONFIG_KEY );
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $to );
		$subject = 'Đăng ký tài khoản dento.vn';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		
		$this->_CiInstance->email->send ();
	}
	function sendMailSupportTicketToUser($data, $to, $cc) {
		$this->initalEmail ( self::CONFIG_ADMIN_SUPPORT_KEY );
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $to );
		if ($cc != '' && $cc != null) {
			$this->_CiInstance->email->cc ( $cc );
		}
		$subject = 'Yêu cầu tư vấn dento.vn';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		
		$this->_CiInstance->email->send ();
	}
	function sendMailSupportTicketToAdmin($data) {
		$this->initalEmail ( self::CONFIG_ADMIN_SUPPORT_FOR_ADMIN_KEY );
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $this->_CiInstance->config->item ( 'AdminSupportTicketMailler' ) );
		$subject = '[YÊU CẦU TƯ VẤN] Thông báo nhận yêu cầu tư vấn';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		$this->_CiInstance->email->send ();
	}
	function sendMailInterview($data, $filePath) {
		$this->initalEmail ( self::CONFIG_ADMIN_INTERVIEW_FOR_ADMIN_KEY );
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $this->_CiInstance->config->item ( 'AdminInterviewMailler' ) );
		$subject = '[ỨNG TUYỂN] Thông báo nhận ứng tuyển';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		if ($filePath != null) {
			$this->_CiInstance->email->attach ( getcwd () . $filePath );
		}
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		$this->_CiInstance->email->send ();
	}
	function sendMailContact($data) {
		$this->initalEmail ( self::CONFIG_CONTACT_MAIL_ADMIN_KEY );
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $this->_CiInstance->config->item ( 'ContactMailler' ) );
		$subject = '[LIÊN HỆ] Thông báo nhận liên hệ';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		$this->_CiInstance->email->send ();
	}
	function initalEmail($maillerName) {
		$this->config = $this->_CiInstance->config->item ( $maillerName );
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
		$this->_CiInstance->load->library ( 'email' );
		$this->_CiInstance->email->initialize ( $config );
	}
	function sendMailResetPassword($user, $pas) {
		$this->initalEmail ( self::CONFIG_LOST_PASSWORD );
		$url = $this->_CiInstance->config->item("reset_password");
		$url = str_replace("{user}", $user->id, $url);
		$url = str_replace("{password}", md5($pas), $url);
		
		$data = array (
				'user' => $user,
				'pw' => $pas,
		        'url'=> $url,
		);
		
		$fullName = $this->config [MAILLER_FULLNAME];
		$email = $this->config [MAILLER_USER];
		$this->_CiInstance->email->from ( $email, $fullName );
		$this->_CiInstance->email->to ( $user->us );
		$subject = 'Khôi phục mật khẩu';
		$msg = $this->_CiInstance->load->view ( $this->config [MAILLER_TEMP], $data, true );
		$this->_CiInstance->email->subject ( $subject );
		$this->_CiInstance->email->message ( $msg );
		$this->_CiInstance->email->send ();
	}
}

