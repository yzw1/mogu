/*
Navicat MySQL Data Transfer

Source Server         : yzw
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : s70

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-10-18 10:32:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '管理员账号',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `code` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'yzw', '202cb962ac59075b964b07152d234b70', null);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '分类名',
  `pid` int(11) NOT NULL COMMENT '父级id',
  `path` varchar(255) NOT NULL COMMENT '分类路径',
  `display` tinyint(1) DEFAULT '2' COMMENT '显示/隐藏  1-显示  2-隐藏',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('10', '裤子', '0', '0,', '1');
INSERT INTO `category` VALUES ('11', '上衣', '0', '0,', '1');
INSERT INTO `category` VALUES ('13', '男人上衣', '11', '0,11,', '1');
INSERT INTO `category` VALUES ('18', '男装', '9', '0,9,', '1');
INSERT INTO `category` VALUES ('9', '服装', '0', '0,', '1');
INSERT INTO `category` VALUES ('15', '女装', '9', '0,9,', '1');
INSERT INTO `category` VALUES ('16', '辣条', '13', '0,11,13,', '1');
INSERT INTO `category` VALUES ('19', '裙子', '15', '0,9,15,', '1');
INSERT INTO `category` VALUES ('20', '旗袍', '15', '0,9,15,', '1');
INSERT INTO `category` VALUES ('21', '女人上衣', '11', '0,11,', '1');
INSERT INTO `category` VALUES ('22', '奶粉', '21', '0,11,21,', '2');
INSERT INTO `category` VALUES ('23', '饰品', '0', '0,', '1');
INSERT INTO `category` VALUES ('24', '冬装', '0', '0,', '1');
INSERT INTO `category` VALUES ('25', '夏装', '0', '0,', '1');
INSERT INTO `category` VALUES ('26', '短袖', '25', '0,25,', '1');
INSERT INTO `category` VALUES ('27', '跨带', '25', '0,25,', '1');
INSERT INTO `category` VALUES ('28', '男人库', '10', '0,10,', '1');
INSERT INTO `category` VALUES ('29', '女人裤', '10', '0,10,', '1');
INSERT INTO `category` VALUES ('30', '男人饰品', '23', '0,23,', '1');
INSERT INTO `category` VALUES ('31', '女人饰品', '23', '0,23,', '1');
INSERT INTO `category` VALUES ('32', '男人冬装', '24', '0,24,', '1');
INSERT INTO `category` VALUES ('33', '女人冬装', '24', '0,24,', '1');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '分类id',
  `name` varchar(30) NOT NULL COMMENT '商品名',
  `price` decimal(11,2) NOT NULL COMMENT '商品单价',
  `stock` int(10) unsigned DEFAULT '0' COMMENT '库存',
  `sold` int(11) DEFAULT '0' COMMENT '已售',
  `up` tinyint(1) DEFAULT '1' COMMENT '1-上架  2-下架',
  `hot` tinyint(1) DEFAULT '2' COMMENT '1-热销  2-滞销',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('11', '29', '女人的长裤', '100.00', '100', '0', '1', '1', '怎么是条狗', '1507788648', null);
INSERT INTO `goods` VALUES ('7', '19', '长裙', '12.00', '100', '0', '1', '2', '长裙太长', '1507688169', null);
INSERT INTO `goods` VALUES ('5', '16', '女人的上衣', '2.00', '10', '0', '1', '1', '不好看', '1507684205', '1507812692');
INSERT INTO `goods` VALUES ('6', '19', '超短裙', '3.00', '3000', '0', '1', '1', '不短不熬前', '1507684458', '1507684458');
INSERT INTO `goods` VALUES ('8', '19', '中长裙', '1.00', '100', '0', '1', '1', '1', '1507689667', '1507812142');
INSERT INTO `goods` VALUES ('10', '28', '长裤', '100.00', '100', '0', '1', '1', '太难看', '1507788544', null);
INSERT INTO `goods` VALUES ('12', '30', '男人饰品', '100.00', '100', '0', '1', '1', '男人饰品', '1507793166', null);
INSERT INTO `goods` VALUES ('13', '31', '女人饰品', '100.00', '10', '0', '1', '1', '女人饰品', '1507793199', null);
INSERT INTO `goods` VALUES ('14', '32', '男人冬装', '100.00', '100', '0', '1', '1', '男人冬装', '1507793242', null);
INSERT INTO `goods` VALUES ('15', '33', '女人冬装', '100.00', '10', '0', '1', '1', '女人冬装', '1507793279', null);
INSERT INTO `goods` VALUES ('16', '27', '100', '10.00', '10', '0', '1', '1', '男人', '1507793414', null);

-- ----------------------------
-- Table structure for goodsimg
-- ----------------------------
DROP TABLE IF EXISTS `goodsimg`;
CREATE TABLE `goodsimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `icon` varchar(30) NOT NULL COMMENT '商品图片名',
  `face` tinyint(1) DEFAULT '2' COMMENT '1-封面  2-非封面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsimg
-- ----------------------------
INSERT INTO `goodsimg` VALUES ('1', '1', '2017100959db6eb73cc67.jpg', '1');
INSERT INTO `goodsimg` VALUES ('2', '2', '2017100959db75c05204f.jpg', '1');
INSERT INTO `goodsimg` VALUES ('3', '3', '2017101059dc71299b1a2.gif', '1');
INSERT INTO `goodsimg` VALUES ('4', '4', '2017101059dc717316184.jpg', '1');
INSERT INTO `goodsimg` VALUES ('5', '5', '2017101159dd6f6d7fcd3.jpg', '1');
INSERT INTO `goodsimg` VALUES ('6', '6', '2017101159dd706a3c492.gif', '1');
INSERT INTO `goodsimg` VALUES ('7', '7', '2017101159dd7ee9f1446.jpg', '1');
INSERT INTO `goodsimg` VALUES ('8', '8', '2017101159dd84c3389bb.jpg', '1');
INSERT INTO `goodsimg` VALUES ('9', '9', '2017101159dd956e88378.jpg', '1');
INSERT INTO `goodsimg` VALUES ('10', '8', '2017101159ddf1570ff83.jpg', '2');
INSERT INTO `goodsimg` VALUES ('11', '8', '2017101159ddf163a8005.jpg', '2');
INSERT INTO `goodsimg` VALUES ('25', '16', '2017101759e5d0c3aaeb0.gif', '2');
INSERT INTO `goodsimg` VALUES ('15', '7', '2017101259def4bc5403e.jpg', '2');
INSERT INTO `goodsimg` VALUES ('24', '8', '2017101759e5d08fdcf9d.gif', '2');
INSERT INTO `goodsimg` VALUES ('17', '10', '2017101259df0700de25f.gif', '1');
INSERT INTO `goodsimg` VALUES ('18', '11', '2017101259df07681570d.jpg', '1');
INSERT INTO `goodsimg` VALUES ('19', '12', '2017101259df190e76f5a.gif', '1');
INSERT INTO `goodsimg` VALUES ('20', '13', '2017101259df192fcf50f.jpg', '1');
INSERT INTO `goodsimg` VALUES ('21', '14', '2017101259df195acc411.jpg', '1');
INSERT INTO `goodsimg` VALUES ('23', '16', '2017101259df1a0683f1e.jpg', '1');
INSERT INTO `goodsimg` VALUES ('26', '16', '2017101759e5d0d7e7fde.jpg', '2');
INSERT INTO `goodsimg` VALUES ('27', '16', '2017101759e5d19acaf98.gif', '2');
INSERT INTO `goodsimg` VALUES ('28', '15', '2017101759e5fc1d93aab.jpg', '1');

-- ----------------------------
-- Table structure for order1
-- ----------------------------
DROP TABLE IF EXISTS `order1`;
CREATE TABLE `order1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNum` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `uid` int(11) DEFAULT NULL COMMENT '用户id',
  `receiver` varchar(255) DEFAULT NULL COMMENT '收货人',
  `phone` char(11) DEFAULT NULL COMMENT '收货电话',
  `address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `time` int(10) DEFAULT NULL,
  `amount` decimal(14,2) NOT NULL COMMENT '总价',
  `status` tinyint(1) DEFAULT '1' COMMENT '1-待发货 2-待收货 3-已收货 4-待付款',
  `isPay` tinyint(1) DEFAULT '2' COMMENT '1-已支付  2-未支付',
  `cancel` tinyint(1) DEFAULT '2' COMMENT '1-取消订单 2-未取消订单',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `orderNum` (`orderNum`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order1
-- ----------------------------
INSERT INTO `order1` VALUES ('46', '534819fa1c24e79e4b377e1b10362f38', '21', '21', '15932344444', '1', '1508250657', '100.00', '3', '1', '2');
INSERT INTO `order1` VALUES ('45', 'e9ac2b0b1c0523f78b7ff2596ad21ca5', '21', '232', '15933223444', null, '1508250613', '100.00', '1', '1', '1');
INSERT INTO `order1` VALUES ('44', '324c0e5f25083c9f35d6b803f41ce12e', '21', '123', '15733333333', '2', '1508250441', '12.00', '2', '1', '2');
INSERT INTO `order1` VALUES ('43', '2ff7fd9437233baeba97337fe127b98e', '21', '12', '15832222222', '1', '1508250195', '2.00', '1', '1', '2');
INSERT INTO `order1` VALUES ('41', 'c3142ca36bf88b787830c9bea77ada49', '21', 'yzw', '15322444444', '东北三生', '1508247906', '15.00', '1', '1', '2');
INSERT INTO `order1` VALUES ('42', '40356cbb84d63f6a5e2484f47ea812c4', '21', '请求', '15743333333', '问问', '1508249384', '100.00', '2', '1', '2');
INSERT INTO `order1` VALUES ('40', 'd0e44919762db3baaa967f948f34266a', '21', 'wq', '15322222222', 'wq', '1508237475', '2.00', '1', '1', '2');
INSERT INTO `order1` VALUES ('39', '4357463b54458bd9910e16ddd60c4fb7', '21', null, null, null, '1508236921', '3.00', '1', '1', '2');
INSERT INTO `order1` VALUES ('35', '31ec82fc5820b414bd3d3db2d6d60da1', '21', null, null, null, '1508159568', '100.00', '3', '1', '2');

-- ----------------------------
-- Table structure for ordergoods
-- ----------------------------
DROP TABLE IF EXISTS `ordergoods`;
CREATE TABLE `ordergoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) DEFAULT NULL COMMENT '订单id',
  `gid` int(11) DEFAULT NULL COMMENT '商品id',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `count` int(11) DEFAULT NULL COMMENT '商品数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordergoods
-- ----------------------------
INSERT INTO `ordergoods` VALUES ('1', '25', '11', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('2', '26', '11', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('3', '27', '10', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('4', '28', '13', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('5', '29', '11', '100.00', '3');
INSERT INTO `ordergoods` VALUES ('6', '29', '15', '100.00', '6');
INSERT INTO `ordergoods` VALUES ('7', '30', '10', '100.00', '3');
INSERT INTO `ordergoods` VALUES ('8', '30', '5', '2.00', '2');
INSERT INTO `ordergoods` VALUES ('9', '31', '6', '3.00', '1');
INSERT INTO `ordergoods` VALUES ('10', '33', '13', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('11', '33', '10', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('12', '33', '15', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('13', '34', '7', '12.00', '1');
INSERT INTO `ordergoods` VALUES ('14', '34', '10', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('15', '35', '13', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('16', '36', '16', '10.00', '1');
INSERT INTO `ordergoods` VALUES ('17', '37', '15', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('18', '38', '7', '12.00', '1');
INSERT INTO `ordergoods` VALUES ('19', '39', '6', '3.00', '1');
INSERT INTO `ordergoods` VALUES ('20', '40', '5', '2.00', '1');
INSERT INTO `ordergoods` VALUES ('21', '41', '6', '3.00', '1');
INSERT INTO `ordergoods` VALUES ('22', '41', '7', '12.00', '1');
INSERT INTO `ordergoods` VALUES ('23', '42', '13', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('24', '43', '5', '2.00', '1');
INSERT INTO `ordergoods` VALUES ('25', '44', '7', '12.00', '1');
INSERT INTO `ordergoods` VALUES ('26', '45', '11', '100.00', '1');
INSERT INTO `ordergoods` VALUES ('27', '46', '10', '100.00', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` char(11) NOT NULL COMMENT '电话',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `address` varchar(255) DEFAULT NULL COMMENT '住址',
  `icon` varchar(255) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(1) unsigned DEFAULT '1' COMMENT '性别  1-男  2-女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-激活  2-禁用',
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('19', '15897777777', 'c20ad4d76fe97759aa27a0c99bff6710', '12', '12', '2017101359e0770c0d7e4.jpg', '1', '2017-10-07', '1', '1507882764');
INSERT INTO `user` VALUES ('16', '15555555555', '202cb962ac59075b964b07152d234b70', '命名', '东北', '2017101059dcd246bb52a.gif', '1', '2017-10-20', '1', '1507643974');
INSERT INTO `user` VALUES ('17', '15766666666', '202cb962ac59075b964b07152d234b70', '小红', '东北', '2017101059dcd2740b710.jpg', '1', '2017-10-06', '1', '1507644020');
INSERT INTO `user` VALUES ('18', '15777777777', '202cb962ac59075b964b07152d234b70', 'fight', '天堂', '2017101059dcd2c0deb84.jpg', '1', '2017-10-06', '1', '1507644096');
INSERT INTO `user` VALUES ('20', '15933809759', 'c20ad4d76fe97759aa27a0c99bff6710', '12', '12', '2017101359e07746620c6.gif', '1', '2017-10-05', '1', '1507882822');
INSERT INTO `user` VALUES ('21', '15932311323', '202cb962ac59075b964b07152d234b70', 'fight', '32324', '2017101659e471aa00ce2.jpg', '1', null, '1', '1508143530');
INSERT INTO `user` VALUES ('22', '15341111111', '202cb962ac59075b964b07152d234b70', 'fight', '123', '2017101659e4653b42780.gif', '1', '2017-10-06', '1', '1508140347');
INSERT INTO `user` VALUES ('23', '15933787878', '202cb962ac59075b964b07152d234b70', '12', '123', '2017101659e4658b4b662.gif', '1', '2017-10-07', '2', '1508140427');
INSERT INTO `user` VALUES ('31', '15423333333', '202cb962ac59075b964b07152d234b70', null, null, null, '1', null, '1', '1508291397');
SET FOREIGN_KEY_CHECKS=1;
