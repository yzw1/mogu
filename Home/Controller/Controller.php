<?php 
	// 基类
	class Controller
	{ 
		// 判断是否登录
		public function __construct()
		{
			if (empty($_SESSION['home']['link'])) {
				// 如果有cookie先判断cookie的值
				if ($_COOKIE['tel'] && $_COOKIE['pwd']) {
					header('location:index.php?c=login&m=doCookie');die;
				}
			}
			// 没有cookie直接判断session
			if (empty($_SESSION['home']['tel'])) {
				header('location:index.php?c=login');die;
			}

		}
		public function css()
		{
			include 'View/index/css.html';
		}
		public function css_end()
		{
			include 'View/index/css_end.html';
		}
		public function header() 
		{
			include 'View/index/header.html';
		}
		public function middle()
		{
			$model = new Model;
			$cate = $model->getCate();
			include 'View/index/middle.html';
		}
		public function footer()
		{
			include 'View/index/footer.html';
		}
		public function __call($function_name, $args)
		{
		    echo "你所调用的页面地址(<br />";
		    // var_dump($args);
		    echo ")不存在！<h1>磊哥不要改地址</h1>╭－－－－－－╮◑◑◑◑◑◑╭－－－－－－╮ ╰╮学习成功╭╯◢█◣◢█◣╰╮天天开心╭╯ ╭╯╰－－╯╰╮██天天██╭╯╰－－╯╰╮ ║◢█◣◢█◣║◥█快乐█◤║◢█◣◢█◣║ ║██████║ ◥██◤ ║██████║ ║◥█真心█◤║  ◥◤  ║◥█祝福█◤║ ║ ◥██◤ ║◑◑◑◑◑◑║ ◥██◤ ║ ║  ◥◤  ║◑事事如意◑║  ◥◤  ║   ╰  ========= ╯ ◑◑◑◑◑ ╰  ========  ╯ ";
		}

		// 老师的
		// public function logo()
		// {
		// 	// 查询所有的显示的1级分类
		// 	$model = new Model;
		// 	$cate = $model->getCate();
		// 	// $cate1 = $model->getCate1();


		// 	$this->header();
		// 	include 'View/index/logo.html';
		// }


	}

