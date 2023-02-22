<?php
add_filter("body_class", function($classes) {
    $classes[] = "ppv-page-heroine";
    return $classes;
});
get_header();
$post = get_queried_object();
setup_postdata($post);
$post->title = esc_html__( "Catégorie: ", "ppv" ) . $post->name;
?>

<?php get_template_part( "template-parts/blocks/page-heroine/layout");
get_template_part( "template-parts/blocks/article-list/layout", null, [
    "category" => $post->term_id,
    "cat_page" => true
]);
?>



<?php get_footer(); ?>