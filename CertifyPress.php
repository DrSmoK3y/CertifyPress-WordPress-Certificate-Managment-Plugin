<?php
/*
Plugin Name: CertifyPress
Description: A simple solution for creating, managing, and verifying School/Colleges certificates.
Version: 1.0.0
Author: LM Designers
Author URI: https://lmwebdesigners.com/
Plugin URI: https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: certifypress
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('SC_PLUGIN_PATH', plugin_dir_path(__FILE__)); 
define('SC_PLUGIN_URL', plugin_dir_url(__FILE__)); 

function sc_hide_all_admin_notices() { 
    $screen = get_current_screen(); 
    if ( $screen && strpos( $screen->id, 'sc_' ) !== false ) { 
        remove_all_actions( 'admin_notices' ); 
        remove_all_actions( 'all_admin_notices' ); 
    } 
} 
add_action( 'in_admin_header', 'sc_hide_all_admin_notices', 999 ); 

/* ==========================================================================
   1. CPT and Taxonomies Registration
   ========================================================================== */
function sc_register_post_type_taxonomies() { 
    $labels = array(
        'name' => __('Certificates', 'certifypress'),
        'singular_name' => __('Certificate', 'certifypress'),
        'menu_name' => __('Certificates', 'certifypress')
    ); 
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => false,
        'show_in_menu' => false,
        'rewrite' => array('slug' => 'certificate'),
        'supports' => array('title')
    ); 
    register_post_type('certificate', $args); 

    register_taxonomy('certificate_category', 'certificate', array(
        'hierarchical' => true, 
        'labels' => array('name' => __('Certificate Categories', 'certifypress')), 
        'show_ui' => true, 
        'show_in_menu' => false
    )); 

    register_taxonomy('certificate_tag', 'certificate', array(
        'hierarchical' => false, 
        'labels' => array('name' => __('Certificate Tags', 'certifypress')), 
        'show_ui' => true, 
        'show_in_menu' => false
    )); 
}
add_action('init', 'sc_register_post_type_taxonomies');

/* ==========================================================================
   2. Admin Menu & Page Includes
   ========================================================================== */
function sc_register_admin_menu() { 
    add_menu_page(
        __('Certificates', 'certifypress'), 
        __('Certificates', 'certifypress'), 
        'manage_options', 
        'sc_all_certificates', 
        'sc_all_certificates_page_view', 
        'dashicons-awards', 
        6
    ); 
    add_submenu_page(
        'sc_all_certificates', 
        __('All Certificates', 'certifypress'), 
        __('All Certificates', 'certifypress'), 
        'manage_options', 
        'sc_all_certificates', 
        'sc_all_certificates_page_view'
    ); 
    add_submenu_page(
        'sc_all_certificates', 
        __('Add Certificate', 'certifypress'), 
        __('Add Certificate', 'certifypress'), 
        'manage_options', 
        'sc_add_certificate', 
        'sc_add_certificate_page_view'
    ); 
    add_submenu_page(
        'sc_all_certificates', 
        __('Tags & Categories', 'certifypress'), 
        __('Tags & Categories', 'certifypress'), 
        'manage_options', 
        'sc_tags_categories', 
        'sc_tags_categories_page_view'
    ); 
    add_submenu_page(
        'sc_all_certificates', 
        __('Custom Fields', 'certifypress'), 
        __('Custom Fields', 'certifypress'), 
        'manage_options', 
        'sc_custom_fields', 
        'sc_custom_fields_page_view'
    ); 
    add_submenu_page(
        'sc_all_certificates', 
        __('Search Settings', 'certifypress'), 
        __('Search Settings', 'certifypress'), 
        'manage_options', 
        'sc_search_field', 
        'sc_search_field_page_view'
    ); 
    // PRO feature page link
    add_submenu_page(
        'sc_all_certificates', 
        __('Upgrade to Pro', 'certifypress'), 
        '<span style="color:#ffb900;">' . esc_html__('Upgrade to Pro', 'certifypress') . '</span>', 
        'manage_options', 
        'sc_upgrade_to_pro', 
        'sc_upgrade_to_pro_page_view'
    ); 
}
add_action('admin_menu', 'sc_register_admin_menu');

