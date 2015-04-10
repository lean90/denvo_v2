<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class ResetPasswordRegisterMailler extends AbstractStaff {
	protected $config_key = "ResetPasswordMailler";
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildContent()
	 */
	protected function buildContent() {
		$this->CI->load->helper ( 'file' );
		$temp = $this->CI->config->item ( 'temp_mail_folder' );
		$temp .= $this->languageKey . '/' . $this->config [MAILLER_TEMP];
		$mailContent = read_file ( $temp );
		$mailContent = str_replace ( '{time}', $this->mailData ['time'], $mailContent );
		$mailContent = str_replace ( '{link}', $this->mailData ['link'], $mailContent );
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		return $mailLanguage->passwordNotify;
	}
}