<?php
/**
 * Hỗ trợ việc gửi mail
 * @author ANLT
 * @since 20140330
 */
class MailManager {
	CONST TYPE_RESG_COMFIRM = 'RESGTER_COMFRIM';
	CONST TYPE_RESETPASSWORD_COMFRIM = 'RESETPASSWORD_COMFRIM';
	CONST TYPE_NEWPASSWORD_NOFICATION = 'NEWPASSWORD_NOFICATION';
	CONST ORDER_PLACES = 'ORDER_PLACES';
	CONST ORDER_ASK_REVIEW = 'ORDER_ASK_REVIEW';
	CONST ORDER_CANCEL = 'ORDER_CANCEL';
	CONST ORDER_DELIVERED = 'ORDER_DELIVERED';
	CONST ORDER_FAIL_TO_DELIVERED = 'ORDER_FAIL_TO_DELIVERED';
	CONST ORDER_REFUND = 'ORDER_REFUND';
	CONST ORDER_SHIPPING = 'ORDER_SHIPPING';
	CONST SELLER_DELIVERED = 'SELLER_DELIVERED';
	CONST SELLER_FAIL_TO_DELIVERED = 'SELLER_FAIL_TO_DELIVERED';
	CONST SELLER_PAYMENT_VERIFIED = 'SELLER_PAYMENT_VERIFIED';
	
	/**
	 * Người dùng request gửi mail.
	 * 
	 * @param string $type
	 *        	MailManager::CONST
	 * @param string $target
	 *        	email address
	 * @param array $mailData
	 *        	MailData
	 */
	function requestSendMail($type, $target, $mailData) {
		$staff = null;
		switch ($type) {
			case self::TYPE_RESG_COMFIRM :
				$staff = new ConfirmRegisterMailler ();
				break;
			case self::TYPE_RESETPASSWORD_COMFRIM :
				$staff = new ResetPasswordRegisterMailler ();
				break;
			case self::TYPE_NEWPASSWORD_NOFICATION :
				$staff = new NewPasswordMailler ();
				break;
			case self::ORDER_PLACES :
				$staff = new OrderPlaceMailler ();
				break;
			case self::ORDER_ASK_REVIEW :
				$staff = new OrderAskReviewMailler ();
				break;
			case self::ORDER_CANCEL :
				$staff = new OrderCancelMailler ();
				break;
			case self::ORDER_DELIVERED :
				$staff = new OrderDeliveredMailler ();
				break;
			case self::ORDER_REFUND :
				$staff = new OrderRefundOrder ();
				break;
			case self::ORDER_FAIL_TO_DELIVERED :
				$staff = new OrderFailToDeliveredMailler ();
				break;
			case self::ORDER_SHIPPING :
				$staff = new OrderShippingMailler ();
				break;
			case self::SELLER_DELIVERED :
				$staff = new SellerDeliveredMailler ();
				break;
			case self::SELLER_FAIL_TO_DELIVERED :
				$staff = new SellerFailToDeliveredMailler ();
				break;
			case self::SELLER_PAYMENT_VERIFIED :
				$staff = new SellerPaymentVerifiedMailler ();
				break;
			default :
				throw new Lynx_EmailException ( __CLASS__ . '::requestSendMail Không hỗ trợ định dạng mail này' );
				break;
		}
		$staff->setMailData ( $mailData )->setTo ( $target )->send ();
	}
	
	/**
	 *
	 * @return MailManager
	 */
	static function initalAndSend($type, $target, $mailData) {
		$mail = new MailManager ();
		if ($target == null || ! isset ( $target )) {
			$mailData = var_export ( $mailData, true );
			throw new Lynx_BusinessLogicException ( __FILE__ . ' ' . __LINE__ . " Không có địa chỉ nhận mail :{$type},{$mailData}" );
		}
		
		$mail->requestSendMail ( $type, $target, $mailData );
	}
}