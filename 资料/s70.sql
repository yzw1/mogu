-- 用户表
create table if not exists `user`(
	`id` 		int 	auto_increment  	primary key,
	`tel` 		char(11) unique not null comment '电话',
	`pwd`   	char(32) not null comment '密码',
	`nickname` 	varchar(30) comment '昵称', 
	`address`  	varchar(255) comment '住址',
	`icon` 	   	varchar(255) comment '头像',
	`sex` 	   	tinyint(1) unsigned  default 1 comment '性别  1-男  2-女',
	`birthday` 	date  comment '生日',
	`status`   	tinyint(1) default 1 comment '状态  1-激活  2-禁用',
	`regtime`  	int 	not null comment '注册时间'
	-- `job` 		tinyint(1) not null  default 2 comment '1-管理员 2-会员'
)engine=MyISAM default charset=utf8;


-- 管理员表
create table if not exists `admin`(
	`id` 	int 	auto_increment  	primary key,
	`name` varchar(30) comment '管理员账号', 
	`pwd`   char(32) not null comment '密码'
)engine=MyISAM default charset=utf8;


-- 分类表
create table if not exists `category`(
	`id`  	int  	auto_increment  	primary key,
	`name`  varchar(30) unique comment '分类名', 
	`pid` 	int 	not null comment '父级id',
	`path`  varchar(255)  not null comment '分类路径',
	`display` tinyint(1) default 2 comment '显示/隐藏  1-显示  2-隐藏'
)engine=MyISAM default charset=utf8;


-- 商品表
create table if not exists `goods`(
	`id`  	int  	auto_increment  	primary key,
	`cid`  	int  	not null  comment '分类id',
	`name`  varchar(30) not null comment '商品名', 
	`price` decimal(11,2) not null comment '商品单价',
	`stock` int    unsigned default 0 comment '库存',
	`sold`  int    default 0 comment '已售',
	`up`    tinyint(1) default 1 comment '1-上架  2-下架',
	`hot`   tinyint(1) default 2 comment '1-热销  2-滞销',
	`desc`  varchar(255) comment '描述',
	`addtime` int not null comment '添加时间',
	`uptime` int not null comment '更新时间'
)engine=MyISAM default charset=utf8;


-- 商品图片表
create table if not exists `goodsimg`(
	`id`  	int  	auto_increment  	primary key,
	`gid`  	int  	not null  comment '商品id',
	`icon`  varchar(30) not null comment '商品图片名', 
	`face`  tinyint(1) default 2 comment '1-封面  2-非封面'
)engine=MyISAM default charset=utf8;


