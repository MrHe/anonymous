<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
* 回复模型
* 2017-11-28
* author:dilu
*/
class PostModel extends RelationModel
{
	protected $_link = array(
		"post_text"	=>	array(
			'mapping_type'	=>	self::HAS_ONE,
			'class_name'	=>	"post_text",
			'foreign_key' => "post_id",
			'mapping_fields' =>	'post_text'
		)
	);
}