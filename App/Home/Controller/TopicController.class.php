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
			//根据IP获取缓存
			$temp_user = $this->getCache();
			if($temp_user["topic"] > C("user_max_topic") && !session("?username")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"今天提问次数超出上限"),"json");
			}
			if(time() - $temp_user["last_topic_time"] < C("topic_time") && !session("?username")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"你提问太频繁了，休息一下吧!"),"json");
			}
			$data = array(
				"topic_title" => filter(I("post.topic_title")),
				"topic_time" => time(),
				"topic_poster" => session("?user_id") ? session("user_id") : 0
			);
			$topic_text = I("post.topic_text");
			$topic_text = markdown(I("post.topic_title"));//先进行mark解析
			$topic_text = filter($topic_text);//再进行xss过滤
			if($topic_id = M("topic")->add($data)){
				$text = array(
					'topic_id' => $topic_id,
					'topic_text' => $topic_text
				);
				if(M("topic_text")->add($text)){
					//提问成功缓存加一
					//登录用户不受限制
					if(!session("?username")){
						$temp_user["topic"] += 1;
						$temp_user["last_topic_time"] = time();
						$this->setCache($temp_user);
					}
					$this->ajaxReturn(array("status"=>1,"tips"=>"提问成功!"),"json");
				}else{
					$this->ajaxReturn(array("status"=>0,"tips"=>"提问失败!"),"json");
				}
			}else{
				$this->ajaxReturn(array("status"=>0,"tips"=>"提问失败!"),"json");
			}
		}else{
			die("请勿尝试注入!");
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
		// $topic_length = count($topic_data["post"]);
		// for ($i=0; $i < $topic_length; $i++) { 
		// 	$post = M("post_text")->field("post_text")->find($topic_data["post"][$i]["post_id"]);
		// 	$topic_data["post"][$i]["post_text"] = $post["post_text"];
		// }
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
			//$post[$i]["post_text"] = htmlspecialchars_decode($post[$i]["post_text"]);
			$post[$i]["post_text"] = markdown($post[$i]["post_text"]);
		}
		$topic_data["topic_title"] = htmlspecialchars_decode($topic_data["topic_title"]);//对标题进行过滤
		//话题查看数加一
		M("topic")->where(array("topic_id"=>I("get.id")))->setInc("topic_click",1);
		$topic_data["topic_text"]["topic_text"] = markdown($topic_data["topic_text"]["topic_text"]);
		//判断当前用户是非对本话题收藏
		$map = array(
			'user_id' => session("?user_id") ? session("user_id") : 0,
			'topic_id' => I("get.id")
		);
		if(M("collect")->where($map)->find()){
			$this->assign("collect",true);
		}else{
			$this->assign("collect",false);
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
			$temp_user = $this->getCache();
			if($temp_user["post"] > C("user_max_post")  && !session("?username")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"回复次数超出限制"),"json");
			}
			if(time() - $temp_user["last_post_time"] < C("post_time")  && !session("?username")){
				$this->ajaxReturn(array("status"=>0,"tips"=>"回复过于频繁"),"json");
			}
			$topic_id = I("post.topic_id","intval",0);//获得回复的ID
			$post_text = I("post.post_text");
			$post_text = markdown($post_text);
			$post_text = filter($post_text);
			if(0==$topic_id){
				$this->ajaxReturn(array("status"=>0,"tips"=>"没有找到要回复的问题，该问题有可能已经被删除"),"json");
			}
			$data = array(
				"post_time" => time(),
				"post_poster" => session("?user_id") ? session("user_id") : 0,
				"topic_id" => $topic_id
			);
			if($post_id = M("post")->add($data)){
				$text = array(
					'post_id' => $post_id,
					'post_text' =>	$post_text
				);
				if(M("post_text")->add($text)){
					//回复成功后 回复数加一
					M("topic")->where(array("topic_id"=>$topic_id))->setInc("topic_reply",1);
					//缓存中匿名用户回复数加一
					$temp_user["post"] += 1;
					$temp_user["last_post_time"] = time();
					$this->setCache($temp_user);
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
		$page = new \Think\Page($topic_count,C("page_size"));
		$topic_data = M("topic")->order("topic_time DESC")->join(C("PREFIX")."topic_text ON topic.topic_id = topic_text.topic_id")->limit($page->firstRow.",".$page->listRows)->select();
		$topic_length = count($topic_data);
		for ($i=0; $i < $topic_length; $i++) { 
			//用户判断
			if($user = M("user")->where(array("user_id"=>$topic_data[$i]["topic_poster"]))->find()){
				$topic_data[$i]["topic_poster"] = $user["username"];
				$topic_data[$i]["user_avatar"] = $user["user_avatar"];
			}else{
				$topic_data[$i]["topic_poster"] = "匿名";
				$topic_data[$i]["user_avatar"] = "/Public/images/default.png";
			}
		}
		$page->routerUrl = "/t/[PAGE].html";
		$this->assign("list",$topic_data);
		$this->assign("page",$page->show());
		$this->assign("title","话题");
		$this->display();
	}
	public function _empty(){
		redirect("/404.html");
	}
}