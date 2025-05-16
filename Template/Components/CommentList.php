<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
?>

    <div class="mdui-m-y-2" style="margin-left: -20px;">
        <div
            id="li-<?php $comments->theId(); ?>"
            class="<?php
                    if ($comments->levels > 0) {
                        echo 'comment-child mdui-panel-item';
                        $comments->levelsAlt('comment-level-odd', 'comment-level-even');
                    } else {
                        echo 'comment-parent';
                    }
                    $comments->alt('comment-odd', 'comment-even');
                    echo $commentClass;
                    ?>">
            <div id="<?php $comments->theId(); ?>" class="Uika-Comments-List">

                    <div class="mdui-card-header">
                        <div class="mdui-card-header-avatar">
                            <?php $comments->gravatar('40', 'avatar'); ?>
                        </div>
                        <div class="mdui-card-header-title">
                            <?php $comments->author(); ?>
                        </div>
                        <div class="mdui-card-header-subtitle">
                            <?php $comments->date('Y-m-d H:i'); ?>
                        </div>
                    </div>
                    <div style="padding: 0 16px;">
                    <?php $parentMail = get_comment_at($comments->coid) ?><?php echo $parentMail; ?>
                    <?php $comments->content(); ?>
                    </div>
                    <div class="mdui-card-actions">
                        <span style="margin-left: -8px;">
                            <?php $comments->reply('<button type="button" class="mdui-float-right mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">call_missed</i></button>'); ?>
                        </span>
                        <?php if ($comments->status == 'waiting'): ?>
                            <span class="mdui-text-color-theme-text">评论审核中</span>
                        <?php endif; ?>
                    </div>
                </div>

            <?php if ($comments->children) { ?>
                <div class="comment-children">
                    <?php $comments->threadedComments($options); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
}
