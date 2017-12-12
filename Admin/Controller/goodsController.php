<?php   
	class goodsController  extends Controller
	{
		private $goods;
		public function __construct()
		{
			parent::__construct();

			$this->goods= new goodsModel;
		}
		public function index()
		{
			if (empty($_GET['search'])) {
				$where='';
			}else{
				$where = 'orderNum like "%'.$_GET['search'].'%"';
			}
			// if ($_GET['search']) {
			// 	notice('你查询的数据不存在');
			// }
			// 分页
			$page = new Page;
			// 求分页的总个数 count加where条件是为模糊查询准备的，不加按下一页会失效
			$count = $this->goods->count($where);
			// 求分页
			$limit = $page->getLimit($count,AP);
			// if ($count <0) {
			// 	notice('查询不存在');
			// }
			$data = $this->goods->index($limit,$where);
			
			// var_dump($data);die;
			include 'View/goods/index.html';
		}
		public function add()
		{
			// 服装 2
			// 	男装 3
			// 		西装 4
			// 		衬衫 4
			// 	女装 3 
			// 		裙子 4 
			// 		旗袍 4
			// 食品 2
			// 	垃圾食品 3 

			// select  concat(path, id, ',') as px, name, id
			// from category
			// order by px
			$category = new categoryModel;
			$data = $category->getCate();
			// 来区分不同类别等级
			foreach ($data as $k => $v) {
				// 统计有多少个逗号来区分不同的类别 1级 2级。。。。
					$num = substr_count($v['px'], ',')-2;
				// 把逗号变为空格
					$nbsp = str_repeat('&nbsp;', $num*5);
				// 把空格放到data数组里
					$data[$k]['nbsp'] = $nbsp;
			}
			include 'View/goods/add.html';
		}
		public function doAdd() 
		{
			$data = $this->goods->doAdd();
			// var_dump($data);
			// var_dump($_POST);
			// var_dump($_FILES);die;
			if (empty($data)) { 
			  
				notice('添加失败');
			}else{
			notice('添加成功','index.php?c=goods');
			}
		}
		public function msg()
		{
			// 获取本条数据的id
			$id = $_GET['id'];
			$data = $this->goods->msgList($id);
			// var_dump($data);die;
			
			include 'View/goods/msg.html';
		}
		// 编辑商品图片的
		public function photoEdit()
		{ 
			// 获取本条数据的id
			$id = $_GET['id'];
			$photo = $this->goods->msgList($id);
			// var_dump($data);die;
			include 'View/goods/photo.html';
		} 
		// 设置封面
		public function setImg()
		{
			$id = $_GET['id'];
			$gid = $_GET['gid'];
			$face = $_GET['face'];
			$data = $this->goods->setImg($id,$gid,$face);
			if (empty($data)) {
				notice('修改失败'); 
			}else{
				notice('修改成功','','1');
				// header(location:$_SERVER['HTTP_REFERER']');die;
			}
		}
		// 删除封面
		public function delImg()
		{
			$id = $_GET['id'];
			$gid = $_GET['gid'];
			$face = $_GET['face'];
			$data = $this->goods->delImg($id,$gid,$face);
			if (empty($data)) {
				notice('删除失败:(,不能删除封面'); 
			}else{
				notice('修改成功:)');
			}

		}
		// 对商品封面编辑后进行提交
		public function dophotoEdit()
		{
			$id = $_POST['id'];
			 // 通过moudel进行编辑
			$data = $this->goods->photoAdd($id);
			if (empty($data)) {
				notice('编辑失败');
			}else{
				notice('编辑成功','index.php?c=goods');
			}
		}

		// 编辑商品的
		public function edit()
		{
			// 获取本条数据的id
			$id = $_GET['id'];
			$data = $this->goods->find($id);
			
			include 'View/goods/edit.html';
		}
		public function doEdit()
		{
			 // 通过moudel进行编辑
			$data = $this->goods->doEdit();
			if (empty($data)) {
				notice('编辑失败');
			}else{
				notice('编辑成功','index.php?c=goods');
			}
		}
		public function doDel() 
		{
			// 如果删成功跳转结果不对 就是db类没返回数据
			// 获取id数据看删谁
			$id = $_GET['id'];
			$data = $this->goods->doDel($id);
			// var_dump($data);
			if (empty($data)) {
				notice('删除失败');
			}else{
				notice('删除成功','index.php?c=goods');
			}

		}
		// 进行上架下架状态修改
		public function doStatus()
		{
			$id = $_GET['id'];
			$up = $_GET['up']==1?2:1;
			// var_dump($status);die;
			$data = $this->goods->doStatus($id,$up);
			header('location:index.php?c=goods');die;
		}
		// 进行热销滞销状态修改
		public function doHot()
		{
			$id = $_GET['id'];
			$hot = $_GET['hot']==1?2:1;
			// var_dump($id,$hot);die;
			$data = $this->goods->doHot($id,$hot);
			// var_dump($data);die;
			header('location:index.php?c=goods');die;
		}

	}
