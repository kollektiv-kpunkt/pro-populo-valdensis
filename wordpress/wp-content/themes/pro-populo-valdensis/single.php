<?php
add_filter("body_class", function($classes) {
    $classes[] = "ppv-page-heroine";
    if (has_post_thumbnail(  )) {
        $classes[] = "ppv-page-heroine--has-featured-img";
    }
    return $classes;
});
get_header();
?>

<?php
get_template_part( "template-parts/blocks/page-heroine/layout", null, array(
    "title" => get_the_title(),
    "single" => true,
    "nolead" => true
));
the_content();
?>
<div class="pkn-page-buttons mt-28 text-xs md:flex justify-between">
    <?php if (get_next_post_link()) : ?>
        <div class="md:w-1/2 pkn-next-link mr-auto flex justify-start">
            <?= next_post_link(
                '<span class="flex gap-1 items-center"><i class="icofont-rounded-left"></i>%link</span>'
            ) ?>
        </div>
    <?php endif; ?>
    <?php if (get_previous_post_link()) : ?>
        <div class="md:w-1/2 pkn-prev-link ml-auto flex justify-end">
            <?= previous_post_link(
                '<span class="flex gap-1 items-center">%link<i class="icofont-rounded-right"></i></span>'
            ) ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>