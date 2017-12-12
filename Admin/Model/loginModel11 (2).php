  <?php 

 
	class loginModel
	{
		private $db;
		public function __construct()
		{
			$this->db = new DB('admin');
		}
		public function doLogin()
		{
			/* 
			1.判断数据
			判断数据是否为空
			判断满足正则 
			 */
			// 2.查询数据
			$data = $this->db->where('name="'.$_POST['name'].'" and pwd ="'.md5($_POST['pwd']).'"')->find();
			// if (empty($_POST['code'])) {
			// 	notice('验证码不能为空');
			// }
	 		if (empty($data)) {
				notice('账号和密码有误');
			}
			if (strcasecmp($_SESSION['code'],$_POST['code'])) {
				notice('验证码错误');
			}
			// var_dump($_SESSION['code']);
			// var_dump($_POST['code']);die;
			// 3.判断是否查到该用户

			// 4.判断是否勾选强记住我
			// 是 存cookie
			if (!empty($_POST['status'])) {
				setcookie('name',$data['name'],time()+7*24*3600);
				setcookie('pwd',$data['pwd'],time()+7*24*3600);
			}
			// 5.存session
			$_SESSION['admin']['name']=$data['name'];

		}
		public function doCookie()
		{
			// 判断数据格式看是否满足上面的正则条件

			// 查询cookie的值
			$data = $this->db->where('name = "'.$_COOKIE['name'].'" and pwd = "'.$_COOKIE['pwd'].'"')->find();
			// 判断用户是否存在
			if (empty($data)) {
				header('location:index.php?c=login');die;
			}
				// 有数据的话存session
				$_SESSION['admin']['name'] = $data['name'];
				$_SESSION['admin']['link'] = 1;
			

		}
	}

