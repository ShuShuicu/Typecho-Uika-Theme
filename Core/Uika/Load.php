<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

TTDF_Hook::add_action('load_head', function () {
    $assetsUrl = GetTheme::Url(false) . '/Assets';
    $ver = GetTheme::Ver(false);
    $styles = [
        'main.css',
        'message.css',
        'mdui/css/mdui.min.css',
        'arco/arco.min.css',
        'nprogress/nprogress.css',
        'font-awesome/css/all.min.css',
        'prismjs/themes/prism-tomorrow.min.css',
        'prismjs/plugins/toolbar/prism-toolbar.min.css',
        'prismjs/plugins/line-numbers/prism-line-numbers.min.css',
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
        'masonry.pkgd.min.js',
        'mdui/js/mdui.min.js',
        'arco/arco-vue.min.js',
        'nprogress/nprogress.js',
        'prismjs/prism.js',
        'prismjs/plugins/line-numbers/prism-line-numbers.min.js',
        'prismjs/plugins/toolbar/prism-toolbar.min.js',
        'prismjs/plugins/autoloader/prism-autoloader.min.js',
        'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js',
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
