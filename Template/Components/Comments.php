<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Uika::GetComponent('CommentList');
?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <div class="mdui-card mdui-m-t-2">
        <div class="mdui-card-content">
            <div class="mdui-card-primary-title mdui-text-truncate">
                <i class="mdui-icon material-icons">comment</i>
                共有 <?php Comment::CommentsNum(); ?> 条评论
            </div>
            <div class="mdui-divider"></div>
            <?php if ($this->allow('comment')) { ?>
                <div id="<?php $this->respondId(); ?>" class="respond">
                    <div class="cancel-comment-reply">
                        <?php $comments->cancelReply(); ?>
                    </div>
                        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" novalidate>
                            <?php if ($this->user->hasLogin()) { ?>
                                登录身份：<?php echo $this->user->screenName; ?>
                            <?php } else { ?>
                                <div class="mdui-textfield">
                                    <input class="mdui-textfield-input" type="text" placeholder="昵称" name="author" value="<?php $this->remember('author'); ?>" maxlength="10"/>
                                </div>
                                <div class="mdui-textfield" style="margin: 5px 0px;">
                                    <input class="mdui-textfield-input" type="email" placeholder="邮箱" name="mail" value="<?php $this->remember('mail'); ?>" maxlength="15"/>
                                </div>
                                <div class="mdui-textfield">
                                    <input class="mdui-textfield-input" type="url" placeholder="网站" name="url" value="<?php $this->remember('url'); ?>" maxlength="30"/>
                                </div>
                            <?php }; ?>
                            <div class="mdui-divider"></div>
                            <div class="mdui-textfield">
                                <textarea class="mdui-textfield-input" placeholder="下面我简单喵两句/ᐠ｡ꞈ｡ᐟ\" rows="4" name="text"><?php $this->remember('text'); ?></textarea>
                            </div>
                            <div class="mdui-float-right">
                                <button type="submit" class="mdui-btn mdui-btn-raised mdui-m-b-2 mdui-ripple mdui-color-theme"><?php _e('提交评论'); ?></button>
                            </div>
                        </form>
                <?php } else { ?>
                    <h3><?php _e('评论已关闭'); ?></h3>
                <?php }; ?>
                </div>
                <?php if ($comments->have()) { ?>
                    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
                        <?php $comments->listComments(); ?>
                <?php }; ?>
        </div>
    </div>
</div>