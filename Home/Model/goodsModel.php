<?php 

class goodsModel 
	{
		private $db;
		public function __construct()
		{
			$this->db= new DB('goods'); 
		}

		// 分页
		public function index($limit)
		{
			
			$data = $this->db->limit($limit)->order('id desc')->select();
			// var_dump($data);die;
			return $data;
		}
		// 计算总个数
		public function count()
		{
			$data=$this->db->field('count(id) as sum')->select();
			return $data[0]['sum'];
		}
		// 商品列表
		public function goodsList($id)
		{
			// 根据分类id加载子分类id
			// select id
			// from category
			// where path like '%,'.$id.',%'
			$cid = $this->db->table('category')->field('id')->where('path like "%,'.$id.',%"')->select();
			// var_dump($cid);die;
			$cidList = '';
			foreach ($cid as $k => $v) {
				$cidList .= $v['id'].',';
			}
			$cidList .=$id;
			// var_dump($cidList);die;
			// 根据分类id加载good 和 goodimg的内容
			// select g.id name price sold desc icon
			// from good g ,goodimg i
			// where g.id = i.gid and face=1 cid in('.$cidList.')and up =1
			$data = $this->db
						->table('goods g,goodsimg i')
						->field('g.`id`, `name`, `price` ,`sold` ,`desc`, `icon`')
						->where('cid in ('.$cidList.') and g.id = i.gid and face=1 and up=1 ')
						->select();
					
			return $data;
		}
		public function detail($id)
		{
			// 商品信息
				// select `name`, `desc`, `price`, `sold`, `stock`
				// from goods
				// where id = 11

			$goods = $this->db->field('`id`,`name`, `desc`, `price`, `sold`, `stock`')->table('goods')->where('id = '.$id)->find();

			// 商品图片
				// select `icon`
				// from goodsimg 
				// where gid = 11

			$img = $this->db->field('`icon`')->table('goodsimg')->where('gid = '.$id)->order('face')->select();

			$data[] = $goods;
			$data[] = $img;
			return $data;

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

	}