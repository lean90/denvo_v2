<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class OrderRefundOrder extends AbstractStaff {
	protected $config_key = 'OrderRefundOrder';
	CONST PRODUCT_TEMPLATE = "
                <td style='border:none;'>
                   <img style='width: 100px;height:100px' src='{image}'>
               </td>
	           <td style='border:none;'>
	               <p style='font-size:9.0pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman;color:#333333'>
	                   Item: {name} <br/>
	                   Quantity: {quantity} <br/>
	                   Reason for refund: {comment} <br/>
	               </p>
	           </td>
        ";
	
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
		$produts = '';
		$product_prices = '';
		$shipping_prices = '';
		$total_prices = '';
		
		$this->preOrderInformation ( $order, $name, $order_number, $produts, $product_prices, $shipping_prices, $total_prices );
		$mailContent = str_replace ( '{name}', $name, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		$mailContent = str_replace ( '{produts}', $produts, $mailContent );
		$mailContent = str_replace ( '{product_prices}', $product_prices, $mailContent );
		$mailContent = str_replace ( '{shipping_prices}', $shipping_prices, $mailContent );
		$mailContent = str_replace ( '{total_prices}', $total_prices, $mailContent );
		
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		return $this->CI->email->subject ( $mailLanguage->newpasswordNofication );
	}
	private function preOrderInformation($order, &$name, &$order_number, &$produts, &$product_prices, &$shipping_prices, &$total_prices) {
		foreach ( $order->invoice->contacts as $contact ) {
			if ($this->to == $contact->email_contact) {
				$name = $contact->full_name;
				break;
			}
		}
		
		$produts = '';
		$product_prices = 0;
		$shipping_prices = 0;
		foreach ( $order->invoice->products as $product ) {
			$imageString = $product->sub_image;
			$imageContent = file_get_contents ( $product->sub_image );
			$imageContent = base64_encode ( $imageContent );
			$imageExt = get_mime_by_extension ( $product->sub_image );
			$imageSrc = "data:{$imageExt};base64,{$imageContent}";
			$content .= "<td style='border:none;'>
                           <img style='width: 100px;height:100px' src='{$imageSrc}'>
                       </td>
                       <td style='border:none;'>
                           <p style='font-size:9.0pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman;color:#333333'>
                               Item: {$product->name} <br/>
                               Quantity: {$product->quantity} <br/>
                               Reason for refund: {$order->invoice->comment} <br/>
                           </p>
                       </td>";
			$produts .= $content;
			$product_prices += $product->total_price;
		}
		foreach ( $order->invoice->shippings as $shipping ) {
			$shipping_prices += $shipping->price;
		}
		$total_prices = $product_prices + $shipping_prices;
	}
}