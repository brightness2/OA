/*
 Navicat Premium Data Transfer

 Source Server         : 虚拟机
 Source Server Type    : MariaDB
 Source Server Version : 50568
 Source Host           : 192.168.174.129:3306
 Source Schema         : oa

 Target Server Type    : MariaDB
 Target Server Version : 50568
 File Encoding         : 65001

 Date: 01/04/2021 08:39:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `telephone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '住宅电话',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '联系地址',
  `enabled` tinyint(4) NULL DEFAULT NULL COMMENT '是否启用',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户头像',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, '管理员', '13800000000', '13800000000', '江苏省无锡市梁溪区晶品公寓', 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'http://192.168.174.129/images/admin1.jpg', '管理员');
INSERT INTO `admin` VALUES (2, 'HR', '13800000000', '13800000000', '江苏省无锡市梁溪区晶品公寓', 1, 'hr', 'e10adc3949ba59abbe56e057f20f883e', 'http://192.168.174.129/images/admin2.jpg', '人事部用户');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `admin_id` int(50) NULL DEFAULT NULL COMMENT '用户id',
  `role_id` int(50) NULL DEFAULT NULL COMMENT '权限id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES (7, 2, 2);
INSERT INTO `admin_role` VALUES (11, 1, 1);

-- ----------------------------
-- Table structure for department
-- ----------------------------
DROP TABLE IF EXISTS `department`;
CREATE TABLE `department`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '部门名称',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父id',
  `dep_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路径',
  `enabled` tinyint(4) NULL DEFAULT 1 COMMENT '是否启用',
  `is_parent` tinyint(4) NULL DEFAULT 0 COMMENT '是否上级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of department
-- ----------------------------
INSERT INTO `department` VALUES (1, '股东会', 0, '.1', 1, 1);
INSERT INTO `department` VALUES (2, '董事会', 1, '.1.2', 1, 1);
INSERT INTO `department` VALUES (3, '总办', 2, '.1.2.3', 1, 1);
INSERT INTO `department` VALUES (4, '财务办', 3, '.1.2.3.4', 1, 0);
INSERT INTO `department` VALUES (5, '市场部', 3, '.1.2.3.5', 1, 1);
INSERT INTO `department` VALUES (6, '华东市场部', 5, '.1.2.3.5.6', 1, 1);
INSERT INTO `department` VALUES (7, '华南市场部', 5, '.1.2.3.5.7', 1, 0);
INSERT INTO `department` VALUES (8, '上海市场部', 6, '.1.2.3.5.6.8', 1, 0);
INSERT INTO `department` VALUES (9, '西北市场部', 5, '.1.2.3.5.9', 1, 1);
INSERT INTO `department` VALUES (10, '贵阳市场部', 9, '.1.2.3.5.9.10', 1, 1);
INSERT INTO `department` VALUES (11, '乌当区市场部', 10, '.1.2.3.5.9.10.11', 1, 0);
INSERT INTO `department` VALUES (12, '技术部', 3, '.1.2.3.12', 1, 0);
INSERT INTO `department` VALUES (13, '运维部', 3, '.1.2.3.13', 1, 0);

-- ----------------------------
-- Table structure for dict
-- ----------------------------
DROP TABLE IF EXISTS `dict`;
CREATE TABLE `dict`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '字典编号',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字典名称',
  `caption` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字典值',
  `pid` int(11) NULL DEFAULT 0 COMMENT '上级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dict
-- ----------------------------
INSERT INTO `dict` VALUES (1, 'politic', '政治面貌', 0);

-- ----------------------------
-- Table structure for employee
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '员工编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '员工姓名',
  `gender` enum('男','女') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '性别',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `id_card` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号',
  `wedlock` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '婚姻状况',
  `nation_id` int(11) NULL DEFAULT NULL COMMENT '民族',
  `native_place` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '籍贯',
  `politic_id` int(10) NULL DEFAULT NULL COMMENT '政治面貌',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '电话号码',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '联系地址',
  `department_id` int(11) NULL DEFAULT NULL COMMENT '所属部门',
  `job_level_id` int(11) NULL DEFAULT NULL COMMENT '职称ID',
  `pos_id` int(11) NULL DEFAULT NULL COMMENT '职位ID',
  `engage_form` enum('劳务合同','劳务派遣') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '聘用形式',
  `tiptop_degree` enum('中专','大专','本科','研究生','博士') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最高学历',
  `specialty` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '所属专业',
  `school` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '毕业院校',
  `begin_date` date NULL DEFAULT NULL COMMENT '入职日期',
  `work_state` enum('试用期','在职','离职') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '在职状态',
  `work_id` int(11) NULL DEFAULT NULL COMMENT '工号',
  `contract_term` double(10, 0) NULL DEFAULT NULL COMMENT '合同期限',
  `conversion_time` date NULL DEFAULT NULL COMMENT '转正日期',
  `not_work_date` date NULL DEFAULT NULL COMMENT '离职日期',
  `begin_contract` date NULL DEFAULT NULL COMMENT '合同起始日期',
  `end_contract` date NULL DEFAULT NULL COMMENT '合同终止日期',
  `work_age` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工龄',
  `salary_id` int(11) NULL DEFAULT NULL COMMENT '工资账套ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES (1, '韦梅', '女', '1999-11-20', '341502198810194', '未婚', 1, '关岭市1', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33726, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `employee` VALUES (2, '张三', '男', '1999-11-20', '341502198810194', '已婚', 1, '关岭市2', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33727, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `employee` VALUES (3, '王五', '男', '1999-11-20', '341502198810194', '未婚', 1, '关岭市3', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33728, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `employee` VALUES (6, '韦梅1', '女', '1999-11-20', '341502198810194', '已婚', 2, '关岭市1', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 3, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33726, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);
INSERT INTO `employee` VALUES (7, '张三2', '男', '1999-11-20', '341502198810194', '未婚', 2, '关岭市2', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 4, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33727, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);
INSERT INTO `employee` VALUES (8, '王五3', '男', '1999-11-20', '341502198810194', '未婚', 2, '关岭市3', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 5, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33728, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);

-- ----------------------------
-- Table structure for joblevel
-- ----------------------------
DROP TABLE IF EXISTS `joblevel`;
CREATE TABLE `joblevel`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职称名称',
  `level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职称等级',
  `create_date` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `enabled` tinyint(4) NULL DEFAULT 1 COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of joblevel
-- ----------------------------
INSERT INTO `joblevel` VALUES (1, '测试', '正高级', '2021-02-17 00:11:14', 1);
INSERT INTO `joblevel` VALUES (2, '测试2', '员级', '2021-02-17 00:11:14', 1);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '组件',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '菜单名',
  `iconCls` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  `keep_alive` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否保持激活',
  `require_auth` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否要求权限',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父id',
  `enabled` tinyint(4) NULL DEFAULT NULL COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (100, NULL, NULL, NULL, '所有', NULL, NULL, NULL, NULL, 1);
INSERT INTO `menu` VALUES (200, '', '/home', 'Home', '员工资料', 'fa fa-user-circle-o', NULL, '1', 100, 1);
INSERT INTO `menu` VALUES (201, 'employee', '/emp/empBase', 'Emp/EmpBase', '基本资料', NULL, NULL, '1', 200, 1);
INSERT INTO `menu` VALUES (600, '', '/home', 'Home', '系统管理', 'fa fa-user-circle-o', NULL, '1', 100, 1);
INSERT INTO `menu` VALUES (601, 'sysbase', '/sys/sysBase', 'Sys/SysBase', '基础信息设置', NULL, NULL, '1', 600, 1);
INSERT INTO `menu` VALUES (602, 'sysadmin', '/sys/sysAdmin', 'Sys/SysAdmin', '操作员管理', NULL, NULL, '1', 600, 1);

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL COMMENT '菜单id',
  `role_id` int(11) NULL DEFAULT NULL COMMENT '权限id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES (21, 100, 1);
INSERT INTO `menu_role` VALUES (22, 200, 1);
INSERT INTO `menu_role` VALUES (23, 201, 1);
INSERT INTO `menu_role` VALUES (24, 600, 1);
INSERT INTO `menu_role` VALUES (25, 601, 1);
INSERT INTO `menu_role` VALUES (26, 602, 1);
INSERT INTO `menu_role` VALUES (32, 200, 2);
INSERT INTO `menu_role` VALUES (33, 201, 2);
INSERT INTO `menu_role` VALUES (34, 100, 2);

-- ----------------------------
-- Table structure for position
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职位',
  `create_date` date NULL DEFAULT NULL COMMENT '创建时间',
  `enabled` tinyint(4) NULL DEFAULT 1 COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of position
-- ----------------------------
INSERT INTO `position` VALUES (1, '技术总监', '2021-02-14', 1);
INSERT INTO `position` VALUES (2, '运营总监', '2021-02-14', 1);
INSERT INTO `position` VALUES (3, '市场总监', '2021-02-14', 1);
INSERT INTO `position` VALUES (4, '研发工程师', '2021-02-14', 1);
INSERT INTO `position` VALUES (5, '运维工程师', '2021-02-14', 1);
INSERT INTO `position` VALUES (6, 'test', '2021-03-24', 1);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `name_zh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'ROLE_admin', '系统管理员');
INSERT INTO `role` VALUES (2, 'ROLE_person', '人力资源用户');

SET FOREIGN_KEY_CHECKS = 1;
