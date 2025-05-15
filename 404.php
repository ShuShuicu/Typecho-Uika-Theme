<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Get::Template('AppHeaderError');
?>
<div class="error">
    <div style="text-align: center;">
        <img src="<?php GetTheme::AssetsUrl(); ?>/images/404.svg" alt="404 error" />
    </div>
    <a-result subtitle="你似乎来到了没有知识存在的荒原">
        <template #extra>
            <a-space>
                <a-button type="primary" href="<?php Get::SiteUrl() ?>">去往首页</a-button>
            </a-space>
        </template>
    </a-result>
</div>
<?php
Get::Template('AppFooter');
?>