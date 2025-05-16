<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        $(document).ready(function() {
            // 初始化Flickity轮播
            var $carousel = $('.carousel').flickity({
                // 选项配置
                cellAlign: 'left',
                contain: true,
                wrapAround: true,
                autoPlay: 3000, // 3秒自动播放
                pageDots: true, // 显示分页点
                prevNextButtons: true, // 显示上一页/下一页按钮
                draggable: true, // 允许拖动
                freeScroll: false,
                // 响应式配置
                responsive: [{
                        breakpoint: 768, // 手机端
                        settings: {
                            prevNextButtons: false, // 手机端隐藏按钮
                            pageDots: true
                        }
                    },
                    {
                        breakpoint: 1024, // 平板端
                        settings: {
                            prevNextButtons: true
                        }
                    }
                ]
            });

            // 窗口大小改变时重新布局
            $(window).on('resize', function() {
                $carousel.flickity('resize');
            });
        });
    </script>
<?php
});
?>
?>
<div class="carousel">
    <?php
    $Uika_Carousel_Content = Get::Options('Uika_Carousel_Content');
    $CarouselItems = explode("\n", $Uika_Carousel_Content);

    foreach ($CarouselItems as $item) {
        $parts = explode('|', trim($item));
        if (count($parts) == 2) {
            list($link, $image) = $parts;
    ?>
            <div class="carousel-cell">
                <a href="<?php echo $link; ?>" target="_blank">
                    <img src="<?php echo $image; ?>" />
                </a>
            </div>
    <?php
        }
    }
    ?>
</div>