<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
</main>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-columns">
            <div class="footer-column about">
                <?php Get::Options('Uika_Footer_About', true); ?>
            </div>

            <div class="footer-column links">
                <?php Get::Options('Uika_Footer_Links', true); ?>
            </div>

            <div class="footer-column contact">
                <?php Get::Options('Uika_Footer_Contact', true); ?>
            </div>
        </div>

        <div class="copyright">
            <?php Get::Options('Uika_Footer_Copyright', true); ?>
        </div>
    </div>
</footer>
</div>
<?php TTDF_Hook::do_action('load_foot'); ?>
</body>

</html>