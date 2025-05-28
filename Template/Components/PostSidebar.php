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
    'pageSize' => Get::Options('Uika_Sidebar_Post_Size', false),
    'type' => 'category',
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
                        Name: '<?php echo UserInfo::Name(true, true); ?>',
                        Description: '<?php echo Get::Options('Uika_Author_Description', false) ?: '原神启动！'; ?>',
                    },
                    posts: sidebarData.posts || []
                };
            }
        });
        Sidebar.use(ArcoVue);
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
            <div class="mdui-card-header-subtitle">
                <a-tooltip :content="author.Description" position="bottom">
                    <a-typography-text>{{ author.Description }}</a-typography-text>
                </a-tooltip>
            </div>
        </div>
    </div>

    <div class="mdui-card mdui-m-b-2">
        <a-list>
            <a-list-item v-for="post in posts"
                :key="post.title">
                <a :href="post.permalink">
                    {{ post.title }}</a>
            </a-list-item>
        </a-list>
    </div>

    <div class="mdui-card mdui-card-content mdui-m-b-2">
        <a-statistic title="本文阅读量" :value="<?php Postviews($this); ?>" show-group-separator />
    </div>

</div>