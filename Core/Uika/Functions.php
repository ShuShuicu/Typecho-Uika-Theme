<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 获取随机缩略图URL
 *
 * @param string $base_url 基础URL路径
 * @param int $maxImages 最大图片数量
 * @return string 随机缩略图URL
 */
function get_RandomThumbnail($base_url, $maxImages = 15)
{
    // 生成一个1到$maxImages之间的随机数  
    $rand = mt_rand(1, $maxImages);
    // 构造随机缩略图的URL  
    return $base_url . $rand . '.webp';
}

/**
 * 获取文章缩略图URL
 *
 * @param Widget_Abstract_Contents $widget 文章对象
 * @return string 缩略图URL
 */
function get_ArticleThumbnail($widget)
{
    // 自定义缩略图逻辑  
    if ($customThumb = $widget->fields->ThumbnailUrl) {
        return $customThumb;
    }

    // 尝试从内容中提取图片URL  
    if ($contentThumb = extractImageFromContent($widget->content)) {
        return $contentThumb;
    }

    // 尝试从附件中获取图片URL  
    if ($attachmentThumb = getAttachmentImageUrl($widget)) {
        return $attachmentThumb;
    }

    // 获取默认缩略图路径
    $base_url = '/Assets/images/thumb/'; // 默认缩略图路径  

    // 如果设置了articleImgSpeed，则使用它作为图片的基本URL  
    if (!empty(Helper::options()->articleImgSpeed)) {
        $base_url = Helper::options()->articleImgSpeed;
        // 确保URL以斜杠结尾  
        if (substr($base_url, -1) !== '/') {
            $base_url .= '/';
        }
    } else {
        // 使用themeUrl和默认的图片路径  
        $base_url = $widget->widget('Widget_Options')->themeUrl . $base_url;
    }

    // 调用辅助函数获取随机缩略图  
    return get_RandomThumbnail($base_url);
}

/**
 * 从文章内容中提取图片URL
 *
 * @param string $content 文章内容
 * @return string|null 图片URL或null
 */
function extractImageFromContent($content)
{
    $pattern = '/<img.*?src="(.*?)"[^>]*>/i';
    if (preg_match($pattern, $content, $matches) && strlen($matches[1]) > 7) {
        return htmlspecialchars($matches[1]);
    }
    // 添加调试信息
    error_log('Failed to extract image from content: ' . $content);
    return null;
}

/**
 * 从附件中获取图片URL
 *
 * @param Widget_Abstract_Contents $widget 文章对象
 * @return string|null 图片URL或null
 */
function getAttachmentImageUrl($widget)
{
    $attach = $widget->attachments(1)->attachment;
    if ($attach && $attach->isImage) {
        return htmlspecialchars($attach->url);
    }
    // 添加调试信息
    error_log('Failed to get attachment image: ' . print_r($attach, true));
    return null;
}

if (Get::Options('Uika_NB') === 'true') {
    TTDF_Hook::add_action('load_foot', function () {
?>

    <script type="text/javascript">
        // 页面加载耗时监控
        document.addEventListener('DOMContentLoaded', function() {
            // 获取页面性能数据
            const timing = window.performance.timing;

            // 计算各阶段耗时
            const loadTime = timing.loadEventEnd - timing.navigationStart;
            const domReadyTime = timing.domComplete - timing.domLoading;
            const redirectTime = timing.redirectEnd - timing.redirectStart;
            const appCacheTime = timing.domainLookupStart - timing.fetchStart;
            const dnsTime = timing.domainLookupEnd - timing.domainLookupStart;
            const tcpTime = timing.connectEnd - timing.connectStart;
            const ttfbTime = timing.responseStart - timing.requestStart;
            const contentLoadTime = timing.responseEnd - timing.requestStart;
            const whiteScreenTime = timing.responseStart - timing.navigationStart;

            // 打印详细耗时信息
            console.groupCollapsed('页面加载性能分析');
            console.log('页面完全加载耗时: %c' + loadTime + 'ms', 'color: #4CAF50; font-weight: bold');
            console.log('DOM准备完成耗时: %c' + domReadyTime + 'ms', 'color: #2196F3');
            console.log('重定向耗时: %c' + redirectTime + 'ms', 'color: #FF9800');
            console.log('App缓存耗时: %c' + appCacheTime + 'ms', 'color: #9C27B0');
            console.log('DNS查询耗时: %c' + dnsTime + 'ms', 'color: #607D8B');
            console.log('TCP连接耗时: %c' + tcpTime + 'ms', 'color: #795548');
            console.log('首字节时间(TTFB): %c' + ttfbTime + 'ms', 'color: #F44336');
            console.log('内容加载耗时: %c' + contentLoadTime + 'ms', 'color: #00BCD4');
            console.log('白屏时间: %c' + whiteScreenTime + 'ms', 'color: #8BC34A');
            console.groupEnd();

            // 打印总耗时到页面标题(可选)
            document.title += ' | 加载耗时: ' + loadTime + 'ms';
        });

        // 监听资源加载错误
        window.addEventListener('error', function(e) {
            console.error('资源加载错误:', e.target.src || e.target.href, e);
        }, true);

        // 使用PerformanceObserver API监控更多性能指标(现代浏览器支持)
        if ('PerformanceObserver' in window) {
            const observer = new PerformanceObserver((list) => {
                for (const entry of list.getEntries()) {
                    console.log('[性能观察]', entry.name, entry.duration.toFixed(2) + 'ms');
                }
            });

            // 观察资源加载和长任务
            observer.observe({
                entryTypes: ['resource', 'longtask']
            });
        }
    </script>
<?php
    });
}