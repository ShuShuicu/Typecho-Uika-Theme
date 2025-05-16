<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        $(document).ready(function() {
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
});

Uika::GetComponent(Get::Options('Uika_Index_Type') ?: 'IndexCard');
Uika::GetComponent('IndexPageLink');
