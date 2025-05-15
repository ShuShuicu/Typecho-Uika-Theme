<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$TTDF_Error_Page_Title = '404 Not Found';
$TTDF_Error_Page_Description = '404 Not Found';
$TTDF_Error_Page_Keywords = '404, Not Found';
?>
<!DOCTYPE html>
<html lang="<?php echo Get::Options('lang', false) ? Get::Options('lang', false) : 'zh-CN' ?>">

<head>
    <meta charset="<?php Get::Options('charset', true) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <title><?php echo $TTDF_Error_Page_Title; ?></title>
    <meta name="keywords" content="<?php echo $TTDF_Error_Page_Description; ?>" />
    <meta name="description" content="<?php echo $TTDF_Error_Page_Keywords; ?>" />
<?php TTDF_Hook::do_action('load_head', true); ?>
    <link href="<?php echo Get::Options('FaviconUrl', false) ? Get::Options('FaviconUrl', false) : Get::SiteUrl(false) . 'favicon.ico'; ?>" rel="icon" />
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-blue mdui-theme-layout-light" arco-theme="light">
    <div id="app">
        <header>
            <?php Uika::GetComponent('Appbar'); ?>
        </header>
        <main class="Uika-Container mdui-appbar-with-toolbar mdui-container-fluid">
            <?php
            if (Get::Options('Uika_Alert_Switch') === 'true') {
                Uika::GetComponent('Alert');
            }
            ?>