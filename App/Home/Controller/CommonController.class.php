<?php
namespace Home\Controller;
use Think\Controller;
/**
* 公共控制器
* 2012-11-28
* author:dilu
*/
class CommonController extends Controller
{
	/**
	 * [_initialize 初始化函数]
	 * @return [type] [description]
	 * 判断是否登录但是不强制转跳
	 */
	public function _initialize(){
		if(session("?username")){
			$userdata = M("user")->where(array("username"=>session("username")))->find();
			$this->assign("user",$userdata);
		}else{
			$this->assign("user",false);
		}
	}
	/**
	 * [Login_Check 登录检查 自带强制转跳]
	 */
	public function Login_Check(){
		if(!session("?username")){
			redirect("/u");
		}
	}
}