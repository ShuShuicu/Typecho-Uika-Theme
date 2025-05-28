<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$load_dir_name = 'Assets'; // 资源文件目录名称
$load_head_css = [
    'main.css',
    'message.css',
    'prism/' . Get::Options('Uika_Post_Prism_Css', false) ?: 'Okaidia.css',
    'mdui/css/mdui.min.css',
    'arco/arco.min.css',
    'viewer/viewer.min.css',
    'font-awesome/css/all.min.css',
];
$load_head_js = [
    'vue.global.min.js',
    'jquery.min.js',
];
$load_foot_js = [
    'main.js',
    'ajax.js',
    'message.min.js',
    'mdui/js/mdui.min.js',
    'arco/arco-vue.min.js',
    'viewer/viewer.min.js',
];

// 初始化可能未定义的变量
$load_dir_name = $load_dir_name ?? null;
$load_head_css = $load_head_css ?? [];
$load_head_js = $load_head_js ?? [];
$load_foot_js = $load_foot_js ?? [];

// 获取资源URL和版本号的公共函数
$getAssetsUrl = function ($dirName = null) {
    return GetTheme::Url(false) . '/' . ($dirName ?? 'Assets');
};
$ver = GetTheme::Ver(false);

// 加载头部CSS和JS资源
TTDF_Hook::add_action('load_head', function ($skipHead = false) use ($load_head_css, $load_head_js, $load_dir_name, $getAssetsUrl, $ver) {
    $assetsUrl = $getAssetsUrl($load_dir_name);
    $output = '';
    // 生成CSS链接
    foreach ($load_head_css as $style) {
        $output .= "    <link rel=\"stylesheet\" href=\"{$assetsUrl}/{$style}?ver={$ver}\">\n";
    }
    // 生成JS链接
    foreach ($load_head_js as $script) {
        $output .= "    <script src=\"{$assetsUrl}/{$script}?ver={$ver}\"></script>\n";
    }
    echo $output;
});

// 加载底部JS资源
TTDF_Hook::add_action('load_foot', function () use ($load_foot_js, $load_dir_name, $getAssetsUrl, $ver) {
    $assetsUrl = $getAssetsUrl($load_dir_name);
    $output = '';
    foreach ($load_foot_js as $index => $script) {
        $output .= ($index !== 0 ? "    " : "") . "<script src=\"{$assetsUrl}/{$script}?ver={$ver}\"></script>\n";
    }
    echo $output;
});


TTDF_Hook::add_action('load_foot', function () {
?>
    <?php if (is_page('index') || is_page('front') || is_page('archive')) { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                // 创建Vue实例
                const App = {};
                const app = Vue.createApp(App);
                app.use(ArcoVue);
                app.mount("#app");
                mdui.mutation();
                // 定义懒加载函数
                function lazyLoadImages() {
                    $('.lazy').each(function() {
                        const $img = $(this);
                        if ($img.hasClass('lazy-loaded')) {
                            return; // 如果图片已经加载，跳过
                        }

                        const rect = $img[0].getBoundingClientRect();
                        if (rect.top < window.innerHeight * 1.5 && rect.bottom > 0) {
                            const img = new Image();
                            const src = $img.data('src');

                            // 如果data-src不存在，直接使用默认SVG
                            if (!src) {
                                $img.attr('src', '<?php Get::Options('Uika_Post_Thumbnail_Error', true) ?>');
                                $img.addClass('lazy-loaded');
                                return;
                            }

                            img.src = src;

                            // 图片加载成功
                            img.onload = function() {
                                // 确保当前图片还没有被处理过
                                if (!$img.hasClass('lazy-loaded')) {
                                    $img.addClass('lazy-transition');
                                    $img.attr('src', img.src);
                                    setTimeout(() => {
                                        $img.addClass('lazy-loaded');
                                        $img.removeClass('lazy-transition');
                                    }, 50);
                                }
                            };

                            // 图片加载失败
                            img.onerror = function() {
                                // 确保当前图片还没有被处理过
                                if (!$img.hasClass('lazy-loaded')) {
                                    // 回退到默认的 SVG 图片
                                    $img.attr('src', '<?php Get::Options('Uika_Post_Thumbnail_Error', true) ?>');
                                    $img.addClass('lazy-loaded');

                                    // 延迟一段时间后重试加载
                                    setTimeout(() => {
                                        // 检查是否仍然是错误状态
                                        if ($img.attr('src') === '<?php Get::Options('Uika_Post_Thumbnail_Error', true) ?>') {
                                            $img.removeClass('lazy-loaded');
                                            $img.removeAttr('src'); // 移除 src 属性，以便重新触发加载
                                            lazyLoadImages(); // 重新尝试加载
                                        }
                                    }, 5000); // 5 秒后重试
                                }
                            };
                        }
                    });
                }

                // 初始化加载
                lazyLoadImages();

                // 使用防抖优化滚动和resize事件
                let lazyLoadTimer;

                function debounceLazyLoad() {
                    clearTimeout(lazyLoadTimer);
                    lazyLoadTimer = setTimeout(lazyLoadImages, 100);
                }

                // 监听滚动事件
                $(window).on('scroll', debounceLazyLoad);

                // 监听窗口大小变化
                $(window).on('resize', debounceLazyLoad);
            });
        </script>
<?php
    }
});
