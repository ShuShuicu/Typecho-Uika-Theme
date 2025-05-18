<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function Uika_Author_Avatar()
{
    if (Get::Options('Uika_Author_Avatar') === '') {
        UserInfo::AvatarURL(220, true);
    } else {
        Get::Options('Uika_Author_Avatar', true);
    }
}

$featuredPosts = GetPost::List([
    'pageSize' => 6,
    'type' => 'category',
    'mid' => 2
]);

$postData = [];

while ($featuredPosts->next()) {
    $postData[] = [
        'title' => GetPost::Title('', '', true),
        'permalink' => GetPost::Permalink('', '', true)
    ];
}

GetPost::unbindArchive();

TTDF_Hook::add_action('load_foot', function () use ($postData) {
?>
    <script type="text/javascript">
        const sidebarData = <?php echo json_encode(['posts' => $postData], JSON_UNESCAPED_UNICODE); ?>;
        const Sidebar = Vue.createApp({
            data() {
                return {
                    author: {
                        Avatar: '<?php Uika_Author_Avatar(); ?>',
                        Name: '<?php echo UserInfo::Name(true, true); ?>'
                    },
                    posts: sidebarData.posts || []
                };
            }
        });
        Sidebar.mount('#Sidebar');
    </script>
<?php
});
?>
<div id="Sidebar">
    <div class="mdui-card mdui-m-b-2">
        <div class="mdui-card-header">
            <img class="mdui-card-header-avatar" :src="author.Avatar" />
            <div class="mdui-card-header-title">{{ author.Name }}</div>
            <div class="mdui-card-header-subtitle">Subtitle</div>
        </div>
    </div>

    <div class="mdui-card mdui-m-b-2">
        <div class="mdui-list">
            <a v-for="post in posts"
                :key="post.title"
                :href="post.permalink"
                class="mdui-list-item mdui-ripple">
                {{ post.title }}
            </a>
        </div>
    </div>
</div>