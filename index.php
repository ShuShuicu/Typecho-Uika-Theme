<?php 
/**
 * 一款不错的Typecho主题
 * @package Uika
 * @author 鼠子(Tomoriゞ)
 * @version 1.0.0_Beta1
 * @link https://github.com/ShuShuicu/Typecho-Uika-Theme
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (Get::Options('Uika_SEO_Switch') === 'true') {
    Uika::GetComponent('IndexCustomSeo');
}
Get::Template('AppHeader');
Uika::GetPage('Index');
Get::Template('AppFooter');
