<?php
namespace Home\Controller;
use Think\Controller;
/**
* 收藏相关控制器
*/
class CollectController extends CommonController
{
	public function show(){

	}
	/**
	 * [add 添加一个收藏]
	 */
	public function add(){
		if(IS_AJAX){
			$topic_id = I("post.topic_id","intval",0);
			if(0 == $topic_id){
				$this->ajaxReturn(array("status"=>0,"tips"=>"收藏失败!"),"json");
			}
			if(!session("?user_id")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"请先登录!"),"json");
			}
			$data = array(
				'topic_id' => $topic_id,
				'user_id' => session("user_id"),
				'time'	=>	time()
			);
			if(M("collect")->add($data)){
				$this->ajaxReturn(array("status"=>1,"tips"=>"收藏成功"),"json");
			}else{
				$this->ajaxReturn(array("status"=>0,"tips"=>"收藏失败!"),"json");
			}
		}else{

		}
	}
	/**
	 * [del 删除一个收藏]
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_AJAX){
			$topic_id = I("post.topic_id","intval",0);
			if(0 == $topic_id){
				$this->ajaxReturn(array("status"=>0,"tips"=>"取消收藏失败!"),"json");
			}
			if(!session("?user_id")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"请先登录!"),"json");
			}
			$data = array(
				'topic_id' => $topic_id,
				'user_id' => session("user_id")
			);
			if(M("collect")->where($data)->delete()){
				$this->ajaxReturn(array("status"=>1,"tips"=>"取消收藏成功"),"json");
			}else{
				$this->ajaxReturn(array("status"=>0,"tips"=>"取消收藏失败!"),"json");
			}
		}else{
			
		}
	}
}