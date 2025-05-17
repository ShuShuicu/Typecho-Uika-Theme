<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
?>
    <script type="text/javascript">
        const Alert = Vue.createApp({
            data() {
                return {
                    alertSwitch: "<?php htmlspecialchars(Get::Options('Uika_Alert_Switch', true), ENT_QUOTES, 'UTF-8'); ?>",
                    alertMode: "<?php htmlspecialchars(Get::Options('Uika_Alert_Mode', true), ENT_QUOTES, 'UTF-8'); ?>",
                    alertContent: "<?php htmlspecialchars(Get::Options('Uika_Alert_Content', true), ENT_QUOTES, 'UTF-8'); ?>",
                };
            },
            template: `
                <div v-if="alertSwitch === 'true'" :class="['Uika-Alerts', 'Uika-Alerts--' + alertMode]">
                    <span class="Uika-Alerts-icon"></span>
                    <div class="Uika-Alerts-content">{{ alertContent }}</div>
                </div>
            `,
        });
        Alert.mount('#Alert');
    </script>
<?php
});
?>
<div id="Alert"></div>