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
    <div class="mdui-col-xs-12 mdui-col-md-8">

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
                        <?php GetPost::DB_Content_Html() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php Uika::GetComponent('Comments') ?>
    </div>
    <div class="mdui-col-xs-12 mdui-col-md-4">
        <?php Uika::GetComponent('PostSidebar') ?>
    </div>
</div>