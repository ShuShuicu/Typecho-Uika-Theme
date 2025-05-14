<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // 自定义加载函数，确保错误时强制回退 SVG
                const loadWithFallback = function(el) {
                    // 保存原始 SVG 占位图
                    if (!el.dataset.originalSrc) {
                        el.dataset.originalSrc = '<?php Get::Options('Uika_Post_Thumbnail_Error', true) ?>';
                    }

                    // 创建新 Image 对象进行预加载
                    const img = new Image();
                    img.src = el.dataset.src;

                    // 尝试绕过 CORS 和防盗链
                    img.crossOrigin = "anonymous";
                    img.referrerPolicy = "no-referrer";

                    // 图片加载成功
                    img.onload = function() {
                        el.classList.add('lazy-transition');
                        el.src = img.src;
                        setTimeout(() => {
                            el.classList.add('lazy-loaded');
                            el.classList.remove('lazy-transition');
                            // console.log('图片加载成功:', el.dataset.src);
                        }, 50);
                    };

                    // 图片加载失败强制回退 SVG
                    img.onerror = function() {
                        // console.warn('图片加载失败，回退 SVG:', el.dataset.src);
                        el.src = el.dataset.originalSrc;
                        el.classList.add('lazy-loaded');
                        el.removeAttribute('data-src'); // 防止 Lozad 再次尝试
                    };
                };

                // 初始化 Lozad
                const observer = lozad('.lazy', {
                    rootMargin: '200px 0px',
                    loaded: loadWithFallback, // 使用自定义加载函数
                    threshold: 0.1
                });

                observer.observe();

                //  延迟检查未加载的图片
                setTimeout(function() {
                    document.querySelectorAll('.lazy:not(.lazy-loaded)').forEach(el => {
                        const rect = el.getBoundingClientRect();
                        if (rect.top < window.innerHeight * 1.5) {
                            observer.triggerLoad(el);
                        }
                    });
                }, 500);
            }, 100);
        });
    </script>
<?php
});
Uika::GetComponent(Get::Options('Uika_Index_Type') ?: 'IndexCard');
?>
<div style="text-align: center; padding: 20px 0;">
    <a-space>
        <?php Get::PageLink('<a-button status="warning">上一页</a-button>') ?>
        <?php Get::PageLink('<a-button status="success">下一页</a-button>', 'next') ?>
    </a-space>
</div>