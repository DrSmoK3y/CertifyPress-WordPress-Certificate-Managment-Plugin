<?php
/*
Plugin Name: CertifyPress
Description: A simple solution for creating, managing, and verifying School/Colleges certificates.
Version: 1.0.0
Author: LM Designers
Author URI: https://lmwebdesigners.com/
Plugin URI: https://lmwebdesigners.com/plugin/certifypress-students-certificates-results/
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
    $labels = array('name' => 'Certificates','singular_name' => 'Certificate','menu_name' => 'Certificates'); 
    $args = array('labels' => $labels,'public' => true,'show_ui' => false,'show_in_menu' => false,'rewrite' => array('slug' => 'certificate'),'supports' => array('title'));
    register_post_type('certificate', $args); 
    register_taxonomy('certificate_category', 'certificate', array('hierarchical' => true, 'labels' => array('name' => 'Certificate Categories'), 'show_ui' => true, 'show_in_menu' => false)); 
    register_taxonomy('certificate_tag', 'certificate', array('hierarchical' => false, 'labels' => array('name' => 'Certificate Tags'), 'show_ui' => true, 'show_in_menu' => false)); 
}
add_action('init', 'sc_register_post_type_taxonomies');

/* ==========================================================================
   2. Admin Menu & Page Includes
   ========================================================================== */
function sc_register_admin_menu() { 
    add_menu_page('Certificates', 'Certificates', 'manage_options', 'sc_all_certificates', 'sc_all_certificates_page_view', 'dashicons-awards', 6); 
    add_submenu_page('sc_all_certificates', 'All Certificates', 'All Certificates', 'manage_options', 'sc_all_certificates', 'sc_all_certificates_page_view'); 
    add_submenu_page('sc_all_certificates', 'Add Certificate', 'Add Certificate', 'manage_options', 'sc_add_certificate', 'sc_add_certificate_page_view'); 
    add_submenu_page('sc_all_certificates', 'Tags & Categories', 'Tags & Categories', 'manage_options', 'sc_tags_categories', 'sc_tags_categories_page_view'); 
    add_submenu_page('sc_all_certificates', 'Custom Fields', 'Custom Fields', 'manage_options', 'sc_custom_fields', 'sc_custom_fields_page_view'); 
    add_submenu_page('sc_all_certificates', 'Search Settings', 'Search Settings', 'manage_options', 'sc_search_field', 'sc_search_field_page_view'); 
    // PRO feature page link
    add_submenu_page('sc_all_certificates', 'Upgrade to Pro', '<span style="color:#ffb900;">Upgrade to Pro</span>', 'manage_options', 'sc_upgrade_to_pro', 'sc_upgrade_to_pro_page_view'); 
}
add_action('admin_menu', 'sc_register_admin_menu');
function sc_all_certificates_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-all-certificates.php'; }
function sc_add_certificate_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-add-edit-certificate.php'; }
function sc_tags_categories_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-tags-categories.php'; }
function sc_custom_fields_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-custom-fields.php'; }
function sc_search_field_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-search-field-selection.php'; }
function sc_upgrade_to_pro_page_view() { require_once SC_PLUGIN_PATH . 'admin/views/view-upgrade-to-pro.php'; }

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
    wp_localize_script('sc-front-js', 'sc_ajax_obj', ['ajax_url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('sc_ajax_nonce')]); 
    wp_enqueue_style('sc-front-css', SC_PLUGIN_URL . 'assets/css/sc-front.css', [], '1.0'); 
}
add_action('wp_enqueue_scripts', 'sc_enqueue_front_scripts');

/* ==========================================================================
   4. Form & Data Processing
   ========================================================================== */
function sc_process_certificate_deletion() { 
    if ( isset($_GET['page']) && $_GET['page'] == 'sc_all_certificates' && isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['certificate_id']) ) { 
        $cert_id = intval($_GET['certificate_id']); 
        if ( isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'delete_certificate_' . $cert_id) && current_user_can('manage_options') ) { 
            wp_delete_post($cert_id, true); 
            wp_safe_redirect(admin_url('admin.php?page=sc_all_certificates&message=deleted')); 
            exit; 
        } 
    } 
}
add_action('admin_init', 'sc_process_certificate_deletion');

