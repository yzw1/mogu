<?php 
 
 
	class loginModel
	{
		private $db;
		public function __construct()
		{
			$this->db = new DB('user');
		}
		public function doLogin()
		{
			/*
			1.判断数据
			判断数据是否为空
			判断满足正则 
			 */
			// 2.1 手机号的格式
			// 2.2密码是否为空
			if (empty($_POST['tel'])) {
				notice('手机不能为空');
			}
			$preg = '/^1[34578]\d{9}$/';
			if (!preg_match($preg,$_POST['tel'])) {
				notice('格式不正确');
			}
			// 2.查询数据
			$data = $this->db->where('tel="'.$_POST['tel'].'" and pwd ="'.md5($_POST['pwd']).'"')->find();
			// var_dump($this->db->sql);
			// var_dump($data);die;
			// 3.判断是否查到该用户
			if (empty($data)) {
				notice('账号和密码有误');
			}
			
			// 5.存session
			$_SESSION['home']['tel']=$data['tel'];
			$_SESSION['home'] = $data;
			// var_dump($_SESSION['home']);die;

		}
		// 注册
		public function doRegister()
		{
			// 判断电话是否正确
			// 2.1 手机号的格式
			$data = $this->db->where('tel='.$_POST['tel'])->find();
			// var_dump($data);die;
			if ($_POST['tel'] == $data['tel']) {
				notice('手机号已经注册');
			}

			$preg = '/^1[34578]\d{9}$/';
			if (!preg_match($preg,$_POST['tel'])) {
				notice('手机格式不正确:(');
			}
			$preg = '/^\d{3}$/';
			if (!preg_match($preg,$_POST['pwd'])) {
				notice('密码必须为数字:(');
			}
			// 2.2密码是否为空
			if (empty($_POST['pwd'])) {
				notice('密码不能为空');
			}else{
				$_POST['pwd'] = htmlentities($_POST['pwd']);
				$_POST['pwd'] = md5($_POST['pwd']);
			}
			// 注册时间
			$_POST['regtime'] = time();
			// 判断验证码是不是正确
			if (strcasecmp($_POST['code'], $_SESSION['code'])) {
				notice('验证码不正确');
			}
			$arr['tel'] = $_POST['tel'];
			$arr['pwd'] = $_POST['pwd'];
			$arr['regtime'] = $_POST['regtime'];

			// 插入数据表
			$data = $this->db->table('user')->insert($arr);
			// var_dump($this->db->sql);
			// var_dump($data);
			return $data;
		}
		public function doCookie()
		{
			// 判断数据格式看是否满足上面的正则条件

			// 查询cookie的值
			$data = $this->db->where('tel = "'.$_COOKIE['tel'].'" and pwd = "'.$_COOKIE['pwd'].'"')->find();
			// 判断用户是否存在
			if (empty($data)) {
				header('location:index.php?c=login');die;
			}
				// 存session
				$_SESSION['home']['tel'] = $data['tel'];
				$_SESSION['home']['link'] = 1;
			

		}
	}

