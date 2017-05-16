CREATE TABLE IF NOT EXISTS `zwkj`.`member`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL COMMENT '用户名',
    `password` CHAR(32) NOT NULL COMMENT '密码',
    `create_time` INT(10) NOT NULL COMMENT '创建时间',
    `nick_name` VARCHAR(50) NULL DEFAULT NULL,
    `uuid` CHAR(36) NOT NULL,
    `email` VARCHAR(30) NULL DEFAULT NULL COMMENT '邮箱',
    `status` CHAR(1) NOT NULL DEFAULT '1' COMMENT '1启用，2禁用',
    `last_time` INT(10) NOT NULL COMMENT '最后登录时间',
    `wechat_openid` VARCHAR(64) NULL DEFAULT NULL COMMENT '微信openid',
    `qq_openid` VARCHAR(64) NULL DEFAULT NULL COMMENT 'qqopenid',
    `sina_openid` VARCHAR(64) NULL DEFAULT NULL COMMENT '微博openid',
    PRIMARY KEY(`id`),
    UNIQUE INDEX `phone`(`username` ASC)
) ENGINE = MyISAM AUTO_INCREMENT = 18 DEFAULT CHARACTER SET = utf8; -- ----------------------------------------------------- -- Table `zwkj`.`province` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`province`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = MyISAM COMMENT = '省份'; -- ----------------------------------------------------- -- Table `zwkj`.`city` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`city`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NULL,
    `zip` INT(6) NULL,
    `province_id` INT NOT NULL,
    PRIMARY KEY(`id`),
    INDEX `fk_city_province1_idx`(`province_id` ASC)
) ENGINE = MyISAM COMMENT = '市级'; -- ----------------------------------------------------- -- Table `zwkj`.`dictionary_industry` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`dictionary_industry`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NOT NULL,
    `key` VARCHAR(45) NOT NULL COMMENT '行业标示',
    `create_time` INT(10) NOT NULL,
    `create_user` INT(11) NOT NULL,
    `update_user` INT(11) NOT NULL,
    `update_time` INT(10) NOT NULL,
    `status` TINYINT(1) NOT NULL COMMENT '状态：1、正常；2、禁用',
    PRIMARY KEY(`id`),
    INDEX `fk_dictionary_coupon_type_user_idx`(`create_user` ASC),
    INDEX `fk_dictionary_coupon_type_user1_idx`(`update_user` ASC)
) ENGINE = MyISAM COMMENT = '行业分类'; -- ----------------------------------------------------- -- Table `zwkj`.`we_chat` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`we_chat`(
    `id` CHAR(32) NOT NULL COMMENT '主键',
    `title` VARCHAR(100) NOT NULL COMMENT '名称',
    `account` VARCHAR(100) NOT NULL COMMENT '微信账号',
    `primitive_id` VARCHAR(100) NOT NULL COMMENT '微信号原始ID',
    `app_id` VARCHAR(18) NOT NULL COMMENT 'APP',
    `app_secret` VARCHAR(32) NOT NULL,
    `token` VARCHAR(32) NOT NULL COMMENT '随机生成字符串验证机制',
    `aes_key` CHAR(43) NOT NULL COMMENT '消息加密字符串',
    `qr_code` VARCHAR(100) NOT NULL COMMENT '微信二维码',
    `create_time` INT(10) NOT NULL,
    `update_time` INT(10) NOT NULL,
    `status` ENUM('0', '1') NOT NULL DEFAULT '1' COMMENT '状态：1、有效；2、无效',
    `create_member` INT(11) NOT NULL,
    `industry_id` INT NOT NULL COMMENT '行业分类',
    `city_id` INT NOT NULL COMMENT '归属城市',
    PRIMARY KEY(`id`),
    INDEX `fk_we_chat_member1_idx`(`create_member` ASC),
    INDEX `fk_we_chat_dictionary_industry1_idx`(`industry_id` ASC),
    INDEX `fk_we_chat_city1_idx`(`city_id` ASC)
) ENGINE = MyISAM COMMENT = '微信端'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(200) NOT NULL,
    `address` VARCHAR(300) NOT NULL COMMENT '店铺地址',
    `restaurantcol` VARCHAR(45) NULL,
    `membership` CHAR(1) NOT NULL DEFAULT '1' COMMENT '是否开启会员：1、开启会员；2、不开启会员',
    `city_id` INT NOT NULL,
    `we_chat_id` CHAR(32) NOT NULL COMMENT '订单信息',
    PRIMARY KEY(`id`),
    INDEX `fk_restaurant_city1_idx`(`city_id` ASC),
    INDEX `fk_restaurant_we_chat1_idx`(`we_chat_id` ASC),
    CONSTRAINT `fk_restaurant_city1` FOREIGN KEY(`city_id`) REFERENCES `zwkj`.`city`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_restaurant_we_chat1` FOREIGN KEY(`we_chat_id`) REFERENCES `zwkj`.`we_chat`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB COMMENT = '店铺信息'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant_member` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant_member`(
    `member_id` INT(11) NOT NULL,
    `restaurant_id` INT NOT NULL,
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(200) NOT NULL,
    `discount` VARCHAR(45) NULL,
    INDEX `fk_restaurant_member_member1_idx`(`member_id` ASC),
    INDEX `fk_restaurant_member_restaurant1_idx`(`restaurant_id` ASC),
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_restaurant_member_member1` FOREIGN KEY(`member_id`) REFERENCES `zwkj`.`member`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_restaurant_member_restaurant1` FOREIGN KEY(`restaurant_id`) REFERENCES `zwkj`.`restaurant`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB COMMENT = '店铺VIP资料'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant_order` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant_order`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `key` CHAR(38) NOT NULL COMMENT '订单编号',
    `create_time` INT(10) NOT NULL COMMENT '订单创建时间',
    `status` CHAR(1) NOT NULL,
    `desk` INT NULL COMMENT '桌子号码',
    `we_chat_id` CHAR(32) NOT NULL COMMENT '归属服务号',
    `restaurant_id` INT NOT NULL COMMENT '店铺',
    `price` FLOAT(20, 2) NOT NULL COMMENT '总价',
    PRIMARY KEY(`id`),
    INDEX `fk_restaurant_order_we_chat1_idx`(`we_chat_id` ASC),
    INDEX `fk_restaurant_order_restaurant1_idx`(`restaurant_id` ASC),
    UNIQUE INDEX `key`(`key` ASC),
    CONSTRAINT `fk_restaurant_order_we_chat1` FOREIGN KEY(`we_chat_id`) REFERENCES `zwkj`.`we_chat`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_restaurant_order_restaurant1` FOREIGN KEY(`restaurant_id`) REFERENCES `zwkj`.`restaurant`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB COMMENT = '餐饮订单'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant_bill` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant_bill`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `member_id` INT(11) NOT NULL,
    `order_id` INT NULL,
    `create_time` INT(10) NOT NULL,
    `reserve_time` INT(10) NOT NULL COMMENT '预定时间',
    PRIMARY KEY(`id`),
    INDEX `fk_restaurant_bill_member1_idx`(`member_id` ASC),
    INDEX `fk_restaurant_bill_restaurant_order1_idx`(`order_id` ASC),
    CONSTRAINT `fk_restaurant_bill_member1` FOREIGN KEY(`member_id`) REFERENCES `zwkj`.`member`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT `fk_restaurant_bill_restaurant_order1` FOREIGN KEY(`order_id`) REFERENCES `zwkj`.`restaurant_order`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB COMMENT = '订餐临时表'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant_food` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant_food`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(200) NOT NULL COMMENT '菜名',
    `price` FLOAT(10, 2) NOT NULL COMMENT '菜品价格',
    `img` VARCHAR(100) NOT NULL COMMENT '菜品图片',
    `membership` CHAR(1) NOT NULL DEFAULT '2' COMMENT '是否参与会员打折：1、参与；2、不参与',
    `content` TEXT NULL COMMENT '菜品内容描述',
    `create_time` INT(10) NOT NULL,
    `update_time` INT(10) NOT NULL,
    `restaurant_id` INT NOT NULL COMMENT '关联商家',
    `create_member` INT(11) NOT NULL,
    `update_member` INT(11) NOT NULL,
    `we_chat_id` CHAR(32) NOT NULL COMMENT '为多店铺做准备',
    `number` INT NOT NULL DEFAULT 0 COMMENT '销量',
    PRIMARY KEY(`id`),
    INDEX `fk_restaurant_food_restaurant1_idx`(`restaurant_id` ASC),
    INDEX `fk_restaurant_food_member1_idx`(`create_member` ASC),
    INDEX `fk_restaurant_food_member2_idx`(`update_member` ASC),
    INDEX `fk_restaurant_food_we_chat1_idx`(`we_chat_id` ASC)
) ENGINE = MyISAM COMMENT = '饭店菜品'; -- ----------------------------------------------------- -- Table `zwkj`.`restaurant_order_food` -- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `zwkj`.`restaurant_order_food`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `order_id` INT NOT NULL COMMENT '关联订单',
    `img` VARCHAR(100) NOT NULL COMMENT '图片',
    `title` VARCHAR(200) NOT NULL COMMENT '菜名',
    `price` FLOAT(10, 2) NOT NULL COMMENT '价格',
    `number` TINYINT NOT NULL DEFAULT 1 COMMENT '购买数量',
    `create_time` INT(10) NOT NULL,
    PRIMARY KEY(`id`),
    INDEX `fk_restaurant_order_food_restaurant_order1_idx`(`order_id` ASC),
    CONSTRAINT `fk_restaurant_order_food_restaurant_order1` FOREIGN KEY(`order_id`) REFERENCES `zwkj`.`restaurant_order`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB COMMENT = '订单菜品列表';