<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!DOCTYPE html>
<html lang="<?php echo Get::Options('lang', false) ? Get::Options('lang', false) : 'zh-CN' ?>">

<head>
    <?php
        TTDF_Hook::do_action('load_head');
    ?>
    <link href="<?php echo Get::Options('FaviconUrl', false) ? Get::Options('FaviconUrl', false) : Get::SiteUrl(false) . 'favicon.ico'; ?>" rel="icon" />
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-blue mdui-theme-layout-light" uika-theme="light">
    <div id="app">
        <header>
            <?php Uika::GetComponent('Appbar'); ?>
        </header>
        <main class="Uika-Container mdui-appbar-with-toolbar mdui-container-fluid">
            <?php
            if (Get::Options('Uika_Alert_Switch') === 'true') {
                Uika::GetComponent('Alert');
            }
            if (Get::Options('Uika_Carousel_Switch') === 'true') {
                // 获取轮播图启用页面
                $carouselPages = Get::Options('Uika_Carousel_Page');
                // 判断当前页面是否启用轮播图
                if (
                    (in_array('index', $carouselPages) && Get::Is('index')) ||
                    (in_array('post', $carouselPages) && Get::Is('post')) ||
                    (in_array('page', $carouselPages) && Get::Is('page')) ||
                    (in_array('archive', $carouselPages) && Get::Is('archive'))
                ) {
                    Uika::GetComponent('Carousel'); // 启用轮播图
                }
            }
            ?>