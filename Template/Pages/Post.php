<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        (function() {
            var pres = document.querySelectorAll('pre');
            var lineNumberClassName = 'line-numbers';
            pres.forEach(function(item, index) {
                item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
            });
        })();
        window.ViewImage && ViewImage.init('#PostContent img');
    </script>
<?php
});
?>
<div class="mdui-row" id="Post">
    <div class="mdui-col-xs-12 mdui-col-md-9">

        <div class="mdui-card">
            <div class="mdui-card-content">
                <div class="mdui-card-primary-title">
                    <?php GetPost::Title(); ?>
                </div>
                <div class="mdui-card-primary-subtitle">
                    <?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?>
                </div>
                <div class="mdui-card-content">
                    <div class="mdui-typo" id="PostContent">
                        <?php GetPost::Content() ?>
                    </div>
                    <div class="separator">THE END</div>
                    <div class="content-ds">
                        <span>© 转载请保留原链接</span>
                        <div class="content-ds-button">
                            <?php Uika::GetComponent('BilibiliPay') ?>
                        </div>
                        <div class="content-ds-count"><span>还没有人充电，快来当第一个充电的人吧！</span></div>
                    </div>
                </div>
            </div>
        </div>
        <?php Uika::GetComponent('Comments') ?>
    </div>
    <div class="mdui-col-xs-12 mdui-col-md-3 sidebar">
        <?php Uika::GetComponent('PostSidebar') ?>
    </div>
</div>