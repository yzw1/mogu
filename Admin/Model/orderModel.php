<?php 


  class orderModel
  {
  	private $db;
  	public function __construct()
  	{
  		$this->db = new DB('order1');
  	}
  	public function index($limit,$where='')
  	{
  		$order1 = $this->db->table('order1')->where($where)->limit($limit)->order('id desc')->select();
  		$_SESSION['order1']= $order1;
         
  		// var_dump($_SESSION['order1']);

  		// die;
  		return $order1;
  	}
  	// 计算总个数
		public function count($where = '')
		{
			$data=$this->db->field('count(id) as sum')->where($where)->select();
			return $data[0]['sum'];
		}
	// 查询订单状态
	// 
	public function doStatus($id,$status)
	{
		$arr['status'] = $status;
		$data = $this->db->where('id = '.$id)->update($arr);
		// var_dump($this->db->sql);
		return $data;
	}
	// 支付状态
	public function doIsPay($id,$isPay)
	{
		$arr['isPay'] = $isPay;
		$data = $this->db->where('id = '.$id)->update($arr);
		// var_dump($this->db->sql);
		return $data;
	}
	// 取消订单状态
	public function doCancel($id,$cancel)
	{
		$arr['cancel'] = $cancel;
		$data = $this->db->where('id = '.$id)->update($arr);
		// var_dump($this->db->sql);
		return $data;
	}
	// 订单的详情
	public function orderMsg($id)
	{
		// select icon,orderNum,uid,receiver,address,phone,time,amount,stauts,isPay,cancel
		// from ordergoods og,order1 o,user u,goods g,goodsimg gs
		// where og.oid=o.id and o.uid=u.id and og.gid=g.id and g.id=gs.gid and up=1 face=1;
		$data = $this->db->table('ordergoods og,order1 o,user u,goods g,goodsimg gs')
						->field('o.id,gs.icon,nickname,orderNum,uid,receiver,o.address,phone,time,amount,o.status,isPay,cancel')
						->where('og.oid=o.id and o.uid=u.id and og.gid=g.id and g.id=gs.gid and up=1 and gs.face=1 and o.id='.$id)
		                ->find();
		            // var_dump($this->db->sql);
		         // var_dump($data);die;
		return $data;
	}
	// 修改订单
	public function doOrderEdit()
	{
		$id = $_POST['id'];
		$data = $this->db->table('order1')->where('id='.$id)->update();
		// var_dump($this->db->sql);
		// var_dump($data);die;
		return $data;
	}
	// 删除订单
	public function orderDel($id)
	{
		$data = $this->db->where('id = '.$id)->delete();
		return $data;
	}
  }