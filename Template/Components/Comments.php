<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">

    </script>
<?php
});
?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <div class="mdui-card mdui-m-t-2">
        <div class="mdui-card-content">
            <div class="mdui-card-primary-title mdui-text-truncate">
                <i class="mdui-icon material-icons">comment</i>
                共有 <?php GetComments::CommentsNum(); ?> 条评论
            </div>
            <div class="mdui-divider"></div>
            <?php if ($this->allow('comment')) { ?>
                <div id="<?php $this->respondId(); ?>" class="respond">
                    <div class="cancel-comment-reply">
                        <?php $comments->cancelReply(); ?>
                    </div>
                    <div style="padding: 16px;">
                        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form" novalidate>
                            <?php if ($this->user->hasLogin()) { ?>
                                登录身份：<?php echo $this->user->screenName; ?>
                            <?php } else { ?>
                                <div style="margin-bottom: 5px;">
                                    <a-input placeholder="昵称" name="author" value="<?php $this->remember('author'); ?>" :max-length="10" allow-clear show-word-limit />
                                </div>
                                <div>
                                    <a-input placeholder="邮箱" name="mail" value="<?php $this->remember('mail'); ?>" :max-length="35" allow-clear show-word-limit />
                                </div>
                            <?php }; ?>
                            <div class="mdui-divider"></div>
                            <div class="mdui-textfield">
                                <a-textarea placeholder="下面我简单喵两句/ᐠ｡ꞈ｡ᐟ\" value="<?php $this->remember('text'); ?>" allow-clear rows="4" name="text" />
                            </div>
                            <div class="mdui-float-right">
                                <a-button type="primary" html-type="submit" class="submit"><?php _e('提交评论'); ?></a-button>
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <h3><?php _e('评论已关闭'); ?></h3>
                <?php }; ?>
                </div>
                <?php if ($comments->have()) { ?>
                    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
                    <div class="mdui-m-t-4">
                        <?php $comments->listComments(); ?>
                    </div>
                <?php }; ?>
        </div>
    </div>
</div>