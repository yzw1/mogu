<?php 

	class Uploads
	{
			// 生成一串编号
		function create_uuid(){    //可以指定前缀
		    $str = md5(uniqid(mt_rand(), true));   
		    return $str;
		}
		public function is_up()
		{
			$key = key($_FILES);
			$error = $_FILES[$key]['error'];
			if ($error == 4) {
				// 代表没上传
				return true;
			}else{
				// 代表上传
				return false;
			}

		}
		public function singleUP($save = '../Uploads/', $allowType=array('image'))
		{
			//1.判断错误
			//1.1
				$key = key($_FILES);
				if (empty($key)) {
					return '上传文件太大';
				}
			// 1.2
				$error = $_FILES[$key]['error'];
				if ($error>0) {
					switch ($error) {
						case '1':'上传文件大';
						case '2':'上传文件大';
						case '3':'网络问题';
						case '4':'上传你的文件';
						case '6':'请联系你的管理员';
						case '7':'请联系你的管理员';

						
					}
				}
			// 2.是否post协议上传
				$tmp = $_FILES[$key]['tmp_name'];
				if (!is_uploaded_file($tmp)) {
					return '非法上传';
				}

			// 3.判断文件类型
				// 3.1获取文件类型
				$type = $_FILES[$key]['type'];
				$fileType = strtok($type, '/');

				// 3.2查看文件是否符合
				if (!in_array($fileType, $allowType)) {
					return '格式不正确';
				}

			// 4.设置新名字
				// 4.1获取文件名后缀

				$name = $_FILES[$key]['name'];
				$suffix=strrchr($name, '.');
				// 4.2设计新名字
				$filename = date('Ymd').uniqid().$suffix;

			// 5.放到存在目录
				$filePath = $save.date('/Y/m/d/');
 
			// 6.判断是否有存储目录没有创建
				if (!file_exists($filePath)) {
					mkdir($filePath,0777,true);
				}

			// 7.移动文件到目录
				if (move_uploaded_file($tmp,$filePath.$filename)) {
					$arr[] = $filename;
					return $arr;
				}
				return '上传失败';
		}
	}

 ?>