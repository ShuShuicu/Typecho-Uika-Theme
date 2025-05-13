<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 确保 Router::$current 是一个空字符串而不是 null
if (!isset(Typecho\Router::$current)) {
    Typecho\Router::$current = '';
}
return;
