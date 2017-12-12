<?php 
 


 	class loginController extends Controller
 	{
 		private $login;
 		private $v;
 		public function __construct()
 		{
 			$this->login = new loginModel;
 			$this->v = new Validate;
 		}
 		public function index()
 		{
 			include 'View/login/index.html';
 		}
 		public function register()
 		{ 
 			include 'View/login/register.html';
 		}
 		public function doRegister()
 		{
 			$data = $this->login->doRegister();
 			if (empty($data) ){
 				notice('注册失败');
 			}else{
 			notice('注册成功马上跳转到登录请耐心等待','index.php?c=login');
 			}
 		}
 		// 验证码 
 		public function code()
 		{
			$this->v->doimg();
			$c = $this->v->code;
			$_SESSION['code'] = $c;

 		}
 		public function doLogin()
 		{
 			$this->login->doLogin();
 			notice('登录成功','index.php');
 		}
 		public function doCookie()
 		{
 			$data = $this->login->doCookie();
 			header('location: index.php');
 		}
 		// 执行退出
 		public function doLogout()
 		{
 			unset($_SESSION['home']);
 	

 			notice('退出成功','index.php');
 		}
 	}