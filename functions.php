<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('kadence-global', 'kadence-header', 'kadence-content', 'kadence-woocommerce', 'kadence-footer'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION

/* New Custom Post Type in WP */

function cenniki_cpt()
{
    $labels = array(
        'name'                => __('Cenniki'),
        'singular_name'       => __('Cennik'),
        'menu_name'           => __('Cenniki'),
        'parent_item_colon'   => __('Nadrzędny projekt'),
        'all_items'           => __('Zobacz wszystkie'),
        'view_item'           => __('Zobacz cennik'),
        'add_new_item'        => __('Dodaj cennik'),
        'add_new'             => __('Dodaj nowy'),
        'edit_item'           => __('Edytuj cennik'),
        'update_item'         => __('Zaktualizuj cennik'),
        'search_items'        => __('Szukaj cennik'),
        'not_found'           => __('Nie znaleziono'),
        'not_found_in_trash'  => __('Nie znaleziono')
    );
    $args = array(
        'label'               => __('cenniki'),
        'description'         => __('cenniki'),
        'labels'              => $labels,
        'supports'            => array('title', 'thumbnail', 'revisions', 'custom-fields'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
        'yarpp_support'       => true,
        'taxonomies'           => array('post_tag'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'show_in_rest' => true
    );
    register_post_type('cenniki', $args);
}
add_action('init', 'cenniki_cpt', 0);

//dodanie bootstrapa

function boot_scripts()
{
    wp_enqueue_style('boot_style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
    wp_enqueue_script('boot_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
}

add_action('wp_enqueue_scripts','boot_scripts');

//dodanie nowych kolumn w menu cenniki

/*
 * Add columns to exhibition post list
 */
function add_acf_columns ( $columns ) {
    return array_merge ( $columns, array ( 
      'cena' => __ ( 'Cena' )
      
    ) );
  }
add_filter ( 'manage_cenniki_posts_columns', 'add_acf_columns' );

function cena_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'cena':
        echo get_post_meta ( $post_id, 'cena', true );
        break;
      
    }
  }
  add_action ( 'manage_cenniki_posts_custom_column', 'cena_custom_column', 10, 2 );
