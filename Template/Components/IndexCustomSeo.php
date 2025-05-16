<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class useSeo
{
    public static function Title() {
        Get::Options('Uika_Index_Title', true) ?: Site::Name(true);
    }
    public static function Description() {
        Get::Options('Uika_Index_Description', true) ?: Site::Description(true);
    }
    public static function Keywords() {
        Get::Options('Uika_Index_Keywords', true) ?: Site::Keywords(true);
    }
}