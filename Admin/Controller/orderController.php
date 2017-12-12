<?php 

class orderController extends Controller
{
	private $order;
	public function __construct()
	{
		parent::__construct();
		$this->order = new orderModel;

	}
	public function index()
	{
		if (empty($_GET['search'])) {
				$where='';
			}else{
				$where = 'orderNum like "%'.$_GET['search'].'%"';
			}
			// 分页
			$page = new Page;
			// 求分页的总个数 count加where条件是为模糊查询准备的，不加按下一页会失效
			$count = $this->order->count($where);
			// 求分页
			$limit = $page->getLimit($count,AP);
			// if ($count <0) {
			// 	notice('查询不存在');
			// }
		$order1 = $this->order->index($limit,$where);
		if (empty($order1)) {
			notice('没有此数据');
		}
		include 'View/order/index.html';
	}
	// 发货状态
	public function doStatus()
	{
		$id = $_GET['id'];
		$status = $_GET['status']=1?2:1;
		// 
		$data = $this->order->doStatus($id,$status);
		// var_dump($data);
		if (empty($data)) {
			notice('已经发货不能返回');
		}else{
			notice('发货成功','index.php?c=order');
		}
	}
	// 支付状态
	
	public function doIsPay()
	{
		$id = $_GET['id'];
		$isPay = $_GET['isPay']=2?1:1;
		// 
		$data = $this->order->doIsPay($id,$isPay);
		// var_dump($data);
		if (empty($data)) {
			notice('已经支付完成不能再次支付');
		}else{
			notice('支付成功','index.php?c=order');
		}
	}
	// 取消订单状态
	public function doCancel()
	{
		$id = $_GET['id'];
		$cancel = $_GET['cancel']=2?1:1;
		$status = $_GET['status'];
		if ($status == 2) {
			return notice('已发货不能取消订单');
		}
		if ($status == 3) {
			return notice('已收货货不能取消订单');
			
		}
		$data = $this->order->doCancel($id,$cancel);
		// var_dump($data);
		if (empty($data)) {
			notice('已经取消订单不能再次取消');
		}else{
			notice('取消订单成功:)','index.php?c=order');
		}
	}
	// 订单详情
	public function orderMsg()
	{
		$id = $_GET['id'];
		$data = $this->order->orderMsg($id);
		include 'View/order/orderMsg.html';
	}
	// 加载修改订单
	public function orderEdit()
	{
		$id = $_GET['id'];
		$data = $this->order->orderMsg($id);
		include 'View/order/orderEdit.html';
	}
	// 修改订单页面
	public function doOrderEdit()
	{
		$data = $this->order->doOrderEdit();
		if (empty($data)) {
			notice('修改失败');
		}else{
			notice('修改成功','index.php?c=order');
		}
	}
	// 删除订单、
	public function orderDel()
	{
		$id = $_GET['id'];
		$data = $this->order->orderDel($id);
		if (empty($data)) {
			notice('删除失败');
		}else{
			notice('已经删没了后悔晚了:(','index.php?c=order');
		}
	}

}
