<?php 

   // 1.加载配置文件
		include '../Public/config.php';

	// 2.判断来自控制器还是方法
		$c = empty($_GET['c'])?'index':$_GET['c'];
		$c.= 'Controller';

		$m = empty($_GET['m'])?'index':$_GET['m'];

	// 3.自动加载一些类
		function __autoload($k)
		{
			if (file_exists("Controller/{$k}.php")) {
				include("Controller/{$k}.php");
			}elseif (file_exists("Model/{$k}.php")) {
				include("Model/{$k}.php");
			}elseif (file_exists("../Public/{$k}.php")) {
				include("../Public/{$k}.php");
			}else{
				notice('系统错误','index.php');
			}
		}
		// 4.实力化 类 使用方法
		$contro = new $c;
		$contro->$m();