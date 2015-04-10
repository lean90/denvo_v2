<?php
require_once APPPATH . 'libraries/mail/MailManager.php';
require_once APPPATH . 'libraries/mail/AbstractStaff.php';
require_once APPPATH . 'libraries/mail/ConfirmRegisterMailler.php';
require_once APPPATH . 'libraries/mail/ResetPasswordRegisterMailler.php';
require_once APPPATH . 'libraries/mail/NewPasswordMailler.php';
require_once APPPATH . 'libraries/mail/OrderAskReviewMailler.php';
require_once APPPATH . 'libraries/mail/OrderCancelMailler.php';
require_once APPPATH . 'libraries/mail/OrderDeliveredMailler.php';
require_once APPPATH . 'libraries/mail/OrderFailToDeliveredMailler.php';
require_once APPPATH . 'libraries/mail/OrderRefundOrderMailler.php';
require_once APPPATH . 'libraries/mail/OrderShippingMailler.php';
require_once APPPATH . 'libraries/mail/SellerDeliveredMailler.php';
require_once APPPATH . 'libraries/mail/SellerFailToDeliveredMailler.php';
require_once APPPATH . 'libraries/mail/SellerPaymentVerified.php';
