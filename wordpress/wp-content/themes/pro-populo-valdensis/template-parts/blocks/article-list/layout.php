<?php
global $post;
extract( $args ?? [] );
$categories = get_categories([
    "hide_empty" => false,
    "parent" => 0
]);
$post_tags = get_tags(array(
    "hide_empty" => false
));

$selected_tags = array_filter(explode(",",$_GET["tags"] ?? ""));
$selected_categories = array_filter(explode(",",$category ?? $_GET["categories"] ?? ""));
$author = $author ?? $_GET["author"] ?? "";

$search_open = (isset($_GET["q"]) || count($selected_tags) > 0 || count($selected_categories) > 0);

$wp_query = new WP_Query([
    "post_type" => "post",
    "posts_per_page" => 10,
    "orderby" => "date",
    "order" => "DESC",
    "s" => $_GET["q"] ?? "",
    "tag__in" => $selected_tags,
    "category__in" => $selected_categories,
    "author" => $author,
    "post_status" => "publish",
    "paged" => get_query_var("paged") ?: 1
]);
$posts = $wp_query->posts;
$cat_page = $cat_page ?? false;

?>

<div class="ppv-article-list-wrapper <?= $block["className"] ?? "alignwide" ?>">
    <?php if (in_array("1", get_field("show_searchbar") ?? [1])) : ?>
        <div class="w-full flex justify-end">
            <a href="#" class="ppv-article-list-open-searchbar ml-auto mr-0 inline ppv-button-neg ppv-bi-dots !no-underline text-end text-ppv-red"><?= esc_html__( "Filtrer", "ppv" ) ?></a>
        </div>
        <div class="ppv-article-list-searchbar-wrapper <?= ($search_open) ? "max-h-max overflow-visible ppv-article-list-searchbar-open" : "max-h-0 overflow-hidden" ?>"<?= ($cat_page) ? " data-is-cat-page='1'" : "" ?>>
            <div class="ppv-article-list-searchbar bg-whiteflex flex-wrap flex gap-4 items-end pt-8">
                <input type="text" name="query" value="<?= $_GET["q"] ?? "" ?>" placeholder="<?= esc_html__( "Recherche", "ppv" ) ?>">
                <?php if($cat_page): ?>
                <select name="categories" class="hidden">
                    <option value="<?= $category ?>"></option>
                </select>
                <?php else: ?>
                <div class="ppv-select-wrapper">
                    <select name="categories" class="ppv-choices-js">
                        <option value=""><?= esc_html__( "Toutes Catégories", "ppv" )?></option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->term_id ?>" <?= (in_array($category->term_id, $selected_categories)) ? "selected" : "" ?>><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>
                <div class="ppv-select-wrapper">
                    <select multiple name="tags" class="ppv-choices-js" data-no-choices-text="<?= esc_html__( "Pas de mots-clés", "ppv" ) ?>" data-no-results-text="<?= esc_html__("Aucun mot-clé trouvé", "ppv") ?>">
                        <option value=""><?= esc_html__( "Mots clé", "ppv" )?></option>
                        <?php foreach ($post_tags as $tag) : ?>
                            <option value="<?= $tag->term_id ?>" <?= (in_array($tag->term_id, $selected_tags)) ? "selected" : "" ?>><?= $tag->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="ppv-button ppv-i-search"><?= esc_html__( "Rechercher", "ppv" ) ?></button>
            </div>
        </div>
    <?php endif; ?>

    <div class="ppv-article-list mt-16 flex flex-col gap-y-8">
        <?php if (count($posts) == 0) : ?>
            <h2 class="ppv-article-list-item-title text-xl font-normal italic text-ppv-red opacity-50">
                <?= esc_html__( "Aucun article trouvé", "ppv" ) ?>
            </h2>
        <?php endif; ?>
        <?php
            $i = 0;
            foreach ($posts as $post) :
            setup_postdata($post);
            ?>
            <div class="ppv-article-list-item">
                <div class="ppv-article-list-item-link flex flex-wrap">
                    <?php if (has_post_thumbnail(  )) : ?>
                    <div class="ppv-article-list-item-image-mobile w-full max-w-lg mx-auto mb-4 sm:mb-6 md:mb-8 lg:hidden">
                        <div class="relative h-full w-full">
                            <img class="absolute w-full h-full object-cover" src="<?= get_the_post_thumbnail_url($post->ID, "large") ?>" alt="<?= get_the_title($post->ID) ?>" loading="lazy">
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="ppv-article-list-item-content lg:w-2/3">
                        <div>
                            <a href="<?= get_permalink($post->ID) ?>" class="!no-underline">
                                <h2 class="ppv-article-list-item-title text-xl text-ppv-red">
                                    <?= get_the_title($post->ID) ?>
                                </h2>
                                <div class="ppv-article-list-item-excerpt">
                                    <?= ppv_get_excerpt(["length" => 30]) ?>
                                </div>
                            </a>
                            <div class="ppv-article-list-item-meta mt-4 text-ppv-black-40 text-xs flex flex-col gap-y-1">
                                <div class="ppv-article-list-item-meta-author">
                                    <?php
                                    $name = get_the_author_meta("first_name", $post->post_author) . " " .get_the_author_meta("last_name", $post->post_author);
                                    $url = get_author_posts_url($post->post_author);
                                    echo(<<<EOD
                                    <i class="icofont-ui-user mr-1"></i> <a href="{$url}" class="ppv-article-list-item-meta-author">{$name}</a>
                                    EOD);
                                    ?>
                                </div>
                                <div class="ppv-article-list-item-meta-date">
                                    <i class="icofont-calendar mr-1"></i> <?= get_the_date() ?>
                                </div>
                                <div class="ppv-article-list-item-meta-categories ml-5" style="margin-top: -2px">
                                    <?php
                                    $categories = get_the_category($post->ID);
                                    $i = 0;
                                    foreach ($categories as $category) :
                                        if ($i > 0) echo " | ";
                                        $category->link = get_category_link($category->term_id);
                                        echo(<<<EOD
                                        <a href="{$category->link}" class="ppv-article-list-item-meta-category">{$category->name}</a>
                                        EOD);
                                        $i++;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (has_post_thumbnail(  )) : ?>
                    <div class="ppv-article-list-item-image w-1/3 pl-8 hidden lg:flex">
                        <div class="relative w-full my-auto">
                            <a href="<?= get_permalink($post->ID) ?>" class="!no-underline absolute top-0 left-0 w-full h-full">
                                <img class="absolute top-0 left-0 w-full h-full object-cover" src="<?= get_the_post_thumbnail_url($post->ID, "medium_large") ?>" alt="<?= get_the_title($post->ID) ?>" loading="lazy">
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($i < count($posts) - 1) : ?>
                    <hr class="ppv-article-list-item-separator mt-8 border-ppv-red-20">
                <?php endif; ?>
            </div>
        <?php $i++;
        endforeach;
        wp_reset_postdata();
        ?>
    </div>

    <div class="ppv-article-list-pagination">
        <?php
        $big = 999999999; // need an unlikely integer
        $args = array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '<span><i class="icofont-rounded-left"></i></span>',
            'next_text' => '<span><i class="icofont-rounded-right"></i></span>',
            'type' => 'list'
        );
        echo paginate_links( $args );
        ?>
    </div>
</div>


<script>
    window.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            if (document.activeElement.parentElement.classList.contains("ppv-article-list-searchbar")) {
                let searchBar = document.activeElement.closest(".ppv-article-list-searchbar");
                let searchButton = searchBar.querySelector("button[type='submit']");
                searchButton.click();
            }
        }
    });
</script>