<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function profile($data) {
    $user = Typecho_Widget::widget('Widget_User');
    TyAjax_send_success('欢迎您！' . $user->name);
}
TyAjax_action('ty_ajax_profile', 'profile');
TyAjax_action('ty_ajax_nopriv_profile', 'profile');

TyAjax_Core::init();