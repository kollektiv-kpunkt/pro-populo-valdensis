<?php
add_filter("body_class", function($classes) {
    $classes[] = "ppv-page-heroine";
    return $classes;
});
get_header();
$post = get_queried_object();
setup_postdata($post);
$post->title = esc_html__( "Auteur: ", "ppv" ) . $post->first_name . " " . $post->last_name;
?>

<?php get_template_part( "template-parts/blocks/page-heroine/layout");
get_template_part( "template-parts/blocks/article-list/layout", null, [
    "author" => $post->ID
]);
?>



<?php get_footer(); ?>