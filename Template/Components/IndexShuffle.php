<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        // 初始化 Shuffle
        initShuffle();

        function initShuffle() {
            const shuffleContainer = document.getElementById('Post');
            if (!shuffleContainer) return;

            window.shuffleInstance = new Shuffle(shuffleContainer, {
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

                if (window.shuffleInstance) {
                    window.shuffleInstance.options.columns = columns;
                    window.shuffleInstance.layout();
                }
            }

            const resizeObserver = new ResizeObserver(entries => {
                for (let entry of entries) {
                    if (entry.contentBoxSize) {
                        updateLayout();
                    }
                }
            });

            resizeObserver.observe(shuffleContainer);

            window.addEventListener('resize', function() {
                clearTimeout(this.resizeTimer);
                this.resizeTimer = setTimeout(function() {
                    updateLayout();
                }, 200);
            });

            updateLayout();
        }
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
</div>