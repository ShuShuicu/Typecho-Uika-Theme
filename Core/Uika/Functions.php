<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 获取随机缩略图URL
 *
 * @return string 随机缩略图URL
 */
function get_RandomThumbnail()
{
    // 从后台设置中获取自定义缩略图列表
    $thumbnails = Helper::options()->Uika_Post_Thumbnail_Custom;
    
    if (!empty($thumbnails)) {
        // 将文本按行分割成数组
        $thumbnailList = array_filter(array_map('trim', explode("\n", $thumbnails)));
        
        if (!empty($thumbnailList)) {
            // 随机选择一个缩略图
            $randIndex = array_rand($thumbnailList);
            return trim($thumbnailList[$randIndex]);
        }
    }
    
    // 默认缩略图路径
    $base_url = Helper::options()->themeUrl . '/Assets/images/thumb/';
    return $base_url . mt_rand(1, 15) . '.webp';
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

    // 调用辅助函数获取随机缩略图  
    return get_RandomThumbnail();
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
    return null;
}
/*
* 评论回复时 @ 评论人
*/
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent,status')->from('table.comments')
        ->where('coid = ?', $coid));
    $mail = "";
    $parent = @$prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author,status,mail')->from('table.comments')
            ->where('coid = ?', $parent));
        @$author = @$arow['author'];
        $mail = @$arow['mail'];
        if(@$author && $arow['status'] == "approved"){
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">（评论审核中）)</p>';
            }
            echo '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        }else{
            if (@$prow['status'] == "waiting"){
                echo '<p class="commentReview">（评论审核中）)</p>';
            }else{
                echo '';
            }
        }

    } else {
        if (@$prow['status'] == "waiting"){
            echo '<p class="commentReview">（评论审核中）)</p>';
        }else{
            echo '';
        }
    }
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

/**
 * 文章阅读数
 */
function Postviews($archive) {
    $db = Typecho_Db::get();
    $cid = $archive->cid;
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `'.$db->getPrefix().'contents` ADD `views` INT(10) DEFAULT 0;');
    }
    $exist = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid))['views'];
    if ($archive->is('single')) {
        $cookie = Typecho_Cookie::get('contents_views');
        $cookie = $cookie ? explode(',', $cookie) : array();
        if (!in_array($cid, $cookie)) {
            $db->query($db->update('table.contents')
                ->rows(array('views' => (int)$exist+1))
                ->where('cid = ?', $cid));
            $exist = (int)$exist+1;
            array_push($cookie, $cid);
            $cookie = implode(',', $cookie);
            Typecho_Cookie::set('contents_views', $cookie);
        }
    }
    echo $exist == 0 ? '暂无阅读' : $exist;
}