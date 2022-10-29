/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : nihuawocai

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2020-03-18 10:50:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `shouname` varchar(20) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `shou_addr` varchar(255) DEFAULT NULL,
  `shou_phone` varchar(20) DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `logintime` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'newadmin', '5d93ceb70e2bf5daa84ec3d0cd2c731a', '1583739295', '1111111111', '1');
INSERT INTO `admin` VALUES ('2', 'newadmin2', '200820e3227815ed1756a6b531e7e0d2', '1583739358', null, '0');
INSERT INTO `admin` VALUES ('3', 'fuxin1', 'e10adc3949ba59abbe56e057f20f883e', '1583741953', '1584185210', '1');
INSERT INTO `admin` VALUES ('6', 'jessica', 'adcaec3805aa912c0d0b14a81bedb6ff', '1583746820', null, '0');
INSERT INTO `admin` VALUES ('7', '最牛的人', '96e79218965eb72c92a549dd5a330112', '1583746942', null, '1');
INSERT INTO `admin` VALUES ('8', 'zhourunfa', '827ccb0eea8a706c4c34a16891f84e7b', '1583792287', null, '0');

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `time` int(12) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `isOk` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of answers
-- ----------------------------
INSERT INTO `answers` VALUES ('1', '1', '1', '12314412', '白菜', '1');
INSERT INTO `answers` VALUES ('2', '2', '2', '241421421', '南瓜', '0');
INSERT INTO `answers` VALUES ('3', '3', '3', '421421421', '中国', '0');
INSERT INTO `answers` VALUES ('4', '4', '4', '421421412', '美国', '0');
INSERT INTO `answers` VALUES ('5', '5', '5', '421241421', '日本', '0');
INSERT INTO `answers` VALUES ('6', '5', '6', '421414212', '韩国', '0');
INSERT INTO `answers` VALUES ('7', '13', '32', '241421421', '菠菜', '0');
INSERT INTO `answers` VALUES ('8', '5', '33', '1584493495', '青菜', '1');
INSERT INTO `answers` VALUES ('9', '1', '33', '1584493967', '青菜', '1');
INSERT INTO `answers` VALUES ('10', '3', '33', '1584493977', '青菜', '1');
INSERT INTO `answers` VALUES ('11', '3', '33', '1584493979', '133434', '0');
INSERT INTO `answers` VALUES ('12', '2', '33', '1584494268', '133434', '0');
INSERT INTO `answers` VALUES ('13', '13', '33', '1584494319', '青菜', '1');

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '0-首页，1-积分商城',
  `status` tinyint(4) DEFAULT '1' COMMENT '0，不展示，1，展示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner
-- ----------------------------
INSERT INTO `banner` VALUES ('4', '20200312/c3d173b094be2dc0b75a58fb82b55001.jfif', '京东', '/pages/canvas/start', '5', '1', '1');
INSERT INTO `banner` VALUES ('8', '20200312/7d48261fbb975a31898df9122760a923.jfif', '娜扎', '/pages/canvas/start', '1', '0', '1');
INSERT INTO `banner` VALUES ('9', '20200312/d143fd242bd63255bc95932c101e65e4.jfif', '娜扎2', '/pages/canvas/start', '2', '0', '1');
INSERT INTO `banner` VALUES ('10', '20200312/5fd824b6d817046dbbdd39ea900b95a5.jfif', '娜扎3', '/pages/canvas/start', '3', '0', '1');
INSERT INTO `banner` VALUES ('11', '20200312/16ff97e292521b4aa127d2e73b8e5ae0.jfif', '娜扎4', '/page/index/index.html', '4', '0', '1');
INSERT INTO `banner` VALUES ('13', '20200312/b07e4d6ed0785b64deb48c4d5915e120.jpg', '小桂子', '/page/index/index.html', '14', '0', '1');

