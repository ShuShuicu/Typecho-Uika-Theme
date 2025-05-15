<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Uika
{
    public static function GetPage($file)
    {
        Get::Template('Pages/' . $file);
    }

    public static function GetComponent($file)
    {
        Get::Template('Components/' . $file);
    }
}

require_once 'Uika/Ajax.php';
require_once 'Uika/Load.php';
require_once 'Uika/Functions.php';