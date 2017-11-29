<?php
namespace Home\Controller;
use Think\Controller;
/**
* 空的控制器
*/
class EmptyController extends Controller
{
	public function index(){
		redirect("/404.html");
	}
}