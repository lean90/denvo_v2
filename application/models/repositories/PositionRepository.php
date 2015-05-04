<?php
class PositionRepository extends BaseRepository {
	protected $_constIntanceName = 'T_position';
	var $fk_category;
    var $name;
    var $description;
    var $latitude;
    var $longitude;
    var $website_link;
    var $position_type;
}