-- ----------------------------
-- Table structure for credit
-- ----------------------------
DROP TABLE IF EXISTS `credit`;
CREATE TABLE `credit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `info` varchar(50) DEFAULT NULL,
  `add_type` tinyint(4) DEFAULT NULL COMMENT '0,注册增加 1，答题增加，2，出题增加，3邀请增加',
  `jian_type` tinyint(4) DEFAULT NULL COMMENT '0，兑换减少，1，违规减少',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of credit
-- ----------------------------
INSERT INTO `credit` VALUES ('1', '1', '50', '0', '12321321', '注册增加', '0', null);
INSERT INTO `credit` VALUES ('2', '1', '60', '0', '323213', '邀请好友', '3', null);
INSERT INTO `credit` VALUES ('3', '1', '40', '0', '231231', '答对', '2', null);
INSERT INTO `credit` VALUES ('4', '1', '50', '1', '31222122', '兑换商品', null, '0');
INSERT INTO `credit` VALUES ('5', '1', '12', '0', '2222', '邀请好友', '3', null);
INSERT INTO `credit` VALUES ('6', '2', '99', '0', '1112323', '发布题目', '1', null);
INSERT INTO `credit` VALUES ('7', '3', '50', '0', '22321312', '上热搜', '1', null);
INSERT INTO `credit` VALUES ('8', '4', '50', '1', '2313241', '兑换商品', null, '0');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(100) DEFAULT NULL,
  `goods_info` varchar(200) DEFAULT NULL,
  `price` double(11,4) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `imgs` tinytext,
  `is_shelf` tinyint(4) DEFAULT NULL,
  `pageView` int(11) DEFAULT '0',
  `saleView` int(11) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `save_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('3', '瑞士军刀', '十八种功能', '100.0000', '5', '20200311/22d80bf80f7234075a9ecc97b9797230.jfif', '20200311/d58dddfbfa35a57dd0788ce8d7068d28.jfif,20200311/007b6d2eac48ef481e4643991c760c41.jfif', '1', '20', '12', '1583921016', null);
INSERT INTO `goods` VALUES ('9', '贝贝头', '随便砍', '2000.0000', '100', '20200312/49d8c1a674931abf14bd07c7119be9db.jfif', '20200312/201a60e4a30c960d8813e17cae637987.jfif,20200312/c5981321d5e1593af6baba827efaca65.jfif', '1', '15', '12', '1583922251', null);
INSERT INTO `goods` VALUES ('10', '香蕉', '十八种功能', '12.0000', '123', '20200312/83a85f21b69d86f5e7c427fa0616c96f.jfif', '20200312/b0bd2db74b4339bbcd34f7568e1805f4.jfif', '1', '0', '0', '1583971456', null);
INSERT INTO `goods` VALUES ('11', '大头', '下雨不愁', '11.0000', '1', '20200314/4880fb780c6d695ee7bfa55a09bc5132.JPG', '20200312/53017dc0354a239dc6f28d5d2422a984.JPG,20200314/a401790618c2ad5948083ebc928181db.JPG,20200314/8fcf834098ba261d371bab4dc61b1e6d.JPG,20200314/65a3d22043b8b76c03e66a0bf41a82b3.JPG', '1', '0', '0', '1583978259', null);

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `notice` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL COMMENT '题目审核状态，0，待审核，1，已审核',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES ('1', '白菜', '一种蔬菜', null, '1', '0');
INSERT INTO `project` VALUES ('2', '菠菜', '蔬菜，两个字', '1583810387', '0', '1');
INSERT INTO `project` VALUES ('3', '青菜', '蔬菜，两个字', '1583810412', '0', '1');
INSERT INTO `project` VALUES ('4', '日本', '一个国家', '1583819982', '0', '1');
INSERT INTO `project` VALUES ('5', '母猪', '一种动物，女的', '1583819990', '0', '1');
INSERT INTO `project` VALUES ('6', '老司机', '一种工作', '1583820008', '0', '1');
INSERT INTO `project` VALUES ('7', '中国', '亚洲', '1584268264', '9', '0');
INSERT INTO `project` VALUES ('8', '加血', '游戏动作', '1584269029', '9', '0');

-- ----------------------------
-- Table structure for sale_order
-- ----------------------------
DROP TABLE IF EXISTS `sale_order`;
CREATE TABLE `sale_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `price` double(11,4) DEFAULT NULL,
  `num` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `shou_name` varchar(20) DEFAULT NULL,
  `shou_addr` varchar(255) DEFAULT NULL,
  `shou_phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sale_order
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) DEFAULT NULL,
  `nickName` varchar(20) DEFAULT NULL,
  `headImg` varchar(512) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `time` int(11) DEFAULT NULL COMMENT '用户注册时间',
  `credit` int(11) DEFAULT NULL COMMENT '积分',
  `status` tinyint(4) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'dfasfadsfdsafsafd', '王一', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633663&di=793d4c0c2296d7589ca43923b96a1f14&imgtype=0&src=http%3A%2F%2F00imgmini.eastday.com%2Fmobile%2F20200126%2F20200126160003_834bc424914f3de7af7af2e5d0aec732_2.jpeg', '1', '上海', '上海', '虹口', '124232', '20', '0', '中国');