function sc_all_certificates_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-all-certificates.php'; 
}
function sc_add_certificate_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-add-edit-certificate.php'; 
}
function sc_tags_categories_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-tags-categories.php'; 
}
function sc_custom_fields_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-custom-fields.php'; 
}
function sc_search_field_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-search-field-selection.php'; 
}
function sc_upgrade_to_pro_page_view() { 
    require_once SC_PLUGIN_PATH . 'admin/views/view-upgrade-to-pro.php'; 
}

/* ==========================================================================
   3. Scripts & Styles Enqueue
   ========================================================================== */
function sc_admin_enqueue_scripts( $hook ) { 
    $screen = get_current_screen(); 
    if ( $screen && strpos($screen->id, 'sc_') !== false ) { 
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_media(); 
        wp_enqueue_style('sc-admin-css', SC_PLUGIN_URL . 'assets/css/sc-admin-styles.css', [], '1.0.0'); 
        wp_enqueue_script('sc-admin-js', SC_PLUGIN_URL . 'assets/js/sc-admin.js', ['jquery', 'jquery-ui-sortable'], '1.0.0', true); 
    } 
}
add_action('admin_enqueue_scripts', 'sc_admin_enqueue_scripts');

function sc_enqueue_front_scripts() { 
    wp_enqueue_script('sc-front-js', SC_PLUGIN_URL . 'assets/js/sc-front.js', ['jquery'], '1.0', true); 
    wp_localize_script('sc-front-js', 'sc_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sc_ajax_nonce'),
        'plugin_url' => SC_PLUGIN_URL
    )); 
    wp_enqueue_style('sc-front-css', SC_PLUGIN_URL . 'assets/css/sc-front.css', [], '1.0'); 
}
add_action('wp_enqueue_scripts', 'sc_enqueue_front_scripts');

/* ==========================================================================
   4. Form & Data Processing
   ========================================================================== */
function sc_process_certificate_deletion() {
    $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $cert_id = filter_input( INPUT_GET, 'certificate_id', FILTER_VALIDATE_INT );
    $nonce = filter_input( INPUT_GET, '_wpnonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

    if ( $page === 'sc_all_certificates' && $action === 'delete' && $cert_id && $cert_id > 0 ) {
        if ( $nonce && wp_verify_nonce( $nonce, 'delete_certificate_' . $cert_id ) && current_user_can( 'manage_options' ) ) {
            wp_delete_post( $cert_id, true );
            wp_safe_redirect( admin_url( 'admin.php?page=sc_all_certificates&message=deleted' ) );
            exit;
        }
    }
}
add_action('admin_init', 'sc_process_certificate_deletion');

function sc_process_custom_field_deletion() {
    $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    if ( 'sc_custom_fields' !== $page ) {
        return;
    }

    $action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $slug = filter_input( INPUT_GET, 'field_slug', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $nonce = filter_input( INPUT_GET, '_wpnonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

    if ( 'delete_field' === $action && $slug ) {
        if ( $nonce && wp_verify_nonce( $nonce, 'sc_delete_field_' . $slug ) && current_user_can( 'manage_options' ) ) {
            $custom_fields = get_option( 'sc_custom_fields', array() );
            $updated_fields = array_filter( $custom_fields, function( $field ) use ( $slug ) {
                return $field['slug'] !== $slug;
            } );
            update_option( 'sc_custom_fields', array_values( $updated_fields ) );
            wp_safe_redirect( admin_url( 'admin.php?page=sc_custom_fields&message=deleted' ) );
            exit;
        }
    }
}
add_action('admin_init', 'sc_process_custom_field_deletion');

function sc_process_add_edit_certificate() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'sc_certificate_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'sc_save_certificate' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'certifypress' ) );
        }

        $certificate_id = filter_input( INPUT_POST, 'certificate_id', FILTER_VALIDATE_INT );
        $editing = ( $certificate_id && $certificate_id > 0 );

        $post_data = filter_input_array( INPUT_POST, FILTER_UNSAFE_RAW );
        $post_status = isset( $post_data['save_as_draft'] ) ? 'draft' : 'publish';
        $title = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'certificate_title', FILTER_UNSAFE_RAW ) ?? '' ) );

        $certificate_data = array(
            'post_title'  => $title,
            'post_type'   => 'certificate',
            'post_status' => $post_status
        );

        if ( $editing ) {
            $certificate_data['ID'] = $certificate_id;
            $cert_id = wp_update_post( $certificate_data, true );
        } else {
            $cert_id = wp_insert_post( $certificate_data, true );
        }

        if ( ! is_wp_error( $cert_id ) && $cert_id > 0 ) {
            $custom_fields = get_option( 'sc_custom_fields', array() );
            $all_post_data = filter_input_array( INPUT_POST, FILTER_UNSAFE_RAW );
            foreach ( $custom_fields as $field ) {
                if ( isset( $all_post_data[ $field['slug'] ] ) ) {
                    update_post_meta( $cert_id, $field['slug'], sanitize_text_field( wp_unslash( $all_post_data[ $field['slug'] ] ) ) );
                }
            }

            $categories_raw = filter_input( INPUT_POST, 'certificate_categories', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
            $categories = is_array( $categories_raw ) ? array_map( 'intval', wp_unslash( $categories_raw ) ) : array();
            wp_set_object_terms( $cert_id, $categories, 'certificate_category' );

            $tags_raw = filter_input( INPUT_POST, 'certificate_tags', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
            $tags = is_array( $tags_raw ) ? array_map( 'intval', wp_unslash( $tags_raw ) ) : array();
            wp_set_object_terms( $cert_id, $tags, 'certificate_tag' );

            wp_safe_redirect( admin_url( 'admin.php?page=sc_all_certificates&message=saved' ) );
            exit;
        } else {
            wp_die( esc_html__( 'There was an error saving the certificate.', 'certifypress' ) );
        }
    }
}
add_action('admin_post_sc_process_add_edit_certificate', 'sc_process_add_edit_certificate');

