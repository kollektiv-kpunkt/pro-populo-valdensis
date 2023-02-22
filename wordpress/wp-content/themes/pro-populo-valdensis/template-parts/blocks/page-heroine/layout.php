<?php
global $post;
setup_postdata($post);
extract($args ?? []);
$single = $single ?? false;
$bg_img = (has_post_thumbnail( get_the_ID() ) && !$single);
$nolead = $nolead ?? false;
?>
<div class="ppv-page-heroine-wrapper alignfull relative mb-16<?= ($bg_img) ? " ppv-page-heroine-with-image" : "" ?>">
    <div class="ppv-page-heroine-content ppv-container ppv-container__small text-white relative z-30 text-center">
        <h1 class="!mb-0 text-4xl <?= (!$single) ? "md:text-5xl xl:text-7xl" : "xl:text-5xl" ?>"><?= (get_field("page_title")) ? get_field("page_title") : $post->title ?? get_the_title() ?></h1>
        <?php if (!$nolead) : ?>
        <div class="mt-4 font-bold<?= (!$single) ? " md:text-lg xl:text-2xl" : "" ?>">
            <?= $lead ?? get_field("lead") ?>
        </div>
        <?php endif; ?>
        <?php if ($single) : ?>
            <div class="ppv-single-meta mt-4 text-white opacity-50 text-xs flex justify-center gap-x-4">
                <div class="ppv-single-meta-author">
                    <?php
                    $name = get_the_author_meta("first_name", $post->post_author) . " " .get_the_author_meta("last_name", $post->post_author);
                    $url = get_author_posts_url($post->post_author);
                    echo(<<<EOD
                    <i class="icofont-ui-user mr-2"></i><a href="{$url}" class="ppv-single-meta-author">{$name}</a>
                    EOD);
                    ?>
                </div>
                <div class="ppv-single-meta-date">
                    <i class="icofont-calendar mr-1"></i><?= get_the_date("d.m.Y", $post->ID) ?>
                </div>
                <div class="ppv-single-meta-categories">
                    <?php
                    $categories = get_the_category($post->ID);
                    $i = 0;
                    foreach ($categories as $category) :
                        if ($i > 0) echo ", ";
                        $category->link = get_category_link($category->term_id);
                        echo(<<<EOD
                        <a href="{$category->link}" class="ppv-single-meta-category">{$category->name}</a>
                        EOD);
                        $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if ($bg_img) : ?>
    <div class="ppv-page-heroine-image-bg absolute top-0 left-0 w-full h-full overflow-hidden">
        <img
            src="<?= get_the_post_thumbnail_url(get_the_ID(), "medium" ) ?>"
            alt="<?= get_the_title()?>"
            class="ppv-page-heroine-img object-cover w-full h-full absolute top-0 left-0 !blur-md !grayscale"
            srcset="
                <?= get_the_post_thumbnail_url(get_the_ID(), "full" ) ?>,
                <?= get_the_post_thumbnail_url(get_the_ID(), "large" ) ?> 800w,
                <?= get_the_post_thumbnail_url(get_the_ID(), "medium_large" ) ?> 300w,
                <?= get_the_post_thumbnail_url(get_the_ID(), "medium" ) ?> 0w">
        <div class="ppv-page-heroine-img-blind bg-ppv-red mix-blend-darken w-full h-full absolute"></div>
    </div>
    <?php else : ?>
    <div class="ppv-page-heroine-bg absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="ppv-page-heroine-img-blind bg-ppv-red mix-blend-darken w-full h-full absolute"></div>
    </div>
    <?php endif; ?>
</div>
<?php if ($single && has_post_thumbnail(  )) : ?>
    <div class="ppv-single-featured-img alignfull ppv-container ppv-container__small mb-10">
        <div class="ppv-single-featured-img-outer">
            <div class="ppv-single-featured-img-container relative">
                <img
                src="<?= get_the_post_thumbnail_url(get_the_ID(), "medium" ) ?>"
                alt="<?= get_the_title()?>"
                class="absolute h-full w-full object-cover"
                srcset="
                    <?= get_the_post_thumbnail_url(get_the_ID(), "full" ) ?>,
                    <?= get_the_post_thumbnail_url(get_the_ID(), "large" ) ?> 800w,
                    <?= get_the_post_thumbnail_url(get_the_ID(), "medium_large" ) ?> 300w,
                    <?= get_the_post_thumbnail_url(get_the_ID(), "medium" ) ?> 0w">
            </div>
        </div>
    </div>
<?php endif; ?>