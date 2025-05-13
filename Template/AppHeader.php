<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<!DOCTYPE html>
<html lang="<?php echo Get::Options('lang', false) ? Get::Options('lang', false) : 'zh-CN' ?>">

<head>
    <?php TTDF_Hook::do_action('load_head'); ?>
    <link href="<?php echo Get::Options('FaviconUrl', false) ? Get::Options('FaviconUrl', false) : Get::SiteUrl(false) . 'favicon.ico'; ?>" rel="icon" />
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-blue mdui-theme-layout-light" arco-theme="light">
    <div id="app">
        <header>
            <?php Uika::GetComponent('Appbar'); ?>
        </header>
        <main class="Uika-Container mdui-appbar-with-toolbar mdui-container-fluid">