function sc_process_custom_field_form() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'sc_field_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'sc_save_field' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'certifypress' ) );
        }

        $action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $custom_fields = get_option( 'sc_custom_fields', array() );

        if ( 'add_field' === $action ) {
            $field_name = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'field_name', FILTER_UNSAFE_RAW ) ?? '' ) );
            $field_slug = sanitize_title( wp_unslash( filter_input( INPUT_POST, 'field_slug', FILTER_UNSAFE_RAW ) ?? '' ) );
            $field_type = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'field_type', FILTER_UNSAFE_RAW ) ?? '' ) );

            if ( empty( $field_slug ) ) {
                wp_safe_redirect( admin_url( 'admin.php?page=sc_custom_fields&message=error_duplicate' ) );
                exit;
            }

            foreach ( $custom_fields as $field ) {
                if ( $field['slug'] === $field_slug ) {
                    wp_safe_redirect( admin_url( 'admin.php?page=sc_custom_fields&message=error_duplicate' ) );
                    exit;
                }
            }

            $custom_fields[] = array(
                'name' => $field_name,
                'slug' => $field_slug,
                'type' => $field_type
            );
            update_option( 'sc_custom_fields', $custom_fields );
            wp_safe_redirect( admin_url( 'admin.php?page=sc_custom_fields&message=added' ) );
            exit;

        } elseif ( 'save_field_order' === $action ) {
            $ordered_slugs_raw = filter_input( INPUT_POST, 'field_order', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
            $ordered_slugs = is_array( $ordered_slugs_raw ) ? array_map( 'sanitize_text_field', wp_unslash( $ordered_slugs_raw ) ) : array();
            $new_order_fields = array();
            $fields_by_slug = array_column( $custom_fields, null, 'slug' );
            foreach ( $ordered_slugs as $slug ) {
                if ( isset( $fields_by_slug[ $slug ] ) ) {
                    $new_order_fields[] = $fields_by_slug[ $slug ];
                }
            }
            update_option( 'sc_custom_fields', $new_order_fields );
            wp_safe_redirect( admin_url( 'admin.php?page=sc_custom_fields&message=order_saved' ) );
            exit;
        }
    }
}
add_action('admin_post_add_field', 'sc_process_custom_field_form'); 
add_action('admin_post_save_field_order', 'sc_process_custom_field_form');

