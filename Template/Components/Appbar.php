<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
    if (Get::Options('Uika_Appbar_Links_Switch', false) === 'true') {
?>
        <script type="text/javascript">
            const AppbarLinks = Vue.createApp({
                data() {
                    return {
                        links: `<?php Get::Options('Uika_Appbar_Links', true); ?>`,
                    };
                },
                computed: {
                    parsedLinks() {
                        return this.links.split('\n').map(line => {
                            const [text, url] = line.split('|');
                            return {
                                text,
                                url
                            };
                        });
                    }
                },
                template: `
                <a v-for="(link, index) in parsedLinks" :key="index" :href="link.url">
                    <button class="mdui-btn mdui-ripple mdui-text-capitalize">{{ link.text }}</button>
                </a>
            `,
            });
            AppbarLinks.mount('#AppbarLinks');
        </script>
    <?php
    }
});
?>
<div class="mdui-appbar-fixed mdui-appbar-scroll-hide" id="Appbar" style="z-index: 1000;">
    <div class="Uika-Appbar mdui-toolbar">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#Drawer', overlay: true}">
            <i class="mdui-icon material-icons">menu</i>
        </a>
        <a href="<?php Get::SiteUrl() ?>" class="mdui-typo-headline">
            <?php Get::SiteName() ?>
        </a>
        <?php if (Get::Options('Uika_Appbar_Links_Switch', false) === 'true') { ?>
            <div class="mdui-hidden-xs-down">
                <div id="AppbarLinks"></div>
            </div>
        <?php } ?>
        <div class="mdui-toolbar-spacer"></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" id="SwitchTheme" onclick="switchTheme()">
            <i class="mdui-icon material-icons">brightness_6</i>
        </a>
    </div>
</div>

<div class="mdui-drawer mdui-drawer-close mdui-card" id="Drawer">
    <ul class="mdui-list" mdui-collapse="{accordion: true}">
        <?php json_encode(Get::Options('Uika_Drawer_Links', true)); ?>
    </ul>
</div>