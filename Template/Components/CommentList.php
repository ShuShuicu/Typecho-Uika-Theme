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
    <div class="arco-comment-wrapper" style="margin-left: -20px;">
        <a-comment
            id="li-<?php $comments->theId(); ?>"
            class="<?php
                    if ($comments->levels > 0) {
                        echo 'comment-child arco-comment-nested';
                        $comments->levelsAlt('comment-level-odd', 'comment-level-even');
                    } else {
                        echo 'comment-parent';
                    }
                    $comments->alt('comment-odd', 'comment-even');
                    echo $commentClass;
                    ?>">
            <div id="<?php $comments->theId(); ?>" class="arco-comment-inner">

                <a-comment>
                    <template #author>
                        <?php $comments->author(); ?>
                    </template>
                    <template #content>
                        <?php $comments->content(); ?>
                    </template>
                    <template #datetime>
                        <?php $comments->date('Y-m-d H:i'); ?>
                    </template>
                    <template #avatar>
                        <a-avatar>
                            <?php $comments->gravatar('40', 'avatar'); ?>
                        </a-avatar>
                    </template>
                    <template #actions>
                        <span style="margin-left: -8px;">
                            <?php $parentMail = get_comment_at($comments->coid) ?><?php echo $parentMail; ?>
                            <?php $comments->reply('<button type="button" class="arco-btn arco-btn-text arco-comment-action-reply">回复</button>'); ?>
                        </span>
                        <?php if ($comments->status == 'waiting'): ?>
                            <span class="arco-comment-waiting">评论审核中</span>
                        <?php endif; ?>
                    </template>
                </a-comment>
            </div>

            <?php if ($comments->children) { ?>
                <div class="comment-children">
                    <?php $comments->threadedComments($options); ?>
                </div>
            <?php } ?>
        </a-comment>
    </div>
<?php
}
