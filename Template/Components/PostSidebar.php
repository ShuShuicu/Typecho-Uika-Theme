<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="mdui-card">
    <div class="mdui-card-header">
        <img class="mdui-card-header-avatar" src="<?php UserInfo::AvatarURL(220, true); ?>" />
        <div class="mdui-card-header-title"><?php echo UserInfo::Name(true, true); ?></div>
        <div class="mdui-card-header-subtitle">Subtitle</div>
    </div>
</div>
