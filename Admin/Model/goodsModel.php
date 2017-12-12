<?php 

class goodsModel
	{
		private $db;
		public function __construct()
		{
			$this->db= new DB('goods'); 
		}
		// 加载所有的用户
		public function index($limit,$where='')
		{
			
			$data = $this->db->where($where)->limit($limit)->order('id desc')->select();
			// var_dump($data);die;
			return $data;
		} 
		// 多表联查查询图片goodsimg和goods
		public function msgList($id)
		{
			$photo = $this->db
 						->table('goods g, goodsimg i')
 						->field('i.`id`,`icon`,`face`,`gid`')
					    ->where( 'g.id=i.gid  and g.id='.$id)
 						->select();
 			// var_dump($this->db->sql);
 			// var_dump($data);die;
 			return $photo;
		}
		// 设置封面
		public function setImg($id,$gid,$face)
		{
			// 把相应的商品的id的face先变为2
			$arr['face']=2;
			$data = $this->db->table('goodsimg')
							->where('gid ='.$gid)
							->update($arr);
			// 把相应的goodsimg表的id  face变为1
			$arr2['face']=1;
			$data = $this->db->table('goodsimg')
							->where('id = '.$id.' and gid = '.$gid)
							->update($arr2);
			// var_dump($this->db->sql);
			// var_dump($data);die;
			return $data;
		}
		// 删除图片但不能删除封面
		public function delImg($id,$gid,$face)
		{
			$face = 2;
			$data = $this->db->table('goodsimg')
							->where(' face = '.$face.' and id = '.$id.' and gid = '.$gid)
							->delete();
			// var_dump($this->db->sql);
 			// var_dump($data);die;
			return $data;
		}
// 		public function msgList($id)
// 		{

// 			$data = $this->db
// 						->table('goods g, goodsimg i')
// 						->field('g.`id`, `name`, `price`,`stock`,`up`,`hot`,`addtime`,`uptime`,`cid`, `desc`, `icon`, `sold`')
// 						->where( 'g.id=i.gid and i.face=1 and g.id='.$id)
// 						->find();
// 		$cid = $data['cid'];
// 			// var_dump($cid);die;

// 		$category = new categoryController;
// 		// var_dump($category);die;
// 		$equl = $category->getId();
// 		// var_dump($equal);die;
// 		foreach ($equl as $k => $v) {
// 			$id = $v['id'];
// 			$name = $v['name'];
// 			$arr[$id] = $name;
// 		}
// // ./._dump($arr);die;          
// 		// 让$cid = $id(分类id的名字) 判断值是不是存在
// 		if (array_key_exists($cid, $arr)) {
// 			$data['cid']=$arr[$cid];
// 		}
// 			// var_dump($data);die; 
// 				return $data;
// 		}
		// 添加商品图片
		public function photoAdd($id)
		{ 
			// 1.接收数据

					// 上传文件
			$up = new uploads; 
			$file = $up->singleUP();
			// 判断是否是字符串

			if (is_string($file)) {
				notice($file);
			}
			// 获取文件的名字 因为是一维数组
			// $_POST['icon'] = $file[0];
			// 获取注册时间
			$_POST['uptime'] = time();
			$arr['gid'] = $id;
			$arr['icon'] = $file[0];
			// $arr['face'] = 2;
			$data = $this->db->table('goodsimg')->insert($arr);
			// var_dump($data);die;
			return $data;
		}
		// 添加商品的
		public function doAdd()
		{ 
			// 1.接收数据

					// 上传文件
			$up = new uploads;
			$file = $up->singleUP();
			// 判断是否是字符串

			if (is_string($file)) {
				notice($file);
			}
			// 获取文件的名字 因为是一维数组
			// $_POST['icon'] = $file[0];
			// 获取注册时间
			$_POST['addtime'] = time();
			// $_POST['uptime'] = time();
			// 3.准备sql语句  返回新增的id添加goods表
			$data = $this->db->insert();
			// var_dump($data);die;
			// var_dump($data);die;
			// 如果成功添加了商品 在添加goodsimg表
			if (empty($data)) {
				notice('添加失败');
			}
			$arr['gid'] = $data;
			$arr['icon'] = $file[0];
			$arr['face'] = 1;
			$data = $this->db->table('goodsimg')->insert($arr);
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
			

		
			$_POST['uptime'] = time();

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

		public function doStatus($id,$up)
		{
			// // 把状态看成一个数组去存;
			$arr['up'] = $up;
			$data = $this->db->where('id = '.$id)->update($arr);
		}
		public function doHot($id,$hot)
		{
			// // 把状态看成一个数组去存;
			$arr['hot'] = $hot;
			$data = $this->db->where('id = '.$id)->update($arr);
		}

	}