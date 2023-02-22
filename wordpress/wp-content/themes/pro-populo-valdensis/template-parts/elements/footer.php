<div class="ppv-footer-wrapper bg-ppv-red-150 text-white text-xs mt-24">
    <div class="ppv-container ppv-container__full py-3">
        <div class="ppv-footer-content flex justify-between flex-wrap">
            <div class="ppv-footer-nav w-full md:w-auto mb-4 md:mb-0">
                <?=
                wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'container' => false,
                    'menu_class' => 'ppv-footer-menu flex flex-col md:flex-row gap-x-4 gap-y-2',
                    'menu_id' => 'ppv-footer-menu',
                    'echo' => false,
                    'depth' => 1
                ) );
                ?>
            </div>
            <div class="ppv-footer-credits">
                Built with 💛 by K.
            </div>
        </div>
    </div>
</div>