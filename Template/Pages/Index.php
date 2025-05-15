<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Uika::GetComponent(Get::Options('Uika_Index_Type') ?: 'IndexCard');
Uika::GetComponent('IndexPageLink');
