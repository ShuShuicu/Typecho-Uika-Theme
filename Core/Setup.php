<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 定义主题设置项
return [
    '基础设置' => [
        'title' => '基础设置',
        'fields' => [
            [
                // 网站图标
                'type' => 'Text',
                'name' => 'FaviconUrl',
                'value' => get_theme_file_url('Assets/images/logo.png', false),
                'label' => '站点图标',
                'description' => '设置网站图标，如果为空则使用' . Get::SiteUrl(false) . 'favicon.ico'
            ],
            [
                // 网站副标题
                'type' => 'Text',
                'name' => 'SubTitle',
                'value' => '由 Uika 主题强力驱动',
                'label' => '站点副标题',
                'description' => '设置网站副标题，如果为空则不显示。<hr>'
            ],
            [
                // 提示开关
                'type' => 'Select',
                'name' => 'Uika_Alert_Switch',
                'value' => 'true',
                'label' => '公告提示',
                'description' => '是否启用公告提示',
                'options' => [
                    'true' => '启用',
                    'false' => '关闭',
                ]
            ],
            [
                // 公告提示内容
                'type' => 'Text',
                'name' => 'Uika_Alert_Content',
                'value' => 'Uika是一款不错的Typecho主题! 喜欢的话请点个Star, 谢谢!',
                'label' => '公告内容',
                'description' => '公告提示内容。',
            ],
            [
                // 公告提示模式
                'type' => 'Radio',
                'name' => 'Uika_Alert_Mode',
                'value' => 'info',
                'label' => '公告提示模式',
                'description' => '选择公告提示模式',
                'options' => [
                    'info' => '蓝色信息',
                    'warning' => '黄色警告',
                    'success' => '绿色成功',
                    'error' => '红色错误',
                ]
            ],
        ]
    ],
    'SEO设置' => [
        'title' => 'SEO设置',
        'fields' => [
            [
                'type' => 'Html',
                'content' => '<div style="text-align: center;font-size: 24px;">
                    此设置仅为自定义首页SEO信息
                </div>'
            ],
            [
                // SEO开关
                'type' => 'Select',
                'name' => 'Uika_SEO_Switch',
                'value' => 'false',
                'label' => '开关',
                'description' => '是否启用首页自定义SEO信息',
                'options' => [
                    'true' => '启用',
                    'false' => '关闭',
                ]
            ],
            [
                // 首页标题
                'type' => 'Text',
                'name' => 'Uika_Index_Title',
                'value' => '这是一个自定义的首页标题',
                'label' => '首页标题',
                'description' => '设置网站首页标题，如果为空则使用网站名称。'
            ],
            [
                // 首页关键词
                'type' => 'Text',
                'name' => 'Uika_Index_Keywords',
                'value' => 'TTDF, Typecho, Uika',
                'label' => '首页关键词',
                'description' => '设置网站首页关键词，如果为空则使用默认关键词。'
            ],
            [
                // 首页描述
                'type' => 'Textarea',
                'name' => 'Uika_Index_Description',
                'value' => 'Uika是一个不错的Typecho主题',
                'label' => '首页网站描述',
                'description' => '设置网站首页描述，如果为空则使用默认描述。'
            ],
        ]
    ],
    '首页设置' => [
        'title' => '首页设置',
        'fields' => [
            [
                // 首页风格
                'type' => 'Radio',
                'name' => 'Uika_Index_Type',
                'value' => 'IndexCard',
                'label' => '首页风格',
                'description' => '请选择首页风格',
                'options' => [
                    'IndexCard' => '卡片',
                    'IndexShuffle' => '瀑布流',
                ]
            ],
            [
                // 首页卡片风格
                'type' => 'Radio',
                'name' => 'Uika_Index_Card_Style',
                'value' => 'small',
                'label' => '卡片显示',
                'description' => '请选择首页卡片显示风格<a style="color: red"> 注: 瀑布流不生效</a><hr>',
                'options' => [
                    'small' => '小卡片',
                    'big' => '大卡片',
                ]
            ],
            [
                // 轮播图开关
                'type' => 'Select',
                'name' => 'Uika_Carousel_Switch',
                'value' => 'true',
                'label' => '轮播图',
                'description' => '是否启用轮播图',
                'options' => [
                    'true' => '启用',
                    'false' => '关闭',
                ]
            ],
            [
                // 轮播图启用页面
                'type' => 'Checkbox',
                'name' => 'Uika_Carousel_Page',
                'value' => ['index', 'page', 'archive'],
                'label' => '应用页面',
                'description' => '请选择轮播图应用的页面',
                'options' => [
                    'index' => '首页',
                    'post' => '文章页',
                    'page' => '独立页',
                    'search' => '搜索页',
                    'archive' => '分类标签归档页',
                ]
            ],
            [
                // 轮播图片
                'type' => 'Textarea',
                'name' => 'Uika_Carousel_Content',
                'value' =>
                'https://github.com/ShuShuicu|https://bing.img.run/1920x1080.php' . "\n" .
                    'https://space.bilibili.com/435502585|https://bing.img.run/rand.php',
                'label' => '轮播图片',
                'description' => '请以 跳转链接|图片链接 的格式输入，每行一个。'
            ],
        ],
    ],
    '文章设置' => [
        'title' => '文章设置',
        'fields' => [
            [
                // 收款码
                'type' => 'Text',
                'name' => 'Uika_Post_BiliPay_Img',
                'value' => get_theme_file_url('Assets/images/logo.png', false),
                'label' => '收款码',
                'description' => '设置文章底部充电收款码。<hr>'
            ],
            [
                // 文章代码高亮
                'type' => 'Radio',
                'name' => 'Uika_Post_Prism_Css',
                'value' => 'Okaidia.css',
                'label' => '代码高亮',
                'description' => '请选择代码高亮的风格',
                'options' => [
                    'Default.css' => 'Default',
                    'Okaidia.css' => 'Okaidia',
                    'Coy.css' => 'Coy',
                    'SolarizedLight.css' => 'SolarizedLight',
                    'TomorrowNight.css' => 'TomorrowNight',
                    'Twilight.css' => 'Twilight',
                    'Funky.css' => 'Funky',
                    'Dark.css' => 'Dark',
                ]
            ],
            [
                // 缩略图
                'type' => 'Text',
                'name' => 'Uika_Post_Thumbnail',
                'value' => get_theme_file_url('Assets/images/thumbnail.svg', false),
                'label' => '懒加载图',
                'description' => '设置文章列表默认懒加载图, 图片加载时会显示。'
            ],
            [
                // 缩略图失效
                'type' => 'Text',
                'name' => 'Uika_Post_Thumbnail_Error',
                'value' => get_theme_file_url('Assets/images/thumbnail.svg', false),
                'label' => '懒加载失效图',
                'description' => '设置文章列表懒加载失效图, 图片失效时会显示。'
            ],
            [
                // 自定义缩略图
                'type' => 'Textarea',
                'name' => 'Uika_Post_Thumbnail_Custom',
                'value' => get_theme_file_url('Assets/images/thumb/1.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/2.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/3.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/4.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/5.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/6.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/7.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/8.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/9.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/10.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/11.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/12.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/13.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/14.webp', false) . "\n" .
                    get_theme_file_url('Assets/images/thumb/15.webp', false),
                'label' => '自定义缩略图',
                'description' => '设置文章自定义的默认缩略图, 没有缩略图时会显示。'
            ],
        ],
    ],
    '侧边设置' => [
        'title' => '侧边设置',
        'fields' => [
            [
                // 作者头像
                'type' => 'Text',
                'name' => 'Uika_Author_Avatar',
                'value' => get_theme_file_url('Assets/images/avatar.jpg', false),
                'label' => '作者头像',
                'description' => '设置作者头像, 如果为空则使用Gravatar。'
            ],
            [
                // 作者介绍
                'type' => 'Text',
                'name' => 'Uika_Author_Description',
                'value' => '装逼让你飞起来！',
                'label' => '作者介绍',
                'description' => '设置侧边作者介绍。'
            ],
            [
                // 侧边文章数量
                'type' => 'Text',
                'name' => 'Uika_Sidebar_Post_Size',
                'value' => '6',
                'label' => '文章数量',
                'description' => '设置侧边栏文章输出文章数量。'
            ],
        ],
    ],
    '导航设置' => [
        'title' => '导航设置',
        'fields' => [
            [
                // 顶部导航开关
                'type' => 'Select',
                'name' => 'Uika_Appbar_Links_Switch',
                'value' => 'true',
                'label' => '顶部导航开关',
                'description' => '启用后将会在Appbar标题右侧显示导航按钮',
                'options' => [
                    'true' => '开启',
                    'false' => '关闭'
                ]
            ],
            [
                // 顶部导航链接
                'type' => 'Textarea',
                'name' => 'Uika_Appbar_Links',
                'value' => '首页|' . Get::SiteUrl(false),
                'label' => '顶部导航链接',
                'description' => '设置网站图标，如果为空则使用 首页|' . Get::SiteUrl(false)
            ],
            [
                // 顶部导航链接
                'type' => 'Textarea',
                'name' => 'Uika_Drawer_Links',
                'value' =>
                '<a href=" ' . Get::SiteUrl(false) . '">
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
            <div class="mdui-list-item-content">首页</div>
        </li>
    </a>

    <a href="https://github.com/ShuShuicu/Typecho-Uika-Theme" _target="_blank">
        <li class="mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">code</i>
            <div class="mdui-list-item-content">GitHub</div>
        </li>
    </a>

    <li class="mdui-collapse-item mdui-collapse-item-open">
        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">menu</i>
            <div class="mdui-list-item-content">子菜单</div>
            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
        </div>
        <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
            <li class="mdui-list-item mdui-ripple">Overview</li>
        </ul>
    </li>',
                'label' => '侧边抽屉导航',
                'description' => '设置网站抽屉侧边导航, 使用MDUI的列表组件<a href="https://www.mdui.org/docs/list">https://www.mdui.org/docs/list</a>'
            ],
        ]
    ],
    '页脚设置' => [
        'title' => '页脚设置',
        'fields' => [
            [
                // 页脚版权
                'type' => 'Textarea',
                'name' => 'Uika_Footer_Copyright',
                'value' => '<p>&copy; ' . date('Y') . ' ' . Get::SiteName(false) . ' 保留所有权利.</p>',
                'label' => '版权设置',
                'description' => '一般设置为网站版权声明或备案号。'
            ],
            [
                // 页脚关于我们
                'type' => 'Textarea',
                'name' => 'Uika_Footer_About',
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
                // 页脚链接
                'type' => 'Textarea',
                'name' => 'Uika_Footer_Links',
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
                // 页脚联系我们
                'type' => 'Textarea',
                'name' => 'Uika_Footer_Contact',
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
                'type' => 'Html',
                'content' => '<div style="text-align: center;font-size: 24px;">
                    非必要的情况下保持关闭为好
                </div>'
            ],
            [
                // TTDF框架API开关
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
            [
                // 性能检测
                'type' => 'Select',
                'name' => 'Uika_NB',
                'value' => 'false',
                'label' => '性能检测',
                'description' => '开启后，将会在控制台打印更详细的性能检测信息，建议仅在调试时开启。',
                'options' => [
                    'true' => '开启',
                    'false' => '关闭'
                ]
            ],
        ],
    ],
    'About' => [
        'title' => '关于主题',
        'html' => [
            [
                'content' => '<h2>Misumi Uika</h2>
            <blockquote style="border-left: 4px solid #ccc; padding-left: 20px; margin: 20px 0;">
                <p>saki酱●█▀█▄saki酱●█▀█▄saki酱●█▀█▄</p>
            </blockquote>
            <p>
                Uika是一款开源多功能Typecho的主题, 名称来源于 BanG Dream! <a href="https://mzh.moegirl.org.cn/MyGO!!!!!">MyGO!!!!!</a> & <a href="https://mzh.moegirl.org.cn/Ave_Mujica">Ave Mujica</a> 中的 <a href="https://mzh.moegirl.org.cn/%E4%B8%89%E8%A7%92%E5%88%9D%E5%8D%8E">三角初华</a> 角色。
            </p>
            <p style="text-align: center">
                如有任何疑问请联系作者
                <br />
                <a href="https://blog.miomoe.cn">Blog</a>
                ·
                <a href="https://space.bilibili.com/435502585">Bilibili</a>
                ·
                <a href="https://github.com/ShuShuicu/Typecho-Uika-Theme/issues">Github Issues</a>
                <br />
                <img src=" ' . get_theme_file_url('Assets/images/logo.png', false) . ' " style="width: 120px;" />
            </p>
            <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=100% height=86 src="//music.163.com/outchain/player?type=2&id=2680457871&auto=1&height=66"></iframe>'
            ],
        ],
    ],
];