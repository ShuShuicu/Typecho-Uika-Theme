<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 定义所有设置项
$config = [
    '基础设置' => [
        'title' => '基础设置',
        'fields' => [
            [
                'type' => 'Text',
                'name' => 'FaviconUrl',
                'value' => null,
                'label' => '图标',
                'description' => '设置网站图标，如果为空则使用' . Get::SiteUrl(false) . 'favicon.ico'
            ],
            [
                'type' => 'Text',
                'name' => 'SubTitle',
                'value' => '由Uika主题强力驱动',
                'label' => '副标题',
                'description' => '设置网站副标题，如果为空则不显示。'
            ],
        ]
    ],
    '首页设置' => [
        'title' => '首页设置',
        'fields' => [
            [
                'type' => 'Textarea',
                'name' => 'Footer_Copyright',
                'value' => '<p>&copy; ' . date('Y') . ' ' . Get::SiteName(false) . ' 保留所有权利.</p>',
                'label' => '版权设置',
                'description' => '设置网站页脚版权声明。'
            ],
            [
                'type' => 'Textarea',
                'name' => 'Footer_About',
                'value' => '<h3>关于我们</h3>
                <p>' . Get::SiteDescription(false) . '</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>',
                'label' => '关于我们',
                'description' => '设置网站页脚关于我们。'
            ],
            [
                'type' => 'Textarea',
                'name' => 'Footer_Links',
                'value' => '<h3>快速链接</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-home"></i> 首页</a></li>
                    <li><a href="#"><i class="fas fa-handshake"></i> 服务</a></li>
                    <li><a href="#"><i class="fas fa-info-circle"></i> 关于我们</a></li>
                </ul>',
                'label' => '快速链接',
                'description' => '设置网站页脚快速链接。'
            ],
            [
                'type' => 'Textarea',
                'name' => 'Footer_Contact',
                'value' => '<h3>联系我们</h3>
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <span>info@example.com</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-phone-alt"></i>
                    <span>123-456-7890</span>
                </div>
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>中国北京市朝阳区</span>
                </div>',
                'label' => '联系我们',
                'description' => '设置网站页脚联系我们。'
            ],
        ]
    ],
    'TTDF-Options' => [
        'title' => '其他设置',
        'fields' => [
            [
                'type' => 'Select',
                'name' => 'TTDF_RESTAPI_Switch',
                'value' => 'false',
                'label' => 'REST API',
                'description' => 'TTDF框架内置的 REST API<br/>使用教程可参见 <a href="https://github.com/Typecho-Framework/Typecho-Theme-Development-Framework#rest-api" target="_blank">*这里*</a>',
                'options' => [
                    'true' => '开启',
                    'false' => '关闭'
                ]
            ],
        ]
    ],
];

return $config;