INSERT INTO `user` VALUES ('2', 'dafsdafdsaf', '往二', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633663&di=f2d3c931cfa994412cfb45228d81e841&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201811%2F17%2F20181117112448_tGQSf.thumb.700_0.jpeg', '2', '河北', '石家庄', '杨浦', '12142141', '30', '0', '中国');
INSERT INTO `user` VALUES ('3', 'dfsadfeerdfasfds', '昂三', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633663&di=21b7cfd460bb00e4f3260ffeaabb53ff&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201511%2F21%2F20151121170632_uxYys.jpeg', '1', '河南', '洛阳', '黄浦', '11111', '50', '0', '中国');
INSERT INTO `user` VALUES ('4', 'fdferefesaff', '网三', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805719219&di=06bf4145adf8a34bfec0facd82413be5&imgtype=jpg&src=http%3A%2F%2Fimg4.imgtn.bdimg.com%2Fit%2Fu%3D3209526714%2C1789791551%26fm%3D214%26gp%3D0.jpg', '0', '陕西', '天津', '南市', '111111', '70', '0', '中国');
INSERT INTO `user` VALUES ('5', 'dffessdfggdsagdf', '王思', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633662&di=731d1ba349724b69476ec44f390d739c&imgtype=0&src=http%3A%2F%2Fb-ssl.duitang.com%2Fuploads%2Fitem%2F201408%2F02%2F20140802210522_skTCd.thumb.700_0.jpeg', '1', '山西', null, '菜市口', '1111111', '0', '0', '中国');
INSERT INTO `user` VALUES ('6', 'eadfasdf4', '王五', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633662&di=eadb16a9709a54d9f64e070cdab83306&imgtype=0&src=http%3A%2F%2Fpics0.baidu.com%2Ffeed%2Fd043ad4bd11373f0672390d9ac347cfdfbed041d.jpeg%3Ftoken%3Df49090c2801dc2de366dd8b36359ac5e%26s%3DFDA639774343534D17E815E501007032', '0', '山东', null, '怀柔', '1111111', '70', '0', '美国');
INSERT INTO `user` VALUES ('7', 'fdaff43gt', '王刘', 'https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1583805633661&di=aee4a51bd344e2d57724c807f4730176&imgtype=0&src=http%3A%2F%2Fimg.qqzhi.com%2Fuploads%2F2018-11-29%2F220729963.jpg', null, '江苏', null, '密云', '1111111111', '50', '0', '日本');
INSERT INTO `user` VALUES ('8', '1343243', null, null, null, null, null, null, '1584250851', '18', '0', null);
INSERT INTO `user` VALUES ('13', 'oTLzs4t8fUK4IdaqwTYcciNYSlxM', '挑战10d', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLjLkLnjZXzaOTELTvCT9n8OXqkOf8iczYhDIuSibrKaYSKaiaO1w8TC5JIMxPy1VUfKRbtfrVOI7Zog/132', '1', '上海', '杨浦', null, '1584320973', '18', '0', '中国');

-- ----------------------------
-- Table structure for works
-- ----------------------------
DROP TABLE IF EXISTS `works`;
CREATE TABLE `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `pageView` int(11) DEFAULT NULL,
  `praiseNum` int(11) DEFAULT NULL,
  `tuijian` tinyint(4) DEFAULT '0' COMMENT '0 默认 1，推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of works
-- ----------------------------
INSERT INTO `works` VALUES ('10', '13', '7', '1584330722', '20200316/c77884ef97d913d97dad1361c51b49ef.png', '13213', '0', '0');
INSERT INTO `works` VALUES ('11', '13', '6', '1584330760', '20200316/20aacc997f5392ab2a4d7c1dca924029.png', '23', '0', '0');
INSERT INTO `works` VALUES ('12', '13', '6', '1584330852', '20200316/f4b66d01636a5e1a0923dbe09db15f15.png', '2323', '0', '0');
INSERT INTO `works` VALUES ('13', '13', '6', '1584332080', '20200316/fdf059b7cedcbad7f66d7d39d71b0417.png', '2131', '0', '0');
INSERT INTO `works` VALUES ('14', '13', '5', '1584332448', '20200316/bd6b9be6d70764ca374d4952ad826024.png', '231321', '0', '0');
INSERT INTO `works` VALUES ('15', '13', '5', '1584332472', '20200316/8e913d6a0e833be6598de8d844149d40.png', '323', '0', '0');
INSERT INTO `works` VALUES ('16', '13', '4', '1584337193', '20200316/cd6a420fae98acfaaf18f04a9db87194.png', '2', '0', '0');
INSERT INTO `works` VALUES ('17', '13', '2', '1584337386', '20200316/24d7370b81ef533f903e52e9e5e376b5.png', '2121', '0', '0');
INSERT INTO `works` VALUES ('18', '13', '1', '1584338164', '20200316/e7e29323e179731fe9d89814676abb8a.png', '21', '0', '0');
INSERT INTO `works` VALUES ('19', '13', '3', '1584338229', '20200316/bdd16b129318256fba973085766c52e4.png', '2111', '0', '0');
INSERT INTO `works` VALUES ('20', '13', '3', '1584338348', '20200316/ebb9ca4105927b642422975ee4711116.png', '211', '0', '0');
INSERT INTO `works` VALUES ('21', '13', '8', '1584338423', '20200316/9e5eceeb7ec30e6952ae434713c6159d.png', '1112', '0', '0');
INSERT INTO `works` VALUES ('22', '13', '4', '1584338503', '20200316/4a3ea0bf9426cc03f3f6710cbd323069.png', '111', '0', '0');
INSERT INTO `works` VALUES ('23', '13', '2', '1584338534', '20200316/e9b142c70ec78b87e5165071fcd4370a.png', '112', '0', '0');
INSERT INTO `works` VALUES ('24', '13', '7', '1584338649', '20200316/9b0e6c7ce01d0bcaa88c07e12978d4f8.png', '332', '0', '0');
INSERT INTO `works` VALUES ('25', '13', '6', '1584338788', '20200316/095f9f4636bd6ee735d837b99b5bb481.png', '1123', '0', '0');
INSERT INTO `works` VALUES ('26', '13', '5', '1584338967', '20200316/48af211506c40a460d5bc2e8a1efc0f7.png', '112', '0', '0');
INSERT INTO `works` VALUES ('27', '13', '5', '1584339262', '20200316/ad208cc048955c3db2df74678d4d50a6.png', '121', '0', '0');
INSERT INTO `works` VALUES ('28', '13', '5', '1584339340', '20200316/6a7485f1debfa1bf744d61ce0ed9ab99.png', '43', '0', '0');
INSERT INTO `works` VALUES ('29', '13', '5', '1584353259', '20200316/567df05ff89ecf4cec030498647b3f57.png', '432', '0', '0');
INSERT INTO `works` VALUES ('30', '13', '4', '1584353311', '20200316/d12962fe9c4edfe22037192a083494ea.png', '121', '0', '0');
INSERT INTO `works` VALUES ('31', '13', '2', '1584353344', '20200316/9507228e27ccd6141bbbfa5df73f5112.png', '0', '0', '0');
INSERT INTO `works` VALUES ('32', '13', '7', '1584353450', '20200316/c2f9ce503a2d79cdc2a10c0f95f50c16.png', '2124', '0', '1');
INSERT INTO `works` VALUES ('33', '3', '3', '1584353525', '20200316/84c4cc1bfd698b805791edea59c126ed.png', '2346', '0', '1');
INSERT INTO `works` VALUES ('34', '13', '3', '1584353958', '20200316/120bfd8fb1897e4feb26fea3ba747429.png', '1', '0', '1');
INSERT INTO `works` VALUES ('35', '13', '2', '1584354674', '20200316/b122a88fee4238c68eb2224bf0a3531a.png', '0', '0', '1');
INSERT INTO `works` VALUES ('36', '13', '3', '1584417832', '20200317/2544cb777d3a8d00105cb3a413d95f48.png', '3', '0', '1');
INSERT INTO `works` VALUES ('37', '13', '7', '1584417864', '20200317/89b8295e5c4ab181515ed298ef10fc6a.png', '0', '0', '1');
INSERT INTO `works` VALUES ('38', '13', '4', '1584418134', '20200317/5fdf7f08cf90a7f94696209f1c1113e8.png', '0', '0', '1');
INSERT INTO `works` VALUES ('39', '13', '1', '1584418300', '20200317/3fe44e17ab7ec4e2e733baecbc54350e.png', '0', '0', '1');
INSERT INTO `works` VALUES ('40', '13', '2', '1584418383', '20200317/e08d15704df955017495542a360ec613.png', '0', '0', '1');
INSERT INTO `works` VALUES ('41', '13', '5', '1584418463', '20200317/7dee8d18bfa5007d4521ec0d7cfda5e4.png', '0', '0', '1');
