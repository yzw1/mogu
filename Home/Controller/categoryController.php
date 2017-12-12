<?php 

	class categoryController extends Controller
	{
		private $category;
		public function __construct() 
		{
			parent::__construct();
			$this->category = new categoryModel;
		}
 
		public function index() 
		{
			$pid = empty($_GET['id'])?0:$_GET['id'];
			$data = $this->category->index($pid);
			include 'View/category/index.html';
		}
		public function add()
		{
			$pid = empty($_GET['id'])?0:$_GET['id'];
			$path = empty($_GET['path'])?'0,':$_GET['path'].$_GET['id'].',';
			// var_dump($pid,$path);die;
			include 'View/category/add.html';
		}
		public function doAdd()
		{
			$data = $this->category->doAdd();
			// var_dump($data);
			if (empty($data)) {
				notice('添加失败');
			}else{
				notice('添加成功','index.php?c=category');
			}
		}
		public function edit()
		{
			$id = $_GET['id'];
			$data = $this->category->find($id);
			include 'View/category/edit.html';
		}
		public function doEdit()
		{
			$data = $this->category->doEdit();
			
			// 根绝结果跳转页面
			if(empty($data)){
				notice('编辑失败');
			}
			notice('编辑成功', 'index.php?c=category');
		}
		// 进行状态修改
		public function doDisplay()
		{
			$id = $_GET['id'];
			$display = $_GET['display']==1?2:1;
			// var_dump($status);die;
			$data = $this->category->doDisplay($id,$display);
			// var_dump($data);
			header('location:index.php?c=category');die;
		}
		// 先删除分类
		public function doDel()
		{
			$id = $_GET['id'];
			$data =$this->category->doDel($id);
			header('location:index.php?c=category');die;
			
		}
	}