function sc_process_custom_field_deletion() { 
    if ( !isset($_GET['page']) || 'sc_custom_fields' !== $_GET['page'] ) { return; } 
    if ( isset($_GET['action']) && 'delete_field' === $_GET['action'] ) { 
        $slug = sanitize_text_field( $_GET['field_slug'] ); 
        if ( isset( $_GET['_wpnonce']) && wp_verify_nonce( $_GET['_wpnonce'], 'sc_delete_field_' . $slug ) && current_user_can('manage_options') ) { 
            $custom_fields = get_option('sc_custom_fields', array()); 
            $updated_fields = array_filter($custom_fields, function($field) use ($slug) {
                return $field['slug'] !== $slug;
            });
            update_option('sc_custom_fields', $updated_fields); 
            wp_safe_redirect(admin_url('admin.php?page=sc_custom_fields&message=deleted')); 
            exit; 
        } 
    } 
}
add_action('admin_init', 'sc_process_custom_field_deletion');

function sc_process_add_edit_certificate() { 
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sc_certificate_nonce']) && current_user_can('manage_options') ) { 
        if ( !wp_verify_nonce($_POST['sc_certificate_nonce'], 'sc_save_certificate') ) { 
            wp_die('Nonce verification failed.'); 
        } 
        $editing = isset($_POST['certificate_id']) && intval($_POST['certificate_id']) > 0; 
        $certificate_id = $editing ? intval($_POST['certificate_id']) : 0; 

        $post_status = isset($_POST['save_as_draft']) ? 'draft' : 'publish';
        $title = sanitize_text_field($_POST['certificate_title']); 
        $certificate_data = array('post_title' => $title, 'post_type' => 'certificate', 'post_status' => $post_status); 

        if ($editing) { 
            $certificate_data['ID'] = $certificate_id; 
            $cert_id = wp_update_post($certificate_data, true); 
        } else { 
            $cert_id = wp_insert_post($certificate_data, true); 
        } 

        if (!is_wp_error($cert_id) && $cert_id > 0) { 
            $custom_fields = get_option('sc_custom_fields', array()); 
            foreach ($custom_fields as $field) { 
                if (isset($_POST[$field['slug']])) { 
                    update_post_meta($cert_id, $field['slug'], sanitize_text_field($_POST[$field['slug']])); 
                } 
            }
            wp_set_object_terms($cert_id, (isset($_POST['certificate_categories']) ? array_map('intval', $_POST['certificate_categories']) : []), 'certificate_category');
            wp_set_object_terms($cert_id, (isset($_POST['certificate_tags']) ? array_map('intval', $_POST['certificate_tags']) : []), 'certificate_tag');
            wp_safe_redirect(admin_url('admin.php?page=sc_all_certificates&message=saved')); 
            exit; 
        } else {
             wp_die('There was an error saving the certificate.');
        }
    } 
}
add_action('admin_post_sc_process_add_edit_certificate', 'sc_process_add_edit_certificate');

