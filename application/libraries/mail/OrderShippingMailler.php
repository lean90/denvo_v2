<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class OrderShippingMailler extends AbstractStaff {
	protected $config_key = 'OrderShipping';
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		$order = $this->mailData ['order'];
		$subject = $mailLanguage->OrderShipping;
		$subject = str_replace ( '{order_number}', $order->id, $subject );
		return $subject;
	}
	
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
		$contact = '';
		$phone = '';
		$estimated_time = '';
		$order_url = '';
		$this->preOrderInformation ( $order, $name, $contact, $phone, $estimated_time, $order_url );
		$mailContent = str_replace ( '{name}', $name, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		$mailContent = str_replace ( '{contact}', $contact, $mailContent );
		$mailContent = str_replace ( '{phone}', $phone, $mailContent );
		$mailContent = str_replace ( '{estimated_time}', $estimated_time, $mailContent );
		$mailContent = str_replace ( '{order_url}', $order_url, $mailContent );
		return $mailContent;
	}
	private function preOrderInformation($order, &$name, &$order_shipping_address, &$phone, &$estimated_time, &$order_url) {
		foreach ( $order->invoice->shippings as $shipping ) {
			$contact = $shipping->contact;
			if ($shipping->status != DatabaseFixedValue::SHIPPING_STATUS_ACTIVE) {
				continue;
			}
			// TODO: DEMO ĐỊA CHỈ MAIL ĐỂ TEST NÊN THỬ LẠI.
			if ($this->to == $contact->email_contact || $this->to == 'lethanhan.bkaptech@gmail.com') {
				$name = $contact->full_name;
				$phone = $contact->telephone;
				$order_shipping_address = $contact->state_province . ' ,' . $contact->city_district . ' ,' . $contact->street_address;
				$date = date_create ( date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE ) . ' + 3 days' );
				$estimated_time = date_format ( $date, 'g:ia \o\n l jS F Y' );
				break;
			}
		}
		$order_url = '/portal/help';
		$order_url = Common::getCurrentHost () . $order_url;
	}
}