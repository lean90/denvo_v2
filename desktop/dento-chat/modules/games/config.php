<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* SETTINGS START */

$keywords = 'adult, naughty, 18+, dating, hot, sex,rango, interested,';
$partner_id='113d63be0f2eb0b4';

/* SETTINGS END */

$keywordlist = '';

if (!empty($keywords)) {
	$keywordsarray = explode(',',$keywords);
	foreach ($keywordsarray as $keyword) {
		if($keyword){
		$keyword = trim($keyword);
		$keyword = preg_replace('/[^\w\d_ -]/si', '', $keyword);
		$keywordlist .= '|'.$keyword.'';
		}
	}
	$keywordlist = substr($keywordlist,1);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
