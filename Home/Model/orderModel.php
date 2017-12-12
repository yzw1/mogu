
<?php 

class orderModel
{
	private $db;
	public function __construct()
	{
		$this->db = new DB('order1');
	}
	public function index() 
	{
		// 查询用户的id将用户的id存入到订单表的uid
		// $id = $this->db->table('user')->field('id')->find();
		// 2.1 手机号的格式
		if (empty($_POST['receiver'] && $_POST['address'] && $_POST['phone'])) {
			notice('不能为空必须填入数据,除非你不想要货');
		}
		$_POST['receiver'] = htmlentities($_POST['receiver']);
		$_POST['address'] = htmlentities($_POST['address']);

			$preg = '/*^[\u4e00-\u9fa5]/u';
			if (!preg_match($preg, $_POST['receiver'])) {
				notice('请填入中文');
			}
			$preg = '/^1[34578]\d{9}$/';
			if (!preg_match($preg,$_POST['phone'])) {
				notice('手机格式不正确');
			}
			// 2.2密码是否为空
		// 插入一个订单号
		$uuid = new uploads;
		$arr['orderNum'] = $uuid->create_uuid();
		$arr['amount'] = $_POST['totall'];
		// var_dump($_POST);die;
		$arr['time'] = time();
		$arr['uid'] = $_SESSION['home']['id'];
		$arr['receiver'] = $_POST['receiver'];
		$arr['address'] = $_POST['address'];
		$arr['phone'] = $_POST['phone'];

		// 将用户id插入到订单表的uid
		// $arr['uid'] = $id;

		$data = $this->db->table('order1')->insert($arr);
		// var_dump($this->db->sql);
		// 将数据插入到orderGoodes表
		// var_dump($data);die;

		$arr1['oid'] = $data;
		// var_dump($_SESSION['order']);
		foreach ($_SESSION['order'] as $k => $v) {
			// 所有货物的id
		$arr1['gid'] = $k;
	
		$arr1['price'] = $v['price'];
			// return $array;
		$arr1['count'] = $v['count'];
		$data = $this->db->table('ordergoods')->insert($arr1);
		}
		var_dump($arr);
		// var_dump($data);die;
		// var_dump($this->db->sql);die;

		return $data; 

	}
	public function waitPay()
	{
		 $data = $this->db->table('order1')->field('orderNum,isPay')->find();
		// var_dump($data);


		return $data;
	}
	public function payTrue()
	{
		$id = $_SESSION['home']['id'];
		$arr['isPay']= 1;
		$payTrue = $this->db->table('order1')->where('uid='.$id)->update($arr);
		// var_dump($payTrue);die;
		return $payTrue;
	}
	// 加载购物车的信息进入页面
		public function shopcar($id) 
		{
			// 查询页面所需要的信息
			// icon price name desc stock
			// select g.id icon price name desc stock
			// from goods g goodsimg i
			// where g.id = i.gid and up =1 and face=1 and g.id=$id
			$goods = $this->db
						->field('`icon`,`price`,`name`,`desc`,`stock`')
						->table('goods g,goodsimg i')
						->where('g.id = i.gid and up =1 and face=1 and g.id='.$id)
						->find();
			// var_dump($goods);die;
						// 验真相关信息
				if($_GET['count'] >= $goods['stock']){
					$goods['count'] = $goods['stock'];
				}else{
					$goods['count'] = $_GET['count'];
				}
			// 最老的方法把数据存入到session
				$_SESSION['shop'][$id]=$goods;
				// if (empty($_SESSION['shop'][$id]['count'])) {
				// 	 $_SESSION['shop'][$id]['count']=1;
				// }
			}

	
	// 全部订单的信息

	public function doIsPay($id,$isPay)
	{
		$arr['isPay'] = $isPay;
		$data = $this->db->table('order1')->where('id = '.$id)->update($arr);
		return $data;
	}
	// 取消订单
	public function doCancel($id,$cancel)
	{
		$arr['cancel'] = $cancel;
		$data = $this->db->table('order1')->where('id = '.$id)->update($arr);
		return $data;
	}
	// 收货状态
	public function doStatus($id,$status)
	{
		$arr['status'] = 3;
		$data = $this->db->table('order1')->where('id = '.$id)->update($arr);
		// var_dump($this->db->sql);die;
		return $data;
	}
}
