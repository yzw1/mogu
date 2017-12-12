<?php   
	class goodsController  extends Controller
	{
		private $goods;
		public function __construct()
		{
			// parent::__construct();
			$this->goods= new goodsModel;
		} 
		// 商品列表页
		public function index()
		{
			$page = new page;

			// 求分页的总个数 count加where条件是为模糊查询准备的，不加按下一页会失效
			// $count = $this->goods->count();
			// // 求分页
			// $limit = $page->getLimit($count,AP);
			// // if ($count <0) {
			// // 	notice('查询不存在');
			// // }
			// $data = $this->goods->index($limit);
			
			$id = $_GET['id'];
			$data = $this->goods->goodsList($id);
			
			include 'View/goods/index.html';
		}
		// 商品详情页
		public function detail()  
		{
			$id = $_GET['id'];
			$data = $this->goods->detail($id);
			$goods = $data[0];
			$img = $data[1];
			// var_dump($data);die;

			include 'View/goods/detail.html';
		}
		// public function shopcar()
		// {
		// 	$id = $_GET['id'];
		// 	$this->goods->shopcar($id);
		// 	$this->showCar();
		// }
		// // 加载购物车页面
		// public function showCar()
		// {
		// 	include 'View/goods/showcar.html';
		// }
		// // 删除购物车数量
		// public function doDel()
		// {
		// 	$id = $_GET['id'];
		// 	unset($_SESSION['shop'][$id]);
		// 	header('location:index.php?c=goods&m=showCar');die;
		// }
		// // 去付款页面
		// public function rightshop()
		// {
		// 	$_SESSION['order'] = $_SESSION['shop'];
		// 	include 'View/goods/rightshop.html';

		// }
		// // 支付成功页面
		// public function shopwin()
		// {

		// 	include 'View/goods/shopwin.html';
		// }
		
		// // 购物车加数量
		// public function add()
		// {
		// 	$id = $_GET['id'];
		// 	$count = $this->getCount($id);
		// 	$stock = $this->getStock($id);

		// 	if( $count >= $stock  ){
		// 		$_SESSION['shop'][$id]['count'] = $count;
		// 	}else{
		// 		$_SESSION['shop'][$id]['count']++;
		// 	}

		// 	header('location: index.php?c=goods&m=showCar'); die;
		// }

		// // 购物车减数量
		// public function sub()
		// {
		// 	$id = $_GET['id'];

		// 	$count = $this->getCount($id);

		// 	if( $count <= 1 ){
		// 		$_SESSION['shop'][$id]['count'] = 1;
		// 	}else{
		// 		$_SESSION['shop'][$id]['count']--;
		// 	}

		// 	header('location: index.php?c=goods&m=showCar'); die;
		// }

		// // 获取商品id对应的数量
		// public function getCount($id)
		// {
		// 	return $_SESSION['shop'][$id]['count'];
		// }

		// // 获取商品id对应的库存
		// public function getStock($id)
		// {
		// 	return $_SESSION['shop'][$id]['stock'];
		// }
	}
