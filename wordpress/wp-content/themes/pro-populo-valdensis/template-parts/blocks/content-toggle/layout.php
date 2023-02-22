<div class="ppv-content-toggle-wrapper">
    <details class="ppv-content-toggle mt-4 text-start"<?= (get_field("default_setting")) ? " open" : "" ?>>
        <summary class="ppv-content-toggle-summary flex justify-between leading-none">
            <span class="ppv-content-toggle-title"><?= get_field("title") ?></span>
            <div class="ppv-content-toggle-icon text-center"><i class="icofont-rounded-down text-2xl"></i></div>
        </summary>
        <div class="ppv-content-toggle-content mt-4">
            <?= get_field("content") ?>
        </div>
    </details>
</div>