<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define('__TTDF_FIELDS__', false); // 是否开启自定义字段
$TTDF_Avatar = 'https://cravatar.cn/avatar/'; // 配置Avatar源

/**
 * 路由配置
 * @var bool $TTDF_ROUTE 是否开启路由功能
 * @var bool $TTDF_RESTAPI 是否开启 `REST API`
 * @var string $TTDF_RESTAPI_ROUTE `REST API`的路由配置
 * @example 主题注册设置项 TTDF_RESTAPI_Switch 值为 true 时，开启 REST API 功能
 */
$TTDF_ROUTE = false;
$TTDF_RESTAPI = false;
$TTDF_RESTAPI_ROUTE = 'Uika/API'; 

// 引入框架配置文件
require_once 'Core/TTDF.php';

/**
 * 自定义function代码
 * @example 下方写入主题的自定义代码
 */
require_once 'Core/Uika.php';