<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class SellerDeliveredMailler extends AbstractStaff {
	protected $config_key = 'SellerDelivered';
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildContent()
	 */
	protected function buildContent() {
		$this->CI->load->helper ( 'file' );
		$temp = $this->CI->config->item ( 'temp_mail_folder' );
		$temp .= $this->languageKey . '/' . $this->config [MAILLER_TEMP];
		$mailContent = read_file ( $temp );
		
		$order = $this->mailData ['order'];
		
		$seller_name = '';
		$order_number = $order->id;
		$buyer_name = '';
		$buyer_contact = '';
		$buyer_phone = '';
		
		$this->preOrderInformation ( $order, $order_number, $seller_name, $buyer_name, $buyer_contact, $buyer_phone );
		
		$mailContent = str_replace ( '{seller_name}', $seller_name, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		$mailContent = str_replace ( '{buyer_name}', $buyer_name, $mailContent );
		$mailContent = str_replace ( '{buyer_contact}', $buyer_contact, $mailContent );
		$mailContent = str_replace ( '{buyer_phone}', $buyer_phone, $mailContent );
		
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		$subject = $mailLanguage->SellerOrderDelivered;
		return $subject;
	}
	private function preOrderInformation($order, &$order_number, &$seller_name, &$buyer_name, &$buyer_contact, &$buyer_phone) {
		foreach ( $order->invoice->products as $product ) {
			if ($product->seller_email == $this->to) {
				$seller_name = $product->seller_name;
				break;
			}
		}
		
		foreach ( $order->invoice->shippings as $shipping ) {
			if ($shipping->shipping_type == DatabaseFixedValue::SHIPPING_TYPE_SHIP && $shipping->status == DatabaseFixedValue::SHIPPING_STATUS_ACTIVE) {
				$buyer_name = $shipping->contact->full_name;
				$buyer_contact = "{$shipping->contact->street_address} , {$shipping->contact->city_district}, {$shipping->contact->state_province}";
				$buyer_phone = $shipping->contact->telephone;
				break;
			}
		}
	}
}