function sc_process_custom_field_form() { 
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sc_field_nonce']) && current_user_can('manage_options') ) { 
        if ( !wp_verify_nonce($_POST['sc_field_nonce'], 'sc_save_field') ) { wp_die('Nonce verification failed.'); } 
        $action = isset($_POST['action']) ? $_POST['action'] : ''; 
        $custom_fields = get_option('sc_custom_fields', array()); 

        if ($action == 'add_field') { 
            $field_name = sanitize_text_field($_POST['field_name']); 
            $field_slug = sanitize_title($_POST['field_slug']); 
            $field_type = sanitize_text_field($_POST['field_type']); 
            foreach ($custom_fields as $field) { 
                if ($field['slug'] === $field_slug) { 
                    wp_safe_redirect(admin_url('admin.php?page=sc_custom_fields&message=error_duplicate')); exit; 
                } 
            } 
            $custom_fields[] = ['name' => $field_name, 'slug' => $field_slug, 'type' => $field_type]; 
            update_option('sc_custom_fields', $custom_fields); 
            wp_safe_redirect(admin_url('admin.php?page=sc_custom_fields&message=added')); exit; 

        } elseif ($action == 'save_field_order') { 
            $ordered_slugs = isset($_POST['field_order']) ? $_POST['field_order'] : []; 
            $new_order_fields = []; 
            $fields_by_slug = array_column($custom_fields, null, 'slug');
            foreach($ordered_slugs as $slug){ 
                if(isset($fields_by_slug[$slug])){ 
                    $new_order_fields[] = $fields_by_slug[$slug]; 
                } 
            } 
            update_option('sc_custom_fields', $new_order_fields); 
            wp_safe_redirect(admin_url('admin.php?page=sc_custom_fields&message=order_saved')); exit; 
        } 
    } 
}
add_action('admin_post_add_field', 'sc_process_custom_field_form'); 
add_action('admin_post_save_field_order', 'sc_process_custom_field_form');

function sc_process_search_settings_form() { 
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sc_search_field_nonce']) && current_user_can('manage_options') ) { 
        if ( !wp_verify_nonce($_POST['sc_search_field_nonce'], 'sc_save_search_field') ) { wp_die('Nonce verification failed.'); } 
        update_option('sc_search_fields', sanitize_text_field($_POST['search_fields'])); 
        update_option('sc_search_label', sanitize_text_field($_POST['search_label'])); 
        update_option('sc_category_label', sanitize_text_field($_POST['category_label'])); 
        update_option('sc_tag_label', sanitize_text_field($_POST['tag_label'])); 
        wp_safe_redirect(admin_url('admin.php?page=sc_search_field&message=saved')); exit; 
    } 
}
add_action('admin_post_sc_process_search_settings_form', 'sc_process_search_settings_form');

/* ==========================================================================
   5. Ajax Search Handler
   ========================================================================== */
