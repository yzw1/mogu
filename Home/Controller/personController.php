<?php 
 class personController extends Controller
 {
 	private $person;

 	public function __construct()
 	{
 		parent::__construct();
 		$this->person = new personModel;
 	}
 	public function index()
 	{
 		$xx = $this->person->index();
 		// var_dump($xx);
 		// $xx = 100;
 		include 'View/person/index.html';
 	}
 	// 个人信息
 	public function personMsg()
 	{
 		$data = $this->person->index();
 		// var_dump($data);die;

 		include 'View/person/personMsg.html';
 	}
 	// 完善个人信息
 	public function doPersonMsg()
 	{
 		$data = $this->person->doPersonMsg();
 		if (empty($data)) {
 			notice('修改失败');
 		}else{
 			notice('编辑成功','index.php?c=person&m=personMsg');
 		}
 	}
 	// 修改密码页面
 	public function personPwd()
 	{
 		include 'View/person/personPwd.html';
 	}
 	// 修改密码
 	public function doPersonPwd()
 	{
 		$data = $this->person->doPersonPwd();
 		if (empty($data)) {
 			notice('修改失败');
 		}else{
 			notice('修改成功','index.php?c=person&m=personPwd');
 			// header('location:index.php?c=login');die;
 		}
 	}
 	// 全部订单
 	// public function shopOrder()
 	// {
 	// 	$data = $this->person->shopOrder(); 
 	// 	// var_dump($data);die;
 	// 	include 'View/person/shopOrder.html';
 	// }
 	// 待付款 
 	public function shopOrder1()
 	{
 		$id = $_SESSION['home']['id'];
			// var_dump($id);die;

			$data = $this->person->userOrder($id);
// var_dump($data);die;
			$goods =$data['goods'];
			$order =$data['order'];

			// var_dump($order);die;
			include 'View/person/shopOrder1.html';

 	}
 	// 待收货
 	public function shopOrder2()
 	{
 		$id = $_SESSION['home']['id'];
			// var_dump($id);die;

			$data = $this->person->userOrder($id);
// var_dump($data);die;
			$goods =$data['goods'];
			$order =$data['order'];

			// var_dump($order);die;
			include 'View/person/shopOrder2.html';
 	}
 	// 待发货
 	public function shopOrder3()
 	{
 		$id = $_SESSION['home']['id'];
			// var_dump($id);die;

			$data = $this->person->userOrder($id);
// var_dump($data);die;
			$goods =$data['goods'];
			$order =$data['order'];

			// var_dump($order);die;
			include 'View/person/shopOrder3.html';
 	}
 	// 总体订单
 	// public function shop()
 	// {
 	// 	$this->index();
 	// 	$this->shopOrder();
 	// }

// 
// 实验版
 	public function shopOrder()
		{
			// $tel = $_SESSION['home']['tel'];
			$id = $_SESSION['home']['id'];
			// var_dump($id);die;

			$data = $this->person->userOrder($id);
// var_dump($data);die;
			$goods =$data['goods'];
			$order =$data['order'];

			// var_dump($order);die;
			include 'View/person/shopOrder.html';
		}


 }

