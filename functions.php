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


//jeśli user jest zalogowany pokazują się ceny
if(!is_user_logged_in()){
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    add_filter('woocommerce_get_price_html', 'remove_price');
    function remove_price($price)
    {
        return;
    }
	remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}

//zmiana tekstu przycisku dodaj do koszyka
// Strona pojedynczego produktu

add_filter('woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text');

function woocommerce_custom_single_add_to_cart_text()
{
    return __('Dodaj do zamówienia', 'woocommerce');
}

// Strona sklepu

add_filter('woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text');

function woocommerce_custom_product_add_to_cart_text()
{
    return __('Dodaj do zamówienia', 'woocommerce');
}

// zmiana tekstu przycisku finalnego zamówienia
add_filter('woocommerce_order_button_text', 'woocommerce_zamawiam');

function woocommerce_zamawiam()
{
    return __('Zamawiam', 'woocommerce');
}

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
      'cena_netto_agrosik' => __ ( 'Cena' )
      
    ) );
  }
add_filter ( 'manage_cenniki_posts_columns', 'add_acf_columns' );

function cena_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'cena_netto_agrosik':
        echo get_post_meta ( $post_id, 'cena_netto_agrosik', true );
        break;
      
    }
  }
  add_action ( 'manage_cenniki_posts_custom_column', 'cena_custom_column', 10, 2 );

  /**
 * Hooks into pre_get_posts to re-order our posts.
 */
function wpexplorer_pre_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    $query->set( 'orderby', 'title' );
    $query->set( 'order', 'ASC' );
}
add_filter( 'pre_get_posts', 'wpexplorer_pre_get_posts' );
