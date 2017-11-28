<?php
namespace Home\Controller;
use Think\Controller;
/**
* 用户控制器
* 2017-11-28
* author:dilu
*/
class UserController extends CommonController
{
	/**
	 * [login github登录]
	 * @return [type] [void]
	 */
	public function login(){
		$code = I("get.code");
		if(!$code){
			$url = "https://github.com/login/oauth/authorize?client_id=".C("key")."&scope=read:user";
			header('Location:'.$url);
		}else{
			$url = "https://github.com/login/oauth/access_token?client_id=".C("key")."&client_secret=".C("secert")."&code=".$code;
			$res = file_get_contents($url);
			parse_str($res,$arr);
			if(!isset($arr["access_token"])){
				$this->error("授权失败,请返回刷新重试!");
			}else{
				$access_token = $arr["access_token"];
			}
			

			$url = "https://api.github.com/user?access_token=".$arr["access_token"];
			$client = new \Org\Util\Curl();
			$res = $client->request($url,"get",false,["User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36"]);
			$res = json_decode($res[0],true);//把结果转成数组格式
			if($user = M("user")->where(array("github_id"=>$res["id"]))->find()){
				session("username",$user["username"]);
				$this->success("登录成功!");
			}else{
				$data["username"] = $res["login"];
				$data["user_avatar"] = $res["avatar_url"];
				$data["github_id"] = $res["id"];
				if(M("user")->add($data)){
					session("username",$res["login"]);
					$this->success("登录成功!","/t");
				}else{
					$this->error("登录失败!");
				}
			}
		}
	}
	/**
	 * [info 显示用户资料]
	 * @return [type] [description]
	 */
	public function info(){
		//$this->Login_Check();
		dump(session(""));
	}
}