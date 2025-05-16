<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 加载资源文件
 * @var array $load_dir_name 资源文件目录名称
 * @var array $load_head_css 加载head标签css
 * @var array $load_head_js 加载head标签js
 * @var array $load_foot_js 加载body标签js
 * @example $load_switch = 启用框架加载资源文件
 */
define('__LOAD_SWITCH__', true); // 是否开启加载资源文件
$load_dir_name = 'Assets'; // 资源文件目录名称
$load_head_css = [
    'main.css',
    '_ttdf/message.css',
    'prism/' . Get::Options('Uika_Post_Prism_Css', false) ?: 'Okaidia.css',
    'mdui/css/mdui.min.css',
    'font-awesome/css/all.min.css',
];
$load_head_js = [
    'vue.global.min.js',
    '_ttdf/jquery.min.js',
];
$load_foot_js = [
    'main.js',
    '_ttdf/ajax.js',
    '_ttdf/message.min.js',
    'mdui/js/mdui.min.js',
];