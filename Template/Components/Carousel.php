<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
TTDF_Hook::add_action('load_foot', function () {
    $CarouselContent = Get::Options('Uika_Carousel_Content');
    $carouselItems = [];
    if ($CarouselContent) {
        $lines = explode("\n", $CarouselContent);
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            if (count($parts) == 2) {
                $carouselItems[] = [
                    'link' => trim($parts[0]),
                    'image' => trim($parts[1]),
                ];
            }
        }
    }
?>
    <script type="text/javascript">
        const Carousel = Vue.createApp({
            data() {
                return {
                    carouselItems: <?php echo json_encode($carouselItems); ?>
                };
            },
            template: `
            <a-carousel
                auto-play
                animation-name="fade"
                indicator-type="dot"
                show-arrow="hover"
                class="Uika-Carousel"
            >
                <a-carousel-item v-for="(item, index) in carouselItems" :key="index" class="Uika-carousel-item">
                    <a :href="item.link" target="_blank">
                        <img :src="item.image" />
                    </a>
                </a-carousel-item>
            </a-carousel>
        `,
        });
        Carousel.mount('#Carousel');
    </script>
<?php
});
?>
<div id="Carousel"></div>