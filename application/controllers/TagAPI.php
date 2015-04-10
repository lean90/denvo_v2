<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TagAPI extends BaseController {
	function __construct() {
		parent::__construct ();
	}
	function searchTag() {
		$get = $this->getQueryStringParams ();
		$tagVal = isset ( $get ['value'] ) ? $get ['value'] : '';
		$tagRepository = new TagRepository ();
		$tagRepository->value = $tagVal;
		$tags = $tagRepository->getWhereLike ( T_tag::value, 'both', 10, 0 );
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode ( $tags, true ) );
	}
}