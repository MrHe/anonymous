<?php
namespace Home\Controller;
use Think\Controller;
/**
* 话题控制器
* 2017-11-28
* author:dilu
*/
class TopicController extends CommonController
{
	/**
	 * [post 发布一个话题]
	 * @return [json] [操作结果]
	 */
	public function post(){
		if(IS_POST){
			$data = array(
				"topic_title" => I("post.topic_title"),
				"topic_time" => time(),
				"topic_poster" => isset($user_id)?$user_id:0
			);
			$topic_text = I("post.topic_text");
			if($topic_id = M("topic")->add($data)){
				$text = array(
					'topic_id' => $topic_id,
					'topic_text' => $topic_text
				);
				if(M("topic_text")->add($text)){
					$this->ajaxReturn(array("status"=>1,"tips"=>"提问成功!"));
				}else{
					$this->ajaxReturn(array("status"=>0,"tips"=>"提问失败!"));
				}
			}else{
				$this->ajaxReturn(array("status"=>0,"tips"=>"提问失败!"));
			}
			$this->ajaxReturn(array("status"=>1),"json");
		}else{
			
		}
	}
	/**
	 * [view 查看一个话题]
	 * @return [type] [void]
	 */
	public function view(){
		$topic = D("topic");
		$topic_data = $topic->relation(true)->find(I("get.id"));
		if(!$topic_data){
			$this->error("没有找到这个问题!");
		}
		//通过post的id找回复的内容
		$topic_length = count($topic_data["post"]);
		for ($i=0; $i < $topic_length; $i++) { 
			$post = M("post_text")->field("post_text")->find($topic_data["post"][$i]["post_id"]);
			$topic_data["post"][$i]["post_text"] = $post["post_text"];
		}
		//判断用户名
		if(0 == $topic_data["topic_poster"]){//如果为0则为匿名用户
			$topic_data["topic_poster"] = "匿名";
		}else{
			$userdata = M("user")->field("username")->find($topic_data["topic_poster"]);
			$topic_data["topic_poster"] = $userdata["username"];
		}
		//选取所有的回复
		$post = M("post")->where(array("topic_id"=>I("get.id")))->join("post_text ON post.post_id = post_text.post_id")->order("post_time DESC")->select();
		$post_length = count($post);
		for ($i=0; $i < $post_length; $i++) { 
			$post[$i]["post_time"] = timespan($post[$i]["post_time"]);
			if($user = M("user")->find($post[$i]["post_poster"])){
				$post[$i]["post_poster"] = $user["username"];
			}else{
				$post[$i]["post_poster"] = "匿名用户";
			}
		}
		$this->assign("post",$post);
		$this->assign("title",$topic_data["topic_title"]);
		$this->assign("list",$topic_data);
		$this->assign("post_time",timespan($topic_data["topic_time"]));
		$this->display();
	}
	public function ask(){
		$this->display();
	}
	/**
	 * [reply 回复一个话题]
	 * @return [type] [void]
	 */
	public function reply(){
		if(IS_POST){
			$topic_id = I("post.topic_id","intval",0);//获得回复的ID
			$post_text = I("post.post_text");
			
			if(0==$topic_id){
				$this->ajaxReturn(array("status"=>0,"tips"=>"没有找到要回复的问题，该问题有可能已经被删除"),"json");
			}

			$data = array(
				"post_time" => time(),
				"post_poster" => isset($user_id) ? $user_id : 0,
				"topic_id" => $topic_id
			);
			if($post_id = M("post")->add($data)){
				$Parsedown = new \Org\Util\Parsedown();
				$res = $Parsedown->text($post_text);
				$res = remove_xss($res);//先进行xss过滤
				$res = htmlspecialchars($res);//对html标签进行转义
				$text = array(
					'post_id' => $post_id,
					'post_text' =>	$res
				);
				if(M("post_text")->add($text)){
					$this->ajaxReturn(array("status"=>1,"tips"=>"回复成功"),"json");
				}else{
					$this->ajaxReturn(array("status"=>0,"tips"=>"回复失败"),"json");
				}
			}else{
				$this->ajaxReturn(array("status"=>0,"tips"=>"回复失败"),"json");
			}
			
		}else{
			$this->error("请不要尝试hack");
		}
	}
	public function show(){
		$topic_count = M("topic")->count();
		dump(I("get."));
		$page = new \Think\Page($topic_count,5);
		$topic_data = M("topic")->order("topic_time DESC")->join(C("PREFIX")."topic_text ON topic.topic_id = topic_text.topic_id")->limit($page->firstRow.",".$page->listRows)->select();
		$this->assign("list",$topic_data);
		$this->assign("page",$page->show());
		$this->assign("title","话题");
		$this->display();
	}
}