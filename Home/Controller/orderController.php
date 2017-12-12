<?php 

class orderController extends Controller
{
	private $order;
	public function __construct()
	{
		parent::__construct();
		$this->order= new orderModel;
	}
	public function index() 
	{	
		// var_dump($_SESSION);die;
		// var_dump($_POST);
		$data = $this->order->index();
		// var_dump($data);die;
		if (empty($data)) {
			notice('数据有误');
		}else{ 
			header('location:index.php?c=order&m=waitPay');die;
		}

	}
	public function waitPay()
	{
		// var_dump($_SESSION);die;

		$data = $this->order->waitPay();
		// var_dump($data);die;
		if (!empty($data)) { 
		include 'View/order/index.html';
		}else{
			notice('请完成相关信息');
		}
	}
	public function payTrue() 
	{
		unset($_SESSION['shop']);
		$data = $this->order->waitPay();
		 $payTrue = $this->order->payTrue(); 
		 // var_dump($payTrue);
		include 'View/order/shopwin.html';
	}
// 订单购物车
         public function shopcar()
		{
			$id = $_GET['id'];
			$this->order->shopcar($id);
			$this->showCar();
		}
		// 加载购物车页面
		public function showCar()
		{
			include 'View/goods/showcar.html';
		}
		// 删除购物车数量
		public function doDel()
		{
			$id = $_GET['id'];
			unset($_SESSION['shop'][$id]);
			header('location:index.php?c=order&m=showCar');die;
		}
		// 去付款页面
		public function rightshop()
		{
			$_SESSION['order'] = $_SESSION['shop'];
			include 'View/goods/rightshop.html';

		}
		// 支付成功页面
		public function shopwin()
		{

			include 'View/goods/shopwin.html';
		}
		
		// 购物车加数量
		public function add()
		{
			$id = $_GET['id'];
			$count = $this->getCount($id);
			$stock = $this->getStock($id);

			if( $count >= $stock  ){
				$_SESSION['shop'][$id]['count'] = $count;
			}else{
				$_SESSION['shop'][$id]['count']++;
			}

			header('location: index.php?c=order&m=showCar'); die;
		}

		// 购物车减数量
		public function sub()
		{
			$id = $_GET['id'];

			$count = $this->getCount($id);

			if( $count <= 1 ){
				$_SESSION['shop'][$id]['count'] = 1;
			}else{
				$_SESSION['shop'][$id]['count']--;
			}

			header('location: index.php?c=order&m=showCar'); die;
		}

		// 获取商品id对应的数量
		public function getCount($id)
		{
			return $_SESSION['shop'][$id]['count'];
		}

		// 获取商品id对应的库存
		public function getStock($id)
		{
			return $_SESSION['shop'][$id]['stock'];
		}
	// 所有订单的方法
	// 支付状态的改变
	public function isPay()
	{
		$id = $_GET['id'];
		$isPay = $_GET['isPay']==2?1:1;
		$data = $this->order->doIsPay($id,$isPay);
		if (empty($data)) {
			notice('已经支付过了,非常理解您的善意但是我们不能要');
		}else{
			notice('支付成功','index.php?c=person&m=shopOrder1');
		}
		// header('location:index.php?c=person&m=shopOrder1');die;
	}
	// 订单的状态
	public function cancel()
	{
		$id = $_GET['id'];
		$cancel = $_GET['cancel']==2?1:1;
		$data = $this->order->doCancel($id,$cancel);
		if (empty($data)) {
			notice('已经成功取消,请不要淘气哦');
		}else{
			notice('取消成功','index.php?c=person&m=shopOrder1');
		}
	}
	public function cancel1()
	{
		$id = $_GET['id'];
		$cancel = $_GET['cancel']==2?1:1;
		$data = $this->order->doCancel($id,$cancel);
		if (empty($data)) {
			notice('已经成功取消,请不要淘气哦');
		}else{
			notice('取消成功','index.php?c=person&m=shopOrder3');
		}
	}
	// 收货状态
	public function status()
	{
		$id = $_GET['id'];
		$status = $_GET['status']==3;
		$data = $this->order->doStatus($id,$status);
		if (empty($data)) {
			notice('已经成功收货,请不要淘气哦');
		}else{
			notice('收货成功','index.php?c=person&m=shopOrder2');
		}
	}




}

