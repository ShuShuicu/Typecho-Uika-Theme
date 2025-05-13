<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 需要登录的action示例
function IndexPostList($data)
{

}
TyAjax_action('ty_ajax_nopriv_profile', 'IndexPostList');

TyAjax_Core::init();