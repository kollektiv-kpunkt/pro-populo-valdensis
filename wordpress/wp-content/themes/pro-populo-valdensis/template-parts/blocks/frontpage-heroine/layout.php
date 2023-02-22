<?php
global $post;
$blogs = get_posts([
    'post_type' => 'post',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
]);
?>

<div class="ppv-heroine-wrapper mb-24 alignfull <?= $block["className"] ?? "" ?>">
    <div class="ppv-heroine-blog-slider-outer bg-ppv-red text-white">
        <div class="ppv-container ppv-container__small">
            <div class="ppv-heroine-blog-slider">
                <?php
                $i = 0;
                foreach ($blogs as $post) : ?>
                    <?php setup_postdata($post); ?>
                    <a href="<?= the_permalink() ?>" class="!no-underline ppv-blog-slide<?= ($i==0) ? " active" : "" ?>">
                        <div class="ppv-blog-slide-inner py-6 md:py-12 flex flex-col gap-y-2 md:gap-y-4 items-center text-center">
                            <div class="ppv-blog-slide-title"><h2 class="text-2xl md:text-4xl lg:text-6xl font-black !mb-0"><?= the_title() ?></h2></div>
                            <div class="ppv-blog-slide-content"><p class="md:text-2xl m-0"><?= ppv_get_excerpt(["length" => 25, "custom_excerpts" => false]) ?></p></div>
                            <div class="ppv-blog-slide-readmore ppv-i-right !no-underline"><?= esc_html__( 'En savoir plus', 'ppv' ) ?></div>
                        </div>
                    </a>
                <?php
                $i++;
                endforeach; ?>
                <?php wp_reset_postdata(); ?>
                <div class="ppv-heroine-blog-slider-pagination flex gap-1 justify-center">
                    <?php for ($i=0; $i < count($blogs); $i++) : ?>
                        <button type="button" class="ppv-heroine-blog-slider-pagination-item<?= ($i==0) ? " active" : "" ?>" data-slide-id="<?= $i ?>"></button>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $cards = get_field("frontpage_cards");
    ?>
    <div class="ppv-heroine-card-grid ppv-container ppv-container__small" data-cards="<?= (count($cards) % 2 == 0) ? "even" : "odd" ?>">
        <?php foreach ($cards as $card):
            $title = ($card["title"] == "") ? $card["link_to"]->post_title : $card["title"];
            ?>
            <a href="<?= get_the_permalink($card["link_to"]->ID) ?>" class="ppv-heroine-card-grid-item">
                <div class="ppv-heroine-card-grid-item-inner relative">
                    <div class="ppv-heroine-card-grid-item-content absolute top-0 left-0 w-full h-full text-white">
                        <h3 class="absolute bottom-4 left-4 !mb-0 z-50 text-2xl md:text-4xl leading-none"><?= $title ?></h3>
                        <?php if ($card["preview_image"]) : ?>
                            <img src="<?= wp_get_attachment_image_url($card["preview_image"]["ID"], "large") ?>" alt="<?= $title ?>" class="ppv-heroine-card-item-image absolute top-0 left-0 w-full h-full object-cover" loading="lazy">
                            <?php if (in_array("red", $card["image_overlay"])): ?>
                                <div class="ppv-heroine-card-item-image-blind bg-ppv-red absolute top-0 left-0 w-full h-full z-40 mix-blend-darken"></div>
                            <?php else : ?>
                                <div class="ppv-heroine-card-item-image-blind ppv-heroine-card-item-image-blind-gradient  absolute top-0 left-0 w-full h-full z-40"></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>