<?php 
 
 // 基类
class Controller
{
	// 判断是否登录
	public function __construct()
	{
		// 单列模式
		if (empty($_SESSION['admin']['link']))
	    {
			// 如果有cookie先判断cookie的值
			if ($_COOKIE['name'] && $_COOKIE['pwd']) {
				header('location:index.php?c=login&m=doCookie');die;
			}
			
		}
		// 没有cookie直接判断session
		if (empty($_SESSION['admin']['name'])) {
			header('location:index.php?c=login');die;
		}
	}
	public function __call($function_name, $args)
		{
		    echo "你所调用的页面地址：(<br />";
		    // var_dump($args);
		    echo "不存在！<h1>磊哥不要改地址</h1>╭－－－－－－╮◑◑◑◑◑◑╭－－－－－－╮ ╰╮学习成功╭╯◢█◣◢█◣╰╮天天开心╭╯ ╭╯╰－－╯╰╮██天天██╭╯╰－－╯╰╮ ║◢█◣◢█◣║◥█快乐█◤║◢█◣◢█◣║ ║██████║ ◥██◤ ║██████║ ║◥█真心█◤║  ◥◤  ║◥█祝福█◤║ ║ ◥██◤ ║◑◑◑◑◑◑║ ◥██◤ ║ ║  ◥◤  ║◑事事如意◑║  ◥◤  ║   ╰  ========= ╯ ◑◑◑◑◑ ╰  ========  ╯ ";
		    // include 'View/category/text.html';
		}
}
