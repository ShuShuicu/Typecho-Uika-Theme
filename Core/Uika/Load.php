<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

TTDF_Hook::add_action('load_head', function () {
    $assetsUrl = GetTheme::Url(false) . '/Assets';
    $ver = GetTheme::Ver(false);
    $PrismCss = Get::Options('Uika_Post_Prism_Css', false) ?: 'Okaidia.css';
    $styles = [
        'main.css',
        'message.css',
        'prism/css/' . $PrismCss,
        'mdui/css/mdui.min.css',
        'arco/arco.min.css',
        'nprogress/nprogress.css',
        'font-awesome/css/all.min.css',
    ];
    $scripts = [
        'init.js',
        'vue.global.min.js',
        'jquery.min.js',
    ];

    $output = '';

    foreach ($styles as $style) {
        $output .= "    <link rel=\"stylesheet\" href=\"{$assetsUrl}/{$style}?ver={$ver}\">\n";
    }
    foreach ($scripts as $script) {
        $output .= "    <script src=\"{$assetsUrl}/{$script}?ver={$ver}\"></script>\n";
    }

    echo $output;
});

TTDF_Hook::add_action('load_foot', function () {
    $assetsUrl = GetTheme::Url(false) . '/Assets';
    $ver = GetTheme::Ver(false);
    $scripts = [
        'main.js',
        'dom.js',
        'lozad.min.js',
        'message.js',
        'prism/prism.js',
        'mdui/js/mdui.min.js',
        'arco/arco-vue.min.js',
        'nprogress/nprogress.js',
    ];

    $output = '';

    foreach ($scripts as $index => $script) {
        $output .= "    <script src=\"{$assetsUrl}/{$script}?ver={$ver}\"></script>";
        if ($index < count($scripts) - 1) {
            $output .= "\n";
        }
    }

    echo $output;
});
