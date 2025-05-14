<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="IndexCard">
    <div class="post-grid mdui-row" id="Post">
        <?php while (GetPost::List()) {
            $Fields = Get::Fields('Thumbnail_Url') ?? null;
            $thumbnailUrl = $Fields ?: get_ArticleThumbnail($this);
        ?>
            <div class="post-item mdui-col-xl-4 mdui-col-lg-4 mdui-col-md-6 mdui-col-sm-12" data-groups='["post"]'>
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
                            <div class="mdui-card-primary-title mdui-text-truncate">
                                <?php GetPost::Title(); ?>
                            </div>
                            <div class="mdui-card-primary-subtitle mdui-text-truncate">
                                <?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?>
                            </div>
                            <div class="mdui-card-actions mdui-card-primary-subtitle mdui-text-truncate">
                                <a href="<?php GetPost::Permalink(); ?>">
                                    <?php GetPost::Excerpt(100); ?> ...
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>