function sc_process_search_settings_form() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'sc_search_field_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'sc_save_search_field' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'certifypress' ) );
        }

        $search_fields  = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'search_fields', FILTER_UNSAFE_RAW ) ?? '' ) );
        $search_label   = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'search_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $category_label = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'category_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $tag_label      = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'tag_label', FILTER_UNSAFE_RAW ) ?? '' ) );

        update_option( 'sc_search_fields', $search_fields );
        update_option( 'sc_search_label', $search_label );
        update_option( 'sc_category_label', $category_label );
        update_option( 'sc_tag_label', $tag_label );

        wp_safe_redirect( admin_url( 'admin.php?page=sc_search_field&message=saved' ) );
        exit;
    }
}
add_action('admin_post_sc_process_search_settings_form', 'sc_process_search_settings_form');

/* ==========================================================================
   5. Ajax Search Handler
   ========================================================================== */
function sc_ajax_search() {
    check_ajax_referer( 'sc_ajax_nonce', 'nonce' );

    $search_query = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'search_query', FILTER_UNSAFE_RAW ) ?? '' ) );
    $category     = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'category', FILTER_UNSAFE_RAW ) ?? '' ) );
    $tag          = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'tag', FILTER_UNSAFE_RAW ) ?? '' ) );
    $search_fields = array_map( 'trim', explode( ',', get_option( 'sc_search_fields', '' ) ) ); 

    $args = array( 
        'post_type' => 'certificate', 
        'post_status' => 'publish', 
        'posts_per_page' => -1 
    );

    if (!empty($search_query) && !empty($search_fields) && !empty($search_fields[0])) { 
        $meta_query = array('relation' => 'OR');
        foreach ($search_fields as $field_slug) { 
            $meta_query[] = array(
                'key' => $field_slug, 
                'value' => $search_query, 
                'compare' => '='
            ); 
        }
        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Required for certificate search
        $args['meta_query'] = $meta_query;
    }

    if (!empty($category) || !empty($tag)) {
        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Required for category/tag filtering
        $args['tax_query'] = array('relation' => 'AND');
        if (!empty($category)) { 
            $args['tax_query'][] = array(
                'taxonomy' => 'certificate_category', 
                'field' => 'slug', 
                'terms' => $category
            ); 
        }
        if (!empty($tag)) { 
            $args['tax_query'][] = array(
                'taxonomy' => 'certificate_tag', 
                'field' => 'slug', 
                'terms' => $tag
            ); 
        }
    }

    $query = new WP_Query($args); 
    $results = array(); 

    if ($query->have_posts()) { 
        while ($query->have_posts()) { 
            $query->the_post(); 
            $cert_id = get_the_ID(); 

            ob_start(); 
            $custom_fields = get_option('sc_custom_fields', array());
            ?> 
            <table class="sc-cert-table">
                <thead><tr><th colspan="2"><?php echo esc_html(get_the_title()); ?></th></tr></thead>
                <tbody><?php foreach ($custom_fields as $field) : $value = get_post_meta($cert_id, $field['slug'], true); if (!empty($value)) : ?>
                    <tr>
                        <td><?php echo esc_html($field['name']); ?></td>
                        <td><?php if ($field['type'] == 'image') { echo '<img src="' . esc_url($value) . '" style="max-width:150px; height:auto;" alt="' . esc_attr($field['name']) . '"/>'; } elseif ($field['type'] == 'url') { echo '<a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('Visit Link', 'certifypress') . '</a>'; } elseif ($field['type'] == 'file') { echo '<a href="' . esc_url($value) . '" class="sc-download-btn" download>' . esc_html__('Download File', 'certifypress') . '</a>'; } else { echo esc_html($value); } ?></td>
                    </tr>
                <?php endif; endforeach; ?></tbody>
            </table>
            <?php 
            $results[] = ob_get_clean(); 
        } 
        wp_reset_postdata(); 
    } 
    wp_send_json_success( $results ); 
} 
add_action('wp_ajax_sc_ajax_search', 'sc_ajax_search'); 
add_action('wp_ajax_nopriv_sc_ajax_search', 'sc_ajax_search');

