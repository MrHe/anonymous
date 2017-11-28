<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
* 话题模型
* 2017-11-28
* author:dilu
*/
class TopicModel extends RelationModel
{
	protected $_link = array(
		"topic_text"	=>	array(
			'mapping_type'	=>	self::HAS_ONE,
			'class_name'	=>	"topic_text",
			'foreign_key' => "topic_id",
			'mapping_fields' =>	'topic_text',
			'as_fields ' => "topic_text:content"
		)
	);
}