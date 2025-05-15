<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        const IndexPageLink = Vue.createApp({
            data() {
                return {
                    CurrentPage: '<?php echo Get::CurrentPage() > 1 ? Get::CurrentPage() : 1; ?>',
                    PageSize: '<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>',
                };
            },
            template: `
                <div class="mdui-valign mdui-card mdui-card-content">
                    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon"><i class="material-icons mdui-icon">chevron_left</i></div>'); ?>
                    <span class="mdui-typo-body-1-opacity mdui-text-center" style="flex-grow:1">第 {{ CurrentPage }} 页 / 共 {{ PageSize }} 页</span>
                    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon"><i class="material-icons mdui-icon">chevron_right</i></div>', 'next'); ?>
                </div>
            `
        });
        IndexPageLink.mount('#IndexPageLink');
    </script>
<?php
});
?>
<div id="IndexPageLink"></div>