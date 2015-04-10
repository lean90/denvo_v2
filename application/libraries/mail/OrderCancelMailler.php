<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class OrderCancelMailler extends AbstractStaff {
	protected $config_key = 'OrderCancel';
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildContent()
	 */
	protected function buildContent() {
		$this->CI->load->helper ( 'file' );
		$temp = $this->CI->config->item ( 'temp_mail_folder' );
		$temp .= $this->languageKey . '/' . $this->config [MAILLER_TEMP];
		$mailContent = read_file ( $temp );
		$order = $this->mailData ['order'];
		$name = '';
		$order_number = $order->id;
		$this->preOrderInformation ( $order, $name, $order_number );
		$mailContent = str_replace ( '{name}', $name, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		return $mailLanguage->orderCancel;
	}
	private function preOrderInformation($order, &$name, &$order_number) {
		foreach ( $order->invoice->shippings as $shipping ) {
			$contact = $shipping->contact;
			if ($this->to == $contact->email_contact) {
				$name = $contact->full_name;
				break;
			}
		}
	}
}