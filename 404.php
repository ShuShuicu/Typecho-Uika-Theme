<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_head', function () {
    echo <<<HTML
    <style>
        #Carousel {
            display: none;
        }
    </style>
HTML;
});
class useSeo
{
    public static function Title() {
        echo '出错啦';
    }
    public static function Description() {
        echo '您访问的页面不存在';
    }
    public static function Keywords() {
        echo '404, error, 错误';
    }
}
Get::Template('AppHeader');
?>
<div class="error" style="text-align: center;">
    <div>
        <img src="<?php GetTheme::AssetsUrl(); ?>/images/404.svg" alt="404 error" />
    </div>
    <div>
        <a href="<?php Site::Url() ?>">
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" style="margin-top: 20px;">返回首页</button>
        </a>
    </div>
</div>
<?php
Get::Template('AppFooter');
?>