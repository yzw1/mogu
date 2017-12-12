<?php 

	class Model
	{
		private $db;

		public function __construct()
		{
			$this->db = new DB('category');
		}

		// 加载所有可见的1级分类
		public function getCate()
		{	
			// select name, id 
			// from category
			// where pid = 0 and display = 1

			$data = $this->db->field('id, name')->where('pid = 0 and display = 1')->select();
			return $data; 
		}
		public function doAdd()
		{
			// 1. 判断数据
				// 1.1 验证电话
					$preg = '/^1[34578]\d{9}$/';

					if( !preg_match($preg, $_POST['tel']) ){
						notice('手机格式不正确');
					}

				// 1.2 验证密码
					if(empty($_POST['pwd'])){
						notice('密码不能为空');
					}

					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}

				// 1.3 上传头像
					$up = new Uploads;
					$file = $up->singleUp();

					if( is_string($file)){
						notice($file);
					}

				// 1.4 其他验证自己写...


			// 2. 完善数据
				// 2.1 删除确认密码
					unset($_POST['repwd']);
				// 2.2 注册时间
					$_POST['regtime'] = time();
				// 2.3 头像名
					$_POST['icon'] = $file[0];

			// 3. 执行insert方法, 返回新增的id
				$data = $this->db->insert();

			// 4. 返回结果
				return $data;

			die;
		}

		public function doDel($id)
		{	
			$data = $this->db->where('id = '.$id)->delete();
			return $data;
		}

		public function find($id)
		{
			$data = $this->db->where('id = '.$id)->find();
			return $data;
		}

		public function doEdit()
		{
			// 1. 判断数据
				// 1.1 验证电话
					$preg = '/^1[34578]\d{9}$/';

					if( !preg_match($preg, $_POST['tel']) ){
						notice('手机格式不正确');
					}

				// 1.2 验证密码
					if(empty($_POST['pwd'])){
						unset($_POST['pwd']);
						unset($_POST['repwd']);
					}

					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}

				// 1.3 上传头像
					$up = new Uploads;

					$isUp = $up->is_up();

					// 编辑状态:  如果上传了文件, 则调用singleUp
					// 			  如果没有上传, 则直接跳过
					if(!$isUp){
						$file = $up->singleUp();

						if( is_string($file)){
							notice($file);
						}
						$_POST['icon'] = $file[0];
					}

				// 1.4 其他验证自己写...

			// 2. 完善数据
			// 3. 执行insert方法, 返回新增的id
				$data = $this->db->update();

			// 4. 返回结果
				return $data;
		}

		public function count($where = '')
		{

			$data = $this->db->field('count(id) as sum')->where($where)->select();
			return $data[0]['sum'];
		}

		public function doStatus($id, $status)
		{
			$arr['status'] = $status;
			$data = $this->db->where('id = '.$id)->update($arr);
		}
	}
