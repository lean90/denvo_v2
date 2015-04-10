<?php
/**
 * class thực hiện việc chuyển mail Confirm
 * @author ANLT
 * @since 20140330
 */
class SellerFailToDeliveredMailler extends AbstractStaff {
	protected $config_key = 'SellerFailToDeliveredMailler';
	CONST PRODUCT_ITEM = "
               <td style='border:none;'>
                   <img style='width: 100px;height:100px' src='{image}'>
               </td>
               <td style='border:none;'>
                   <p style='font-size:9.0pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman;color:#333333'>
                        Item: {product_name}<br/>
                        Quantity: {quantity}<br/>
                        Price: {price}<br/>
                        Buyer: {buyer_name}<br/>
                        {buyer_contact<br/>
                        {buyer_phone} <br/>
                   </p>
               </td>";
	
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
		$products = '';
		
		$this->preOrderInformation ( $order, $order_number, $seller_name, $products );
		
		$mailContent = str_replace ( '{seller_name}', $seller_name, $mailContent );
		$mailContent = str_replace ( '{order_number}', $order_number, $mailContent );
		$mailContent = str_replace ( '{products}', $products, $mailContent );
		return $mailContent;
	}
	
	/*
	 * (non-PHPdoc) @see AbstractStaff::buildTitle()
	 */
	protected function buildTitle() {
		$mailLanguage = MultilLanguageManager::getInstance ()->getLangViaScreen ( 'mail', $this->languageKey );
		return $mailLanguage->SellerOrderRejected;
		;
	}
	private function preOrderInformation($order, &$order_number, &$seller_name, &$products) {
		$productCollection = array ();
		foreach ( $order->invoice->products as $product ) {
			if ($product->seller_email == $this->to) {
				$seller_name = $product->seller_name;
				array_push ( $productCollection, $product );
			}
		}
		$buyerContact = null;
		foreach ( $order->invoice->shippings as $shipping ) {
			if ($shipping->shipping_type == DatabaseFixedValue::SHIPPING_TYPE_SHIP && $shipping->status == DatabaseFixedValue::SHIPPING_STATUS_ACTIVE) {
				$buyerContact = $shipping->contact;
				break;
			}
		}
		
		foreach ( $productCollection as $productItem ) {
			if (! file_exists ( $productItem->sub_image )) {
				$productItem->sub_image = Common::getCurrentHost () . '/images/no-images.jpg';
			}
			
			$imageContent = file_get_contents ( $productItem->sub_image );
			$imageContent = base64_encode ( $imageContent );
			$imageExt = get_mime_by_extension ( $productItem->sub_image );
			$imageSrc = "data:{$imageExt};base64,{$imageContent}";
			$contentProductItem = "<td style='border:none;'>
                   <img style='width: 100px;height:100px' src='{$imageSrc}'>
               </td>
               <td style='border:none;'>
                   <p style='font-size:9.0pt;font-family:Arial,sans-serif;mso-fareast-font-family:Times New Roman;color:#333333'>
                        Item: {$productItem->name}<br/>
                        Quantity: {$productItem->quantity}<br/>
                        Price: {$productItem->total_price}<br/>
                        Buyer: {$buyerContact->full_name}<br/>
                        {$buyerContact->street_address}, {$buyerContact->city_district}, {$buyerContact->state_province}<br/>
                        {$buyerContact->telephone} <br/>
                   </p>
               </td>";
			$products .= $contentProductItem;
		}
	}
}