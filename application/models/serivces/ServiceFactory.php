<?php
class ServiceFactory {
	/**
	 *
	 * @return \MailService
	 */
	static function CreateMailSerivce() {
		return new MailService ( get_instance () );
	}
	
	/**
	 *
	 * @return \TicketSupport
	 */
	static function CreateTicketSupport() {
		return new TicketSupport ( get_instance () );
	}
	
	/**
	 *
	 * @return \ExportService
	 */
	static function CreateExportService() {
		return new ExportService ( get_instance () );
	}
}