<?php

/**
 * Fields Functions
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 定义字段配置
$fields = [
    [
        [
            // Text
            'type' => 'Text',
            'name' => 'Thumbnail_Url',
            'value' => null, // 默认值为 null
            'label' => '文章缩略图',
            'description' => '自定义文章缩略图，如果留空则使用文章第一张图片作为缩略图或随机',
            'attributes' => [
                'style' => 'width: 100%;',
            ],
        ],
    ],
];

return  $fields;
