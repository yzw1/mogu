<?php   
	class userController  extends Controller
	{
		private $user;
		public function __construct()
		{
			parent::__construct();

			$this->user= new userModel;
		}
		public function index()
		{
			if (empty($_GET['search'])) {
				$where='';
			}else{
				$where = 'tel like "%'.$_GET['search'].'%"';
			}
			// if ($_GET['search']) {
			// 	notice('你查询的数据不存在');
			// }
			// 分页
			$page = new Page;
			// 求分页的总个数 count加where条件是为模糊查询准备的，不加按下一页会失效
			$count = $this->user->count($where);
			// 求分页
			$limit = $page->getLimit($count,AP);
			// if ($count <0) {
			// 	notice('查询不存在');
			// }
			$data = $this->user->index($limit,$where);
			// var_dump($data);die;
			include 'View/user/index.html';
		}
		public function add()
		{
			include 'View/user/add.html';
		}
		public function doAdd() 
		{
			$data = $this->user->doAdd();
			// var_dump($data);die;
			// var_dump($_POST);
			// var_dump($_FILES);die;
			if (empty($data)) { 
			  
				notice('添加失败');
			}else{
			notice('添加成功','index.php?c=user');
			}
		}
		public function edit()
		{
			// 获取本条数据的id
			$id = $_GET['id'];
			$data = $this->user->find($id);
			
			include 'View/user/edit.html';
		}
		public function doEdit()
		{
			 // 通过moudel进行编辑
			$data = $this->user->doEdit();
			if (empty($data)) {
				notice('编辑失败');
			}else{
				notice('编辑成功','index.php?c=user');
			}
		}
		public function doDel() 
		{
			// 如果删成功跳转结果不对 就是db类没返回数据
			// 获取id数据看删谁
			$id = $_GET['id'];
			$data = $this->user->doDel($id);
			// var_dump($data);
			if (empty($data)) {
				notice('删除失败');
			}else{
				notice('删除成功');
			}

		}
		// 进行状态修改
		public function doStatus()
		{
			$id = $_GET['id'];
			$status = $_GET['status']==1?2:1;
			// var_dump($status);die;
			$data = $this->user->doStatus($id,$status);
			header('location:index.php?c=user');die;
		}

	}