/* ==========================================================================
   6. Shortcodes
   ========================================================================== */
function sc_search_shortcode( $atts ) { 
    $search_label = get_option('sc_search_label', __('Search Certificate', 'certifypress')); 
    ob_start(); 
    ?> 
    <div id="sc-search-form" class="sc-search-form">
        <div class="sc-search-input-group">
            <label for="sc-search-query"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="sc-search-query" placeholder="<?php echo esc_attr__('Enter search term...', 'certifypress'); ?>">
        </div>
        <div class="sc-search-btn-group">
            <button id="sc-search-btn"><?php echo esc_html__('Search', 'certifypress'); ?></button>
            <button id="sc-print-btn"><?php echo esc_html__('Print Results', 'certifypress'); ?></button>
        </div>
        <div id="sc-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('certificate_search', 'sc_search_shortcode');

function sc_search_categories_shortcode( $atts ) { 
    $search_label = get_option('sc_search_label', __('Search Certificate', 'certifypress')); 
    $category_label = get_option('sc_category_label', __('Category', 'certifypress')); 
    $categories = get_terms(array('taxonomy' => 'certificate_category', 'hide_empty' => false)); 
    ob_start(); 
    ?> 
    <div id="sc-search-form" class="sc-search-form">
        <div class="sc-search-input-group">
            <label for="sc-search-query"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="sc-search-query" placeholder="<?php echo esc_attr__('Enter search term...', 'certifypress'); ?>">
        </div>
        <div class="sc-search-select-group">
            <div class="sc-select">
                <label for="sc-category-selector"><?php echo esc_html($category_label); ?></label>
                <select id="sc-category-selector">
                    <option value=""><?php echo esc_html($category_label); ?></option>
                    <?php foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } ?>
                </select>
            </div>
        </div>
        <div class="sc-search-btn-group">
            <button id="sc-search-btn"><?php echo esc_html__('Search', 'certifypress'); ?></button>
            <button id="sc-print-btn"><?php echo esc_html__('Print Results', 'certifypress'); ?></button>
        </div>
        <div id="sc-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('certificate_search_categories', 'sc_search_categories_shortcode');

function sc_search_tags_categories_shortcode( $atts ) { 
    $search_label = get_option('sc_search_label', __('Search Certificate', 'certifypress')); 
    $category_label = get_option('sc_category_label', __('Category', 'certifypress')); 
    $tag_label = get_option('sc_tag_label', __('Tag', 'certifypress')); 
    $categories = get_terms(array('taxonomy' => 'certificate_category', 'hide_empty' => false)); 
    $tags = get_terms(array('taxonomy' => 'certificate_tag', 'hide_empty' => false)); 
    ob_start(); 
    ?> 
    <div id="sc-search-form" class="sc-search-form">
        <div class="sc-search-input-group">
            <label for="sc-search-query"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="sc-search-query" placeholder="<?php echo esc_attr__('Enter search term...', 'certifypress'); ?>">
        </div>
        <div class="sc-search-select-group">
            <div class="sc-select">
                <label for="sc-category-selector"><?php echo esc_html($category_label); ?></label>
                <select id="sc-category-selector">
                    <option value=""><?php echo esc_html($category_label); ?></option>
                    <?php foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } ?>
                </select>
            </div>
            <div class="sc-select">
                <label for="sc-tag-selector"><?php echo esc_html($tag_label); ?></label>
                <select id="sc-tag-selector">
                    <option value=""><?php echo esc_html($tag_label); ?></option>
                    <?php foreach ($tags as $tag) { echo '<option value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</option>'; } ?>
                </select>
            </div>
        </div>
        <div class="sc-search-btn-group">
            <button id="sc-search-btn"><?php echo esc_html__('Search', 'certifypress'); ?></button>
            <button id="sc-print-btn"><?php echo esc_html__('Print Results', 'certifypress'); ?></button>
        </div>
        <div id="sc-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('certificate_search_tags_categories', 'sc_search_tags_categories_shortcode');
