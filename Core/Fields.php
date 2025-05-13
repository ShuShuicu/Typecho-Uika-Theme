<?php
/**
 * Fields Functions
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeFields($layout)
{
    // 定义字段配置
    $fieldElements = [
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
    ];

    // 循环添加字段
    foreach ($fieldElements as $field) {
        $element = TTDF_FormElement(
            $field['type'],
            $field['name'],
            $field['value'] ?? null,
            $field['label'] ?? '',
            $field['description'] ?? '',
            $field['options'] ?? []
        );

        // 设置字段属性（如 style）
        if (isset($field['attributes'])) {
            foreach ($field['attributes'] as $attr => $value) {
                $element->input->setAttribute($attr, $value);
            }
        }

        $layout->addItem($element);
    }
}