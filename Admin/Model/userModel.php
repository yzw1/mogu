<?php 

class userModel
	{
		private $db;
		public function __construct()
		{
			$this->db= new DB('user'); 
		}
		// 加载所有的用户
		public function index($limit,$where='')
		{
			
			$data = $this->db->where($where)->limit($limit)->order('id desc')->select();
			// var_dump($data);die;
			return $data;
		}
		public function doAdd()
		{ 
			// 1.接收数据

			// 2.判断数据的安全性
			// 2.1 手机号的格式
			$preg = '/^1[34578]\d{9}$/';
			if (!preg_match($preg,$_POST['tel'])) {
				notice('格式不正确');
			}
			// 2.2密码是否为空
			if (empty($_POST['pwd'])) {
				notice('密码不能为空');
			}
			// 2.3 两次密码是否一致删除第二次密码
			if ($_POST['pwd']!=$_POST['repwd']) {
				notice('两次密码不一样');
			}else{
				unset($_POST['repwd']);
				$_POST['pwd']=md5($_POST['pwd']);
			}
			// 上传文件
			$up = new uploads;
			$file = $up->singleUP();
			// 判断是否是字符串

			if (is_string($file)) {
				notice($file);
			}
			// 获取文件的名字 因为是一维数组
			$_POST['icon'] = $file[0];
			// 获取注册时间
			$_POST['regtime'] = time();
			// 3.准备sql语句  
			$data = $this->db->insert();
			// var_dump($data);die;
			// var_dump($data);die;
			return $data;
		}
		// 计算总个数
		public function count($where = '')
		{
			$data=$this->db->field('count(id) as sum')->where($where)->select();
			return $data[0]['sum'];
		}
		// 查询单条数据
		public function find($id)
		{
			$data = $this->db->where('id='.$id)->find();
			return $data;
		}
		// 修改数据
		public function doEdit()
		{
			// 验证数据
				// 1.1验证电话
					$preg = '/^1[34578]\d{9}$/';

					if( !preg_match($preg, $_POST['tel']) ){
						notice('手机格式不正确');
					}

				// 1.2验证密码
					if(empty($_POST['pwd'])){
						unset($_POST['pwd']);
						unset($_POST['repwd']);
					}

					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}

				// 1.3上传头像
					$up = new uploads; 
					$isUp=$up->is_up();
					// 表示上传了文件
					if (!$isUp) {
						$file = $up->singleUP();
						if (is_string($file)) {
							notice($file);
						}
						$_POST['icon'] = $file[0];
					}else{
						notice('图片不能为空');
					}
			// 2.完善数据
 
			// 3.执行sql语句   返回新增的id
			$data = $this->db->where('id='.$_POST['id'] )->update();
			return $data;
		}
		public function doDel($id)
		{
			$data = $this->db->where('id='.$id)->delete();
			// var_dump($data);die;
			return $data;
		}
		// 更改状态

		public function doStatus($id,$status)
		{
			// // 把状态看成一个数组去存;
			$arr['status'] = $status;
			$data = $this->db->where('id = '.$id)->update($arr);
		}

	}