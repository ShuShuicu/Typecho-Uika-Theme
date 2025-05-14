<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script src="<?php GetTheme::AssetsUrl() ?>/shuffle.min.js?ver=<?php GetTheme::Ver() ?>"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            window.shuffleInstance = new Shuffle(document.getElementById('Post'), {
                itemSelector: '.post-item',
                sizer: null,
                gutterWidth: 20,
                buffer: 1
            });

            function updateLayout() {
                const width = window.innerWidth;
                let itemWidth, columns;

                if (width < 768) {
                    itemWidth = '100%';
                    columns = 1;
                } else if (width < 1024) {
                    itemWidth = 'calc(50% - 20px)';
                    columns = 2;
                } else {
                    itemWidth = 'calc(33.333% - 20px)';
                    columns = 3;
                }

                document.querySelectorAll('.post-item').forEach(item => {
                    item.style.width = itemWidth;
                });

                window.shuffleInstance.options.columns = columns;
                window.shuffleInstance.layout();

                // console.log('布局已更新，当前列数:', columns);
            }

            const resizeObserver = new ResizeObserver(entries => {
                for (let entry of entries) {
                    if (entry.contentBoxSize) {
                        // console.log('容器尺寸变化，更新布局');
                        updateLayout();
                    }
                }
            });

            resizeObserver.observe(document.getElementById('Post'));

            window.addEventListener('resize', function() {
                clearTimeout(this.resizeTimer);
                this.resizeTimer = setTimeout(function() {
                    // console.log('窗口大小变化，更新布局');
                    updateLayout();
                }, 200);
            });

            updateLayout();
        });
    </script>
<?php
});
?>
<div id="IndexShuffle">
    <div class="post-grid" id="Post">
        <?php while (GetPost::List()) {
            $Fields = Get::Fields('Thumbnail_Url') ?? null;
            $thumbnailUrl = $Fields ?: get_ArticleThumbnail($this);
        ?>
            <div class="post-item" data-groups='["post"]'>
                <a href="<?php GetPost::Permalink(); ?>">
                    <div class="mdui-card post-card">
                        <div class="mdui-card-media">
                            <div class="thumbnail">
                                <img data-src="<?php echo htmlspecialchars($thumbnailUrl); ?>"
                                    src="<?php Get::Options('Uika_Post_Thumbnail', true) ?>"
                                    alt="<?php GetPost::Title(); ?>"
                                    class="lazy"
                                    loading="lazy">
                            </div>
                        </div>
                        <div class="mdui-card-content">
                            <div class="mdui-card-primary-title">
                                <?php GetPost::Title(); ?>
                            </div>
                            <div class="mdui-card-primary-subtitle">
                                <?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?>
                            </div>
                            <div class="mdui-card-actions mdui-card-primary-subtitle">
                                <a href="<?php GetPost::Permalink(); ?>">
                                    <?php GetPost::Excerpt(200); ?> ...
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <div style="text-align: center; padding: 20px 0;">
        <a-space>
            <?php Get::PageLink('<a-button status="warning">上一页</a-button>') ?>
            <?php Get::PageLink('<a-button status="success">下一页</a-button>', 'next') ?>
        </a-space>
    </div>
</div>