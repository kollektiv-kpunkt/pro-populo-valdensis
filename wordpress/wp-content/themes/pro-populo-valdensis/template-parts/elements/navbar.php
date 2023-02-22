<nav class="ppv-navbar-outer text-white py-3 border-b-white border-b-2 fixed top-0 left-0 w-full z-40 <?= (has_block("ppv/page-heroine")) ? "" : "bg-ppv-red" ?>">
    <div class="ppv-container ppv-container__full">
        <div class="ppv-navbar-wrapper flex justify-between items-center">
            <a href="/" class="ppv-app-title flex items-center gap-x-4 ppv-noline">
                <div class="h-8 w-8">
                    <?php
                    get_template_part( "template-parts/elements/applogo");
                    ?>
                </div>
                <div class="font-black text-xl">
                    <p><?= get_bloginfo( 'name' ) ?></p>
                </div>
            </a>
            <div class="ppv-app-navmenu">
                <div class="ppv-app-navmenu-items">
                    <div class="ppv-app-navmenu-items-container mr-6">
                        <?=
                        wp_nav_menu([
                            "theme_location" => "primary_menu",
                            "container" => false,
                            "menu_class" => "ppv-app-navmenu-items-list flex gap-x-6",
                            "echo" => false,
                        ]);
                        ?>
                    </div>
                </div>
                <button type="button" class="ppv-menubutton">
                    <div class="ppv-tofuburger">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="ppv-open-nav-overlay fixed top-0 left-0 w-full h-full" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color: rgba(0, 0, 0, 0.5); z-index: 999; visibility: hidden; opacity: 0; transition: 0.25s ease visibility, 0.25s ease opacity;"></div>