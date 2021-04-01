/*
 Navicat Premium Data Transfer

 Source Server         : 本地-测试库
 Source Server Type    : MySQL
 Source Server Version : 50641
 Source Host           : localhost:3306
 Source Schema         : yeb

 Target Server Type    : MySQL
 Target Server Version : 50641
 File Encoding         : 65001

 Date: 22/02/2021 11:43:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `telephone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '住宅电话',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '联系地址',
  `enabled` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否启用',
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '密码',
  `user_face` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户头像',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES (1001, 'admin', '13800000000', '13800000000', '江苏省无锡市梁溪区晶品公寓', '1', 'admin', '$2a$10$cdBBpkAeGZJepglxTy7fJeVmNNcWutBC6eFt7/I0HxXMqqPxT4OP6', NULL, '管理员');
INSERT INTO `t_admin` VALUES (1002, 'hr', '13800000000', '13800000000', '江苏省无锡市梁溪区晶品公寓', '1', 'hr', '$2a$10$cdBBpkAeGZJepglxTy7fJeVmNNcWutBC6eFt7/I0HxXMqqPxT4OP6', '', '人事部用户');

-- ----------------------------
-- Table structure for t_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_role`;
CREATE TABLE `t_admin_role`  (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `admin_id` int(50) NULL DEFAULT NULL COMMENT '用户id',
  `rid` int(50) NULL DEFAULT NULL COMMENT '权限id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_admin_role
-- ----------------------------
INSERT INTO `t_admin_role` VALUES (1, 1001, 900);
INSERT INTO `t_admin_role` VALUES (5, 1002, 900);
INSERT INTO `t_admin_role` VALUES (6, 1002, 901);

-- ----------------------------
-- Table structure for t_appraise
-- ----------------------------
DROP TABLE IF EXISTS `t_appraise`;
CREATE TABLE `t_appraise`  (
  `id` int(11) NOT NULL,
  `eid` int(11) NULL DEFAULT NULL COMMENT '员工id',
  `app_date` date NULL DEFAULT NULL COMMENT '考评日期',
  `app_result` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '考评结果',
  `app_content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '考评内容',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_appraise
-- ----------------------------

-- ----------------------------
-- Table structure for t_department
-- ----------------------------
DROP TABLE IF EXISTS `t_department`;
CREATE TABLE `t_department`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '部门名称',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父id',
  `dep_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路径',
  `enabled` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1' COMMENT '是否启用',
  `is_parent` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0' COMMENT '是否上级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_department
-- ----------------------------
INSERT INTO `t_department` VALUES (1, '股东会', -1, '.1', '1', '1');
INSERT INTO `t_department` VALUES (2, '董事会', 1, '.1.2', '1', '1');
INSERT INTO `t_department` VALUES (3, '总办', 2, '.1.2.3', '1', '1');
INSERT INTO `t_department` VALUES (4, '财务办', 3, '.1.2.3.4', '1', '0');
INSERT INTO `t_department` VALUES (5, '市场部', 3, '.1.2.3.5', '1', '1');
INSERT INTO `t_department` VALUES (6, '华东市场部', 5, '.1.2.3.5.6', '1', '1');
INSERT INTO `t_department` VALUES (7, '华南市场部', 5, '.1.2.3.5.7', '1', '0');
INSERT INTO `t_department` VALUES (8, '上海市场部', 6, '.1.2.3.5.6.8', '1', '0');
INSERT INTO `t_department` VALUES (9, '西北市场部', 5, '.1.2.3.5.9', '1', '1');
INSERT INTO `t_department` VALUES (10, '贵阳市场部', 9, '.1.2.3.5.9.10', '1', '1');
INSERT INTO `t_department` VALUES (11, '乌当区市场部', 10, '.1.2.3.5.9.10.11', '1', '0');
INSERT INTO `t_department` VALUES (12, '技术部', 3, '.1.2.3.12', '1', '0');
INSERT INTO `t_department` VALUES (13, '运维部', 3, '.1.2.3.13', '1', '0');

-- ----------------------------
-- Table structure for t_employee
-- ----------------------------
DROP TABLE IF EXISTS `t_employee`;
CREATE TABLE `t_employee`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '员工编号',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '员工姓名',
  `gender` enum('男','女') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '性别',
  `birthday` date NULL DEFAULT NULL COMMENT '出生日期',
  `id_card` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号',
  `wedlock` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '婚姻状况',
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_employee
-- ----------------------------
INSERT INTO `t_employee` VALUES (1, '韦梅', '女', '1999-11-20', '341502198810194', '未', 1, '关岭市1', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33726, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `t_employee` VALUES (2, '张三', '男', '1999-11-20', '341502198810194', '未', 1, '关岭市2', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33727, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `t_employee` VALUES (3, '王五', '男', '1999-11-20', '341502198810194', '未', 1, '关岭市3', 1, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 1, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33728, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', 1);
INSERT INTO `t_employee` VALUES (6, '韦梅1', '女', '1999-11-20', '341502198810194', '未', 2, '关岭市1', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 3, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33726, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);
INSERT INTO `t_employee` VALUES (7, '张三2', '男', '1999-11-20', '341502198810194', '未', 2, '关岭市2', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 4, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33727, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);
INSERT INTO `t_employee` VALUES (8, '王五3', '男', '1999-11-20', '341502198810194', '未', 2, '关岭市3', 2, 'test@163.com', '15567487644', '贵州市关岭县朱北组13号', 3, 1, 5, '劳务合同', '中专', '1', '1', '2021-02-01', '试用期', 33728, 1, '2021-02-16', '2021-02-17', '2021-02-01', '2021-02-25', '1', NULL);

-- ----------------------------
-- Table structure for t_employee_ec
-- ----------------------------
DROP TABLE IF EXISTS `t_employee_ec`;
CREATE TABLE `t_employee_ec`  (
  `id` int(11) NOT NULL,
  `eid` int(11) NULL DEFAULT NULL COMMENT '员工编号',
  `ec_date` datetime(0) NULL DEFAULT NULL COMMENT '奖罚日期',
  `ec_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '奖罚原因',
  `ec_point` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '奖罚分',
  `ec_type` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '奖罚类别，0：奖，1：罚',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_employee_ec
-- ----------------------------

-- ----------------------------
-- Table structure for t_employee_remove
-- ----------------------------
DROP TABLE IF EXISTS `t_employee_remove`;
CREATE TABLE `t_employee_remove`  (
  `id` int(11) NOT NULL,
  `eid` int(11) NULL DEFAULT NULL COMMENT '员工id',
  `after_dep_id` int(11) NULL DEFAULT NULL COMMENT '调动后部门',
  `after_job_id` int(11) NULL DEFAULT NULL COMMENT '调动后职位',
  `remove_date` datetime(0) NULL DEFAULT NULL COMMENT '调动日期',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '调动原因',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_employee_remove
-- ----------------------------

-- ----------------------------
-- Table structure for t_employee_train
-- ----------------------------
DROP TABLE IF EXISTS `t_employee_train`;
CREATE TABLE `t_employee_train`  (
  `id` int(11) NOT NULL,
  `eid` int(11) NULL DEFAULT NULL COMMENT '员工编号',
  `train_date` datetime(0) NULL DEFAULT NULL COMMENT '培训日期',
  `train_content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '培训内容',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_employee_train
-- ----------------------------

-- ----------------------------
-- Table structure for t_joblevel
-- ----------------------------
DROP TABLE IF EXISTS `t_joblevel`;
CREATE TABLE `t_joblevel`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职称名称',
  `title_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职称等级',
  `create_date` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `enabled` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_joblevel
-- ----------------------------
INSERT INTO `t_joblevel` VALUES (1, '测试', '2', '2021-02-17 00:11:14', '1');
INSERT INTO `t_joblevel` VALUES (2, '测试2', '2', '2021-02-17 00:11:14', '1');

-- ----------------------------
-- Table structure for t_mail_log
-- ----------------------------
DROP TABLE IF EXISTS `t_mail_log`;
CREATE TABLE `t_mail_log`  (
  `msgId` int(11) NOT NULL COMMENT '消息id',
  `eid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '接收员工id',
  `status` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '状态（0:消息投递中 1:投递成功 2:投递失败）',
  `routeKey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '路由键',
  `exchange` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '交换机',
  `count` int(11) NULL DEFAULT NULL COMMENT '重试次数',
  `tryTime` datetime(0) NULL DEFAULT NULL COMMENT '重试时间',
  `createTime` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `updateTime` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`msgId`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_mail_log
-- ----------------------------

-- ----------------------------
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu`  (
  `id` int(11) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `component` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '组件',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '菜单名',
  `iconCls` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  `keep_alive` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否保持激活',
  `require_auth` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否要求权限',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '父id',
  `enabled` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES (100, NULL, NULL, NULL, '所有', NULL, NULL, NULL, NULL, '1');
INSERT INTO `t_menu` VALUES (200, '/', '/home', 'Home', '员工资料', 'fa fa-user-circle-o', NULL, '1', 100, '1');
INSERT INTO `t_menu` VALUES (201, '/employee/basic/**', '/emp/basic', 'EmpBasic', '基本资料', '', NULL, '1', 200, '1');
INSERT INTO `t_menu` VALUES (202, '/employee/advanced/**', '/emp/adv', 'EmpAdv', '高级资料', '', NULL, '1', 200, '1');
INSERT INTO `t_menu` VALUES (300, '/', '/home', 'Home', '人事资料', 'fa fa-address-card-o', NULL, '1', 100, '1');
INSERT INTO `t_menu` VALUES (301, '/personal/emp/**', '/per/emp', 'PerEmp', '员工资料', NULL, NULL, '1', 300, '1');
INSERT INTO `t_menu` VALUES (302, '/personal/ec/**', '/per/ec', 'PerEc', '员工奖惩', NULL, NULL, '1', 300, '1');
INSERT INTO `t_menu` VALUES (303, '/personal/train/**', '/per/train', 'PerTrain', '员工培训', NULL, NULL, '1', 300, '1');
INSERT INTO `t_menu` VALUES (304, '/personal/salary/**', '/per/salary', 'PerSalary', '员工调薪', NULL, NULL, '1', 300, '1');
INSERT INTO `t_menu` VALUES (305, '/personal/remove/**', '/per/mv', 'PerMv', '员工调动', NULL, NULL, '1', 300, '1');
INSERT INTO `t_menu` VALUES (400, '/', '/home', 'Home', '薪资管理', 'fa fa-money', NULL, '1', 100, '1');
INSERT INTO `t_menu` VALUES (401, '/salary/sob/**', '/salary/sob', 'SalSob', '工资账套管理', NULL, NULL, '1', 400, '1');
INSERT INTO `t_menu` VALUES (402, '/salary/sobcfg/**', '/salary/sobcfg', 'SalSobCfg', '员工工资账套设置', NULL, NULL, '1', 400, '1');
INSERT INTO `t_menu` VALUES (403, '/salary/table/**', '/salary/table', 'SalTable', '工资表管理', NULL, NULL, '1', 400, '1');
INSERT INTO `t_menu` VALUES (404, '/salary/month/**', '/salary/month', 'SalMonth', '月末处理', NULL, NULL, '1', 400, '1');
INSERT INTO `t_menu` VALUES (405, '/salary/search/**', '/salary/search', 'SalSearch', '工资表管理', NULL, NULL, '1', 400, '1');
INSERT INTO `t_menu` VALUES (500, '/', '/home', 'Home', '统计管理', 'fa fa-bar-chart', NULL, '1', 100, '1');
INSERT INTO `t_menu` VALUES (501, '/statistics/all/**', '/sta/all', 'StaAll', '综合信息统计', NULL, NULL, '1', 500, '1');
INSERT INTO `t_menu` VALUES (502, '/statistics/score/**', '/sta/score', 'StaScore', '员工积分统计', NULL, NULL, '1', 500, '1');
INSERT INTO `t_menu` VALUES (503, '/statistics/personal/**', '/sta/pers', 'StaPers', '人事信息统计', NULL, NULL, '1', 500, '1');
INSERT INTO `t_menu` VALUES (504, '/statistics/record/**', '/sta/record', 'StaRecord', '基础信息统计', NULL, NULL, '1', 500, '1');
INSERT INTO `t_menu` VALUES (600, '/', '/home', 'Home', '系统管理', 'fa fa-windows', NULL, '1', 100, '1');
INSERT INTO `t_menu` VALUES (601, '/system/basic/**', '/sys/basic', 'SysBasic', '基础信息设置', NULL, NULL, '1', 600, '1');
INSERT INTO `t_menu` VALUES (602, '/system/cfg/**', '/sys/cfg', 'SysCfg', '系统管理', NULL, NULL, '1', 600, '1');
INSERT INTO `t_menu` VALUES (603, '/system/log/**', '/sys/log', 'SysLog', '操作日志管理', NULL, NULL, '1', 600, '1');
INSERT INTO `t_menu` VALUES (604, '/system/admin/**', '/sys/basic', 'SysAdmin', '操作员管理', NULL, NULL, '1', 600, '1');
INSERT INTO `t_menu` VALUES (605, '/system/data/**', '/sys/basic', 'SysData', '备份恢复数据库', NULL, NULL, '1', 600, '1');
INSERT INTO `t_menu` VALUES (606, '/system/init/**', '/sys/init', 'SysInit', '初始化数据库', NULL, NULL, '1', 600, '1');

-- ----------------------------
-- Table structure for t_menu_role
-- ----------------------------
DROP TABLE IF EXISTS `t_menu_role`;
CREATE TABLE `t_menu_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NULL DEFAULT NULL COMMENT '菜单id',
  `rid` int(11) NULL DEFAULT NULL COMMENT '权限id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_menu_role
-- ----------------------------
INSERT INTO `t_menu_role` VALUES (9, 301, 901);
INSERT INTO `t_menu_role` VALUES (10, 302, 901);
INSERT INTO `t_menu_role` VALUES (11, 303, 901);
INSERT INTO `t_menu_role` VALUES (12, 304, 901);

-- ----------------------------
-- Table structure for t_nation
-- ----------------------------
DROP TABLE IF EXISTS `t_nation`;
CREATE TABLE `t_nation`  (
  `id` int(11) NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '民族',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_nation
-- ----------------------------
INSERT INTO `t_nation` VALUES (1, '汉族');
INSERT INTO `t_nation` VALUES (2, '苗族');

-- ----------------------------
-- Table structure for t_oplog
-- ----------------------------
DROP TABLE IF EXISTS `t_oplog`;
CREATE TABLE `t_oplog`  (
  `id` int(11) NOT NULL,
  `add_date` datetime(0) NULL DEFAULT NULL COMMENT '添加日期',
  `operate` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作内容',
  `adminid` int(11) NULL DEFAULT NULL COMMENT '操作员ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_oplog
-- ----------------------------

-- ----------------------------
-- Table structure for t_politics_status
-- ----------------------------
DROP TABLE IF EXISTS `t_politics_status`;
CREATE TABLE `t_politics_status`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '政治面貌',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_politics_status
-- ----------------------------
INSERT INTO `t_politics_status` VALUES (1, '群众');
INSERT INTO `t_politics_status` VALUES (2, '党员');

-- ----------------------------
-- Table structure for t_position
-- ----------------------------
DROP TABLE IF EXISTS `t_position`;
CREATE TABLE `t_position`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '职位',
  `create_date` date NULL DEFAULT NULL COMMENT '创建时间',
  `enabled` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_position
-- ----------------------------
INSERT INTO `t_position` VALUES (1, '技术总监', '2021-02-14', '1');
INSERT INTO `t_position` VALUES (2, '运营总监', '2021-02-14', '1');
INSERT INTO `t_position` VALUES (3, '市场总监', '2021-02-14', '1');
INSERT INTO `t_position` VALUES (4, '研发工程师', '2021-02-14', '1');
INSERT INTO `t_position` VALUES (5, '运维工程师', '2021-02-14', '1');

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role`  (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  `name_zh` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '角色名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES (900, 'ROLE_admin', '系统管理员');
INSERT INTO `t_role` VALUES (901, 'ROLE_person', '人力资源用户');

-- ----------------------------
-- Table structure for t_salary
-- ----------------------------
DROP TABLE IF EXISTS `t_salary`;
CREATE TABLE `t_salary`  (
  `id` int(11) NOT NULL,
  `basicSalary` decimal(10, 2) NULL DEFAULT NULL COMMENT '基本工资',
  `bonus` decimal(10, 0) NULL DEFAULT NULL COMMENT '奖金',
  `lunchSalary` decimal(10, 2) NULL DEFAULT NULL COMMENT '午餐补助',
  `trafficSalary` decimal(10, 2) NULL DEFAULT NULL COMMENT '交通补助',
  `allSalary` decimal(10, 2) NULL DEFAULT NULL COMMENT '应发工资',
  `pensionBase` decimal(10, 0) NULL DEFAULT NULL COMMENT '养老金基数',
  `pensionPer` decimal(10, 0) NULL DEFAULT NULL COMMENT '养老金比率',
  `createDate` datetime(0) NULL DEFAULT NULL COMMENT '启用时间',
  `medicalBase` decimal(10, 0) NULL DEFAULT NULL COMMENT '医疗基数',
  `medicalPer` decimal(10, 0) NULL DEFAULT NULL COMMENT '医疗保险比率',
  `accumulationFundBase` decimal(10, 0) NULL DEFAULT NULL COMMENT '公积金基数',
  `accumulationFundPer` decimal(10, 0) NULL DEFAULT NULL COMMENT '公积金比率',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_salary
-- ----------------------------

-- ----------------------------
-- Table structure for t_sys_msg
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_msg`;
CREATE TABLE `t_sys_msg`  (
  `id` int(11) NOT NULL,
  `msgid` int(11) NULL DEFAULT NULL COMMENT '消息id',
  `type` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '0表示群发消息',
  `sendid` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '这条消息是给谁的',
  `state` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '0 未读 1 已读',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_sys_msg
-- ----------------------------

-- ----------------------------
-- Table structure for t_sys_msg_content
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_msg_content`;
CREATE TABLE `t_sys_msg_content`  (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '内容',
  `create_date` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_sys_msg_content
-- ----------------------------

-- ----------------------------
-- Procedure structure for addDep
-- ----------------------------
DROP PROCEDURE IF EXISTS `addDep`;
delimiter ;;
CREATE PROCEDURE `addDep`(in depName VARCHAR(32),in parentId int,in enabled boolean,out result int,out result2 int)
BEGIN
	#Routine body goes here...
	DECLARE did int;
	DECLARE pDepPath VARCHAR(64);
	#插入部门记录
	INSERT INTO t_department set name = depName,parent_id = parentId,enabled = enabled;
	SELECT ROW_COUNT() into result;
	SELECT LAST_INSERT_ID() into did;
	set result2 = did;
	select dep_path into pDepPath FROM t_department where id=parentId;
	#拼接depPath
	UPDATE t_department set dep_path = CONCAT(pDepPath,'.',did) WHERE id=did;
	UPDATE t_department set is_parent = 1 WHERE id = parentId;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for deleteDep
-- ----------------------------
DROP PROCEDURE IF EXISTS `deleteDep`;
delimiter ;;
CREATE PROCEDURE `deleteDep`(in did int,out result int)
BEGIN
	DECLARE ecount int;
	DECLARE pid int;
	DECLARE pcount int;
	DECLARE a int;
	
	#查询当前的部门id是否是子部门
	SELECT count(1) INTO a from t_department where id = did and is_parent = 0;
	
	if a = 0 THEN 
		set result = -2;
	ELSE
		#查询该部门下是否有员工，如果有员工，则result返回-1
		SELECT count(1) into ecount from t_employee where department_id = did;
	
		if ecount > 0 then
			set result = -1;
		else
			select parent_id into pid from t_department WHERE id = did;
		
			DELETE from t_department WHERE id=did and is_parent = 0;
			
			select ROW_COUNT() into result;
			
			#执行完删除操作后，判断删除部门的上级部门是否还存在其他子部门，如果不存在，则将is_parent设置为false
			SELECT count(1) into pcount from t_department where parent_id = pid;
			
			if pcount=0 then
				update t_department set is_parent = 0 where id=pid;
			end if;
		END if;
	END if;
	
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
