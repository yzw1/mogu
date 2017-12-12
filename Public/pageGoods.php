<?php 

	class pageGoods
	{
		private $page;
		private $maxPage;
		private $count;

		public function show()
		{
			$link = '';
			for($i = 1; $i <= $this->maxPage; $i++){
				$link .= '<a href="index.php?c=category&page='.$i.'" >'.$i.'</a> ';
			}


			$html = '共 '.$this->count.' 条数据 '.$this->page.'/'.$this->maxPage.'页 ';
			$html .= '<a href="index.php?c=category&page='.($this->page-1).'" >上一页</a> ';
			$html .= $link;
			$html .= '<a href="index.php?c=category&page='.($this->page+1).'" >下一页</a> ';

			return $html;
		} 

		public function getLimit($count, $rows)
		{
			// 获取当前页码
			$this->page = empty($_GET['page'])?1:$_GET['page'];

			// 计算最大页码
				$this->count = $count;
				$this->maxPage = ceil($count/$rows);

			// 限制页码的范围
				$this->page = max(1, $this->page);
				$this->page = min($this->maxPage, $this->page);

			// 计算数据下标
			$key = ($this->page - 1) * $rows;

			return $key.','.$rows;
		}




	}

