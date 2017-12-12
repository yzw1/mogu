<?php   

 class categoryModel
 {
 	private $db;
 	public function __construct()
 	{
 		$this->db = new DB('category');
 	}
 	public function index($pid = 0 )
 	{
 		$data = $this->db->where('pid ='.$pid)->order('id desc')->select();
 		return $data;
 	}
 	// 计算总个数
		public function count($where = '')
		{
			$data=$this->db->field('count(id) as sum')->where($where)->select();
			return $data[0]['sum'];
		}
	public function getCate()
	{
		// select  concat(path, id, ',') as px, name, id
			// from category
			// order by px
		return $this->db->order('px')->field('concat(path, id, ",") as px, name, id')->select();
	}
 	public function doAdd()
 	{
  		// 其余的验证 完善
 		$data = $this->db->insert();
 		// var_dump($data);die;
 		return $data;
 	}
 	public function find($id)
 	{
 		$data = $this->db->where('id='.$id)->find();
 		return $data;
 	}
 	public function doEdit()
 	{
 		
			// 1. 判断数据
				// 其他验证自己写...

			// 2. 完善数据
			// 3. 执行update 方法, 返回新增的id
				$data = $this->db->where('id = '.$_POST['id'])->update();
			// 4. 返回结果
				return $data;
  	} 
 	// 更改状态

	public function doDisplay($id,$display)
	{
		// // 把状态看成一个数组去存;
		$arr['display'] = $display;
		$data = $this->db->where('id = '.$id)->update($arr);
	}
	// 删除分类
	public function doDel($id)
	{
		// 先根据查找是否有分类
		$data = $this->db->where(' pid = '.$id)->find();
		// echo $this->db->sql;die;
		// var_dump($data);die;
		if (!$data) {
			$data = $this->db->where(' id = '.$id)->delete();
		}else{
			notice('请删除子分类');
		}
	}
 }
