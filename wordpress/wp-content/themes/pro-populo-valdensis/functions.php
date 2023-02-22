<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

include "inc/inc.vite.php";
include "inc/inc.acf.php";
include "inc/inc.excerpt.php";

function pvv_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'align-wide' );
    add_theme_support( "editor-color-palette", array(
        [
            "slug" => "ppv-red",
            "color" => "#CA0125",
            "name" => "PPV Red"
        ],
        [
            "slug"=> "ppv-black",
            "color"=> "#120101",
            "name"=> "PPV Black"
        ],
        [
            "slug"=> "ppv-grey",
            "color"=> "#8A8A8A",
            "name"=> "PPV Grey"
        ],
        [
            "slug"=> "ppv-blue",
            "color"=> "#7B9DAA",
            "name"=> "PPV Blue"
        ],
        [
            "slug"=> "white",
            "color"=> "#FFFFFF",
            "name"=> "White"
        ]
    ));

    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Small', 'ppv'),
            'size' => 16,
            'slug' => 'small'
        ),
        array(
            'name' => __('Medium', 'ppv'),
            'size' => 24,
            'slug' => 'medium'
        ),
        array(
            'name' => __('Large', 'ppv'),
            'size' => 30,
            'slug' => 'large'
        ),
        array(
            'name' => __('Bonkers', 'ppv'),
            'size' => 45,
            'slug' => 'bonkers'
        )
    ));

    register_nav_menus( array(
        'primary_menu' => __( 'Primary Menu', 'ppv' ),
        'footer_menu'  => __( 'Footer Menu', 'ppv' ),
    ) );
}

add_action( 'after_setup_theme', 'pvv_theme_support' );

function pvv_required_plugins() {
    $plugins = explode(",",$_ENV["REQUIRED_PLUGINS"]);
    if ($plugins[0] === "") {
        return;
    }
    $active_plugins = get_option('active_plugins');
    $active_plugins = array_map(function($plugin) {
        return explode("/", $plugin)[0];
    }, $active_plugins);
    $plugins = array_diff($plugins, $active_plugins);
    if (count($plugins) > 0) {
        foreach ($plugins as $plugin) {
            add_action( 'admin_notices', function() use ($plugin) {
                echo "<div class='notice notice-error is-dismissible'><p>This theme uses the plugin «{$plugin}». Please install and activate it.</p></div>";
            });
        }
    }
}

add_action( 'admin_init', 'pvv_required_plugins' );

add_filter("body_class", function($classes) {
    if (has_block("ppv/page-heroine")) {
        $classes[] = "ppv-page-heroine";
    }
    return $classes;
});
