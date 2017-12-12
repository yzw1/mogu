<?php 


class personModel
{
	private $db;
	public function __construct()
	{
		$this->db = new DB('orderGoodes');
	}
	public function index()
	{

		$data = $this->db->table('user')->field('icon')->where('id='.$_SESSION['home']['id'])->find();
		// var_dump($this->db->sql);die;
		// var_dump($data);die;
		return $data;
	}
	// 完善个人信息
	public function doPersonMsg()
	{
		// 上传文件
		$up = new uploads;
		$file = $up->singleUP();
		// 判断是否字符串
		if (is_string($file)) {
			notice($file);
		}
		// 获取填入的信息
		$arr['nickname'] = $_POST['nickname'];
		$arr['address'] = $_POST['address'];
		$arr['sex'] = $_POST['sex'];
		$arr['icon'] = $file[0];
		$arr['regtime'] = time();
 
		// 将填入的数据插入到数据库中
		$data = $this->db->table('user')->where('id='.$_SESSION['home']['id'])->update($arr);
		// var_dump($this->db->sql);die;
		return $data;
	}
	// 修改密码
	public function doPersonPwd()
	{
		// 现获取已有的密码
		if (strcasecmp(md5($_POST['pwd']),$_SESSION['home']['pwd'])) {
			notice('旧密码与原来的不符');
		}
		if (empty($_POST['pwd'])) {
			notice('密码不能为空');
		}
		if ($_POST['pwd'] == $_POST['repwd']) {
			notice('旧密码和新密码不能重复');
		}
		// 改变原来的密码
		if (empty($_POST['repwd'])) {
			notice('新密码不能为空');
		}
		// 判断两次的密码不一致
		if ($_POST['repwd'] != $_POST['reepwd']) {
			notice('两次密码不一致');
		}else{
			unset($_POST['reepwd']);
			$_POST['repwd'] = md5($_POST['repwd']);
		}
		// 改动的哪个id
		// $arr['id'] = $_SESSION['home']['id'];  
		$arr['pwd'] = $_POST['repwd'];
		$arr['tel'] = $_SESSION['home']['tel'];
		// 修改时间
		$arr['regtime'] = time();
		// 将改动的密码插入数据表中
		$data = $this->db->table('user')->where('id='.$_SESSION['home']['id'])->update($arr);
		return $data;
		// var_dump($this->db->sql);die;
	}
	// 全部订单
	public function shopOrder()
	{
		// select orderNum time amount status cancel name desc icon price count
		// from order1 o,goods g,goodsimg gs,ordergoods og
		// where(og.oid = o.id and og.gid=g.id and gs.gid=g.id)
		$data = $this->db->table('order1 o,goods g,goodsimg gs,ordergoods og')
						->field('orderNum,time,amount,status,cancel,name,`desc`,icon ,g.price,count,isPay,status,cancel')
						->where('og.oid = o.id and og.gid=g.id and gs.gid=g.id')
						->order('o.time desc')
						->select();
						// var_dump($this->db->sql);die;
			// var_dump($data);die;
		return $data;
	}
	// 查看订单状态     实验版
	public function userOrder($id)
		{
			// 查订单状态
			$order = $this->db->table('`order1` o')
		   			->field(' o.orderNum, o.time ,o.amount ,o.status, o.isPay, o.cancel,o.id')
		   			->order('time desc')
		   			->where('o.uid ='.$id)
		   			->select();
		   		// var_dump($order);die;
		   		// 
		   	// 查每个订单下的所有商品
		  	foreach ($order as $k => $v) { 
		  	$id =$v['id'];
		  	
		 		 $goods[$id] = $this->db->table('ordergoods og,goods g,goodsimg gi')
		   			->field(' og.price,og.count ,g.name, gi.icon')
		   			->where('g.id =og.gid and g.id=gi.gid and face = 1  and og.oid ='.$v['id'])
		   			->select();
		   			// echo $this->db->sql;
		  	
		  	}
		   		$data['order']=$order;
		   		$data['goods']=$goods;

		   		return $data;
		}


}