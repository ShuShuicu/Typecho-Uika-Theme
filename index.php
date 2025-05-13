<?php 
/**
 * 一款多功能的Typecho主题
 * @package Uika
 * @author 鼠子(Tomoriゞ)
 * @version 1.0.0
 * @link https://github.com/ShuShuicu/Typecho-Uika-Theme
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Get::Template('AppHeader');
Uika::GetPage('Index');
Get::Template('AppFooter');
