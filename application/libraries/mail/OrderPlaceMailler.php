<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class OrderPlaceMailler extends AbstractStaff {
	protected $config_key = 'OrderFailToDeliveredMailler';
	
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
		$phone = '';
		$seller = '';
		$order_number = $order->id;
		$order_shipping_address = '';
		$estimated_time = '';
		$url_order = '';
		
		$mailContent = str_replace ( '{name}', $name, $mailContent );
		$mailContent = str_replace ( '{phone}', $phone, $mailContent );
		$mailContent = str_replace ( '{seller}', $seller, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		$mailContent = str_replace ( '{order_shipping_address}', $order_shipping_address, $mailContent );
		$mailContent = str_replace ( '{estimated_time}', $estimated_time, $mailContent );
		$mailContent = str_replace ( '{url_order}', $url_order, $mailContent );
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		$order = $this->mailData ['order'];
		$subject = $mailLanguage->OrderPlace;
		$subject = str_replace ( '{order_number}', $order->id, $subject );
		return $subject;
	}
	private function preOrderInformation($order, &$name, &$phone, &$seller, &$order_number, &$order_shipping_address, &$estimated_time, &$url_order) {
		foreach ( $order->invoice->contacts as $contact ) {
			if ($this->to == $contact->email_contact) {
				$name = $contact->full_name;
				$phone = $contact->telephone;
				$order_shipping_address = $contact->state_province . ' ,' . $contact->city_district . ' ,' . $contact->street_address;
				$date = date_create ( date ( DatabaseFixedValue::DEFAULT_FORMAT_DATE ) . ' + 3 days' );
				$estimated_time = date_format ( $date, 'g:ia \o\n l jS F Y' );
				break;
			}
		}
		$productProridvers = array ();
		foreach ( $order->invoice->products as $product ) {
			if (! array_key_exists ( $product->seller_id, $productProridvers )) {
				$productProridvers [$product->seller_id] = $product->seller_name;
			}
		}
		$seller = implode ( ', ', $productProridvers );
		$url_order = get_instance ()->config->item ( 'portal_order_place_url_mail' );
		$url_order = str_replace ( '{orderId}', $order->id, $url_order );
		$url_order = str_replace ( '{invoiceId}', $order->invoice->id, $url_order );
		$url_order = Common::getCurrentHost () . $url_order;
	}
}