function sc_ajax_search() { 
    check_ajax_referer('sc_ajax_nonce', 'nonce'); 
    $search_query = isset($_POST['search_query']) ? sanitize_text_field(trim($_POST['search_query'])) : ''; 
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : ''; 
    $tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : ''; 
    $search_fields = array_map('trim', explode(',', get_option('sc_search_fields', ''))); 
    
    $meta_query = ['relation' => 'OR'];
    if (!empty($search_query) && !empty($search_fields) && !empty($search_fields[0])) { 
        foreach ($search_fields as $field_slug) { 
            $meta_query[] = ['key' => $field_slug, 'value' => $search_query, 'compare' => '=']; 
        } 
    } else {
        $meta_query = [];
    }
    
    $args = [ 'post_type' => 'certificate', 'post_status' => 'publish', 'meta_query' => $meta_query, 'posts_per_page' => -1 ];
    if (!empty($category) || !empty($tag)) {
        $args['tax_query'] = ['relation' => 'AND'];
        if (!empty($category)) { $args['tax_query'][] = ['taxonomy' => 'certificate_category', 'field' => 'slug', 'terms' => $category]; }
        if (!empty($tag)) { $args['tax_query'][] = ['taxonomy' => 'certificate_tag', 'field' => 'slug', 'terms' => $tag]; }
    }
    
    $query = new WP_Query($args); 
    $results = []; 
    
    if ($query->have_posts()) { 
        while ($query->have_posts()) { 
            $query->the_post(); 
            $cert_id = get_the_ID(); 
            
            // Lite version always renders the default table
            ob_start(); 
            $custom_fields = get_option('sc_custom_fields', []);
            ?> 
            <table class="sc-cert-table">
                <thead><tr><th colspan="2"><?php echo get_the_title(); ?></th></tr></thead>
                <tbody><?php foreach ($custom_fields as $field) : $value = get_post_meta($cert_id, $field['slug'], true); if (!empty($value)) : ?>
                    <tr>
                        <td><?php echo esc_html($field['name']); ?></td>
                        <td><?php if ($field['type'] == 'image') { echo '<img src="' . esc_url($value) . '" style="max-width:150px; height:auto;"/>'; } elseif ($field['type'] == 'url') { echo '<a href="' . esc_url($value) . '" target="_blank">Visit Link</a>'; } else { echo esc_html($value); } ?></td>
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
function sc_search_shortcode( $atts ) { $search_label = get_option('sc_search_label', 'Search Certificate'); ob_start(); ?> <div id="sc-search-form" class="sc-search-form"><div class="sc-search-input-group"><label for="sc-search-query"><?php echo esc_html($search_label); ?></label><input type="text" id="sc-search-query" placeholder="Enter search term..."></div><div class="sc-search-btn-group"><button id="sc-search-btn">Search</button><button id="sc-print-btn">Print Results</button></div><div id="sc-search-results"></div></div> <?php return ob_get_clean(); }
add_shortcode('certificate_search', 'sc_search_shortcode');
function sc_search_categories_shortcode( $atts ) { $search_label = get_option('sc_search_label', 'Search Certificate'); $category_label = get_option('sc_category_label', 'Category'); $categories = get_terms(['taxonomy' => 'certificate_category', 'hide_empty' => false]); ob_start(); ?> <div id="sc-search-form" class="sc-search-form"><div class="sc-search-input-group"><label for="sc-search-query"><?php echo esc_html($search_label); ?></label><input type="text" id="sc-search-query" placeholder="Enter search term..."></div><div class="sc-search-select-group"><div class="sc-select"><label for="sc-category-selector"><?php echo esc_html($category_label); ?></label><select id="sc-category-selector"><option value=""><?php echo esc_html($category_label); ?></option><?php foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } ?></select></div></div><div class="sc-search-btn-group"><button id="sc-search-btn">Search</button><button id="sc-print-btn">Print Results</button></div><div id="sc-search-results"></div></div> <?php return ob_get_clean(); }
add_shortcode('certificate_search_categories', 'sc_search_categories_shortcode');
function sc_search_tags_categories_shortcode( $atts ) { $search_label = get_option('sc_search_label', 'Search Certificate'); $category_label = get_option('sc_category_label', 'Category'); $tag_label = get_option('sc_tag_label', 'Tag'); $categories = get_terms(['taxonomy' => 'certificate_category', 'hide_empty' => false]); $tags = get_terms(['taxonomy' => 'certificate_tag', 'hide_empty' => false]); ob_start(); ?> <div id="sc-search-form" class="sc-search-form"><div class="sc-search-input-group"><label for="sc-search-query"><?php echo esc_html($search_label); ?></label><input type="text" id="sc-search-query" placeholder="Enter search term..."></div><div class="sc-search-select-group"><div class="sc-select"><label for="sc-category-selector"><?php echo esc_html($category_label); ?></label><select id="sc-category-selector"><option value=""><?php echo esc_html($category_label); ?></option><?php foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } ?></select></div><div class="sc-select"><label for="sc-tag-selector"><?php echo esc_html($tag_label); ?></label><select id="sc-tag-selector"><option value=""><?php echo esc_html($tag_label); ?></option><?php foreach ($tags as $tag) { echo '<option value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</option>'; } ?></select></div></div><div class="sc-search-btn-group"><button id="sc-search-btn">Search</button><button id="sc-print-btn">Print Results</button></div><div id="sc-search-results"></div></div> <?php return ob_get_clean(); }
add_shortcode('certificate_search_tags_categories', 'sc_search_tags_categories_shortcode');