<?php 

	// 配置文件
	define('DSN', 'mysql:dbname=s70;host=localhost;charset=utf8');
	define('USER', 'root');
	define('PWD', '');

	header('content-type: text/html; charset=utf-8');
	error_reporting(E_ALL ^E_NOTICE);
	date_default_timezone_set("PRC");
	session_start();

	include 'function.php';

	// 后台的css, js 和image的地址
	define('AC', 'Include/css/');
	define('AJ', 'Include/js/');
	define('AI', 'Include/images/');

	// 前台的css, js 和image的地址
	define('HC', 'Include/css/');
	define('HJ', 'Include/js/');
	define('HI', 'Include/images/');
	// 是每页的个数
	define('AP',6);
	