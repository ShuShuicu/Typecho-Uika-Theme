<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Uika::GetComponent(Get::Options('Uika_Index_Type') ?: 'IndexCard');
?>
<div style="text-align: center; padding: 20px 0;">
    <a-space>
        <?php Get::PageLink('<a-button status="warning">上一页</a-button>') ?>
        <?php Get::PageLink('<a-button status="success">下一页</a-button>', 'next') ?>
    </a-space>
</div>