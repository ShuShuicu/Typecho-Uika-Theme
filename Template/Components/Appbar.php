<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>

<?php
});
?>
<div class="mdui-appbar-fixed mdui-appbar-scroll-hide" id="Appbar" style="z-index: 1000;">
    <div class="Uika-Appbar mdui-toolbar">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true}">
            <i class="mdui-icon material-icons">menu</i>
        </a>
        <a href="<?php Get::SiteUrl() ?>" class="mdui-typo-headline">
            <?php Get::SiteName() ?>
        </a>
        <div class="mdui-hidden-xs-down">
            <button class="mdui-btn mdui-ripple mdui-text-capitalize">button</button>
            <button class="mdui-btn mdui-ripple mdui-text-capitalize">button</button>
            <button class="mdui-btn mdui-ripple mdui-text-capitalize">button</button>
        </div>
        <div class="mdui-toolbar-spacer"></div>
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" id="SwitchTheme" onclick="switchTheme()">
            <i class="mdui-icon material-icons">brightness_6</i>
        </a>
    </div>
</div>

<div class="mdui-drawer mdui-drawer-close mdui-card" id="drawer">
    <a-menu
        :style="{ height: '100%' }"
        :default-open-keys="['0']"
        >
        <a-sub-menu key="0">
            <template #icon></template>
            <template #title>Appbar</template>
            <a-menu-item key="0_0">Menu 1</a-menu-item>
            <a-menu-item key="0_1">Menu 2</a-menu-item>
            <a-menu-item key="0_2">Menu 3</a-menu-item>
            <a-menu-item key="0_3">Menu 4</a-menu-item>
        </a-sub-menu>
    </a-menu>
</div>