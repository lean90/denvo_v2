<?php
class TicketSupport {
	protected $_CiInstance;
	protected $config;
	function __construct($ciInstance) {
		$this->_CiInstance = $ciInstance;
	}
	// AdminSupportTicketMailler
	
	/**
	 *
	 * @param string $targetEmail        	
	 * @param string $ccEmails        	
	 * @param \SupportTicketRepository $supportTicketRepository        	
	 */
	function sendSupportOnProfiles($user, $ccEmail, $profile, \SupportTicketRepository $supportTicketRepository) {
		$mailData = array ();
		$url = Common::getCurrentHost ();
		$url = $url . "/profile/{$user->id}/ho-so-rang-mieng?history={$profile->id}";
		
		// send mail to user.
		$supportTicketRepository->user_post = $user->id;
		$supportTicketRepository->ticket_content = "Yêu cầu thực tư vấn hồ sơ răng miệng của : 
                                                    <a href='{$url}' target='_blank'> {$profile->full_name} </a>";
		$ticketId = $supportTicketRepository->insert ();
		
		// send mail to user.
		$mailData ['user'] = $user;
		$mailData ['url'] = $url;
		ServiceFactory::CreateMailSerivce ()->sendMailSupportTicketToUser ( $mailData, $user->email, $ccEmail );
		
		// send mail to admin.
		$mailData ['user'] = $user;
		$mailData ['url'] = $url;
		ServiceFactory::CreateMailSerivce ()->sendMailSupportTicketToAdmin ( $mailData );
		
		return $ticketId;
	}
	function sendSupportOnTeethGrowUp($user, $ccEmail, $profile, \SupportTicketRepository $supportTicketRepository) {
		$mailData = array ();
		$url = Common::getCurrentHost ();
		$url = $url . "/profile/{$user->id}/tuoi-moc-rang?history={$profile->id}";
		
		// send mail to user.
		$supportTicketRepository->user_post = $user->id;
		$supportTicketRepository->ticket_content = "Yêu cầu thực tư vấn tuổi mọc răng của : 
                                                    <a href='{$url}' target='_blank'> {$profile->full_name} </a>";
		$ticketId = $supportTicketRepository->insert ();
		
		// send mail to user.
		$mailData ['user'] = $user;
		$mailData ['url'] = $url;
		ServiceFactory::CreateMailSerivce ()->sendMailSupportTicketToUser ( $mailData, $user->email, $ccEmail );
		
		// send mail to admin.
		$mailData ['user'] = $user;
		$mailData ['url'] = $url;
		ServiceFactory::CreateMailSerivce ()->sendMailSupportTicketToAdmin ( $mailData );
		
		return $ticketId;
	}
}

