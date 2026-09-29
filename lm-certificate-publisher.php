<?php
/*
Plugin Name: LM Certificate Publisher
Description: An all-in-one certification and student credentials publishing platform for schools, colleges, training centres, and universities. Easily issue verifiable certificates with instant AJAX search, custom marksheet tables, and 1-click LinkedIn social sharing.
Version: 1.1.1
Author: LM Designers
Author URI: https://lmwebdesigners.com/
Plugin URI: https://lmwebdesigners.com/plugin/lm-certificates-publisher/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: lm-certificate-publisher
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('LMCP_VERSION', '1.1.0');
define('LMCP_PLUGIN_PATH', plugin_dir_path(__FILE__)); 
define('LMCP_PLUGIN_URL', plugin_dir_url(__FILE__)); 

// Load List Table Class in Admin
if (is_admin()) {
    require_once LMCP_PLUGIN_PATH . 'admin/classes/class-certificates-list-table.php';
}

/**
 * Inline SVG Helper Function
 */
function lmcp_icon($name, $size = 16) {
    $icons = array(
        'plus'       => '<path d="M12 5v14M5 12h14"/>',
        'trash'      => '<path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/>',
        'edit'       => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
        'check'      => '<polyline points="20 6 9 17 4 12"/>',
        'sparkles'   => '<path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4M3 5h4M19 17v4M17 19h4"/>',
        'search'     => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
        'palette'    => '<circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2Z"/>',
        'hash'       => '<line x1="4" y1="9" x2="20" y2="9"/><line x1="4" y1="15" x2="20" y2="15"/><line x1="10" y1="3" x2="8" y2="21"/><line x1="16" y1="3" x2="14" y2="21"/>',
        'qrcode'     => '<rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/>',
        'hourglass'  => '<path d="M5 22h14"/><path d="M5 2h14"/><path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22"/><path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"/>',
        'mail'       => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
        'shield'     => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'bolt'       => '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>',
        'tag'        => '<path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><circle cx="7" cy="7" r=".5" fill="currentColor"/>',
        'box'        => '<path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>',
        'cart'       => '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>',
        'folder'     => '<path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 8 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>',
        'file'       => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/>',
        'grid'       => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>',
        'list'       => '<line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>',
        'settings'   => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
        'code'       => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
        'arrow-left' => '<line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>',
        'download'   => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>',
        'cap'        => '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>',
        'lock'       => '<rect x="4.5" y="10.5" width="15" height="10" rx="2"/><path d="M8 10.5V7a4 4 0 0 1 8 0v3.5"/>',
        'globe'      => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
        'share'      => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>',
        'alert'      => '<path d="M12 3.5 22 20.5H2Z"/><path d="M12 10v4.2M12 17.3h.01"/>',
        'plug'       => '<path d="M9 3v5M15 3v5M7 8h10v3.5a5 5 0 0 1-5 5 5 5 0 0 1-5-5Zm5 8.5V21"/>',
        'copy'       => '<rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>',
        'award'      => '<circle cx="12" cy="8" r="6"/><path d="m15.48 13.99-3.48-1.99-3.48 1.99 1.15-4.85-3.87-3.34 5-.43L12 1l1.2 4.37 5 .43-3.87 3.34z"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
        'eye'        => '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>'
    );

    if (isset($icons[$name])) {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="' . intval($size) . '" height="' . intval($size) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $icons[$name] . '</svg>';
    }
    return '';
}

// Add "Upgrade to CertifyPress Pro" action link on plugins page
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lmcp_add_plugin_action_links' );
function lmcp_add_plugin_action_links( $links ) {
    $pro_link = '<a href="https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin" target="_blank" style="font-weight:700; color:#14bda9;">' . esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ) . '</a>';
    array_unshift( $links, $pro_link );
    return $links;
}

function lmcp_hide_all_admin_notices() { 
    $screen = get_current_screen(); 
    if ( $screen && strpos( $screen->id, 'lmcp_' ) !== false ) { 
        remove_all_actions( 'admin_notices' ); 
        remove_all_actions( 'all_admin_notices' ); 
    } 
} 
add_action( 'in_admin_header', 'lmcp_hide_all_admin_notices', 999 ); 

/* ==========================================================================
   1. CPT and Taxonomies Registration
   ========================================================================== */
function lmcp_register_post_type_taxonomies() { 
    $labels = array(
        'name'          => __('Certificates', 'lm-certificate-publisher'),
        'singular_name' => __('Certificate', 'lm-certificate-publisher'),
        'menu_name'     => __('Certificates', 'lm-certificate-publisher')
    ); 
    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'show_ui'      => false,
        'show_in_menu' => false,
        'rewrite'      => array('slug' => 'lmc-certificate'),
        'supports'     => array('title')
    ); 
    register_post_type('lmc_certificate', $args); 

    register_taxonomy('lmc_certificate_category', 'lmc_certificate', array(
        'hierarchical' => true, 
        'labels'       => array('name' => __('Certificate Categories', 'lm-certificate-publisher')), 
        'show_ui'      => true, 
        'show_in_menu' => false
    )); 

    register_taxonomy('lmc_certificate_tag', 'lmc_certificate', array(
        'hierarchical' => false, 
        'labels'       => array('name' => __('Certificate Tags', 'lm-certificate-publisher')), 
        'show_ui'      => true, 
        'show_in_menu' => false
    )); 
}
add_action('init', 'lmcp_register_post_type_taxonomies');

/* ==========================================================================
   1.1 Certificate Privacy, Sitemaps & Anti-Indexing Protection
   ========================================================================== */
if ( ! function_exists( 'lmcp_exclude_certificates_from_wp_sitemaps' ) ) {
    function lmcp_exclude_certificates_from_wp_sitemaps( $post_types ) {
        if ( get_option( 'lmcp_disable_certificate_sitemap', 'yes' ) === 'yes' ) {
            if ( isset( $post_types['lmc_certificate'] ) ) {
                unset( $post_types['lmc_certificate'] );
            }
        }
        return $post_types;
    }
    add_filter( 'wp_sitemaps_post_types', 'lmcp_exclude_certificates_from_wp_sitemaps', 99 );
}

if ( ! function_exists( 'lmcp_exclude_cert_taxonomies_from_wp_sitemaps' ) ) {
    function lmcp_exclude_cert_taxonomies_from_wp_sitemaps( $taxonomies ) {
        if ( get_option( 'lmcp_disable_certificate_sitemap', 'yes' ) === 'yes' ) {
            unset( $taxonomies['lmc_certificate_category'] );
            unset( $taxonomies['lmc_certificate_tag'] );
        }
        return $taxonomies;
    }
    add_filter( 'wp_sitemaps_taxonomies', 'lmcp_exclude_cert_taxonomies_from_wp_sitemaps', 99 );
}

if ( ! function_exists( 'lmcp_is_certificate_specific_request' ) ) {
    function lmcp_is_certificate_specific_request() {
        if ( is_admin() || is_front_page() || is_home() || is_page() ) {
            return false;
        }
        if ( is_singular( 'lmc_certificate' ) || is_tax( 'lmc_certificate_category' ) || is_tax( 'lmc_certificate_tag' ) || isset( $_GET['lmcp_pdf'] ) ) {
            return true;
        }
        return false;
    }
}

if ( ! function_exists( 'lmcp_certificate_wp_robots_filter' ) ) {
    function lmcp_certificate_wp_robots_filter( array $robots ) {
        if ( get_option( 'lmcp_noindex_certificates', 'yes' ) === 'yes' && lmcp_is_certificate_specific_request() ) {
            $robots['noindex']   = true;
            $robots['nofollow']  = true;
            $robots['noarchive'] = true;
        }
        return $robots;
    }
    add_filter( 'wp_robots', 'lmcp_certificate_wp_robots_filter', 999 );
}

if ( ! function_exists( 'lmcp_certificate_noindex_head_tag' ) ) {
    function lmcp_certificate_noindex_head_tag() {
        if ( get_option( 'lmcp_noindex_certificates', 'yes' ) === 'yes' && lmcp_is_certificate_specific_request() ) {
            echo "\n<!-- CertifyPress Certificate Privacy Protection (Does NOT affect regular pages) -->\n";
            echo "<meta name=\"robots\" content=\"noindex, nofollow, noarchive, nosnippet\" />\n";
            echo "<!-- /CertifyPress Certificate Privacy Protection -->\n";
        }
    }
    add_action( 'wp_head', 'lmcp_certificate_noindex_head_tag', 1 );
}

if ( ! function_exists( 'lmcp_restrict_direct_certificate_access' ) ) {
    function lmcp_restrict_direct_certificate_access() {
        if ( ! is_admin() && is_singular( 'lmc_certificate' ) && get_option( 'lmcp_restrict_direct_cert_access', 'no' ) === 'yes' ) {
            wp_safe_redirect( home_url( '/' ) );
            exit;
        }
    }
    add_action( 'template_redirect', 'lmcp_restrict_direct_certificate_access' );
}

/* ==========================================================================
   1.2 Frontend Text & Labels Helper
   ========================================================================== */
if ( ! function_exists( 'lmcp_get_label' ) ) {
    function lmcp_get_label( $key, $default = '' ) {
        $val = get_option( $key, null );
        if ( $val !== null && $val !== '' ) {
            return $val;
        }

        // Direct mapping fallbacks to prevent conflict with Search Settings page
        if ( $key === 'lmcp_label_search_field' ) {
            $search_opt = get_option( 'lmcp_search_input_label', get_option( 'lmcp_search_label', '' ) );
            if ( ! empty( $search_opt ) ) return $search_opt;
        } elseif ( $key === 'lmcp_label_category_field' ) {
            $cat_opt = get_option( 'lmcp_search_category_label', get_option( 'lmcp_category_label', '' ) );
            if ( ! empty( $cat_opt ) ) return $cat_opt;
        } elseif ( $key === 'lmcp_label_tag_field' ) {
            $tag_opt = get_option( 'lmcp_search_tag_label', get_option( 'lmcp_tag_label', '' ) );
            if ( ! empty( $tag_opt ) ) return $tag_opt;
        }

        return $default;
    }
}

/* ==========================================================================
   1.3 Social Sharing & LinkedIn "Add to Profile" System
   ========================================================================== */
if ( ! function_exists( 'lmcp_get_linkedin_add_cert_url' ) ) {
    function lmcp_get_linkedin_add_cert_url( $post_id ) {
        $cert = get_post( $post_id );
        if ( ! $cert ) return '#';

        $cert_title = get_the_title( $post_id );
        $org_name   = get_option( 'lmcp_social_linkedin_org_name', '' );
        if ( empty( $org_name ) ) {
            $org_name = get_bloginfo( 'name' );
        }
        $serial = get_post_meta( $post_id, 'lmcp_unique_code', true );
        if ( empty( $serial ) ) {
            $serial = strtoupper( substr( md5( 'cert_' . $post_id ), 0, 8 ) );
            update_post_meta( $post_id, 'lmcp_unique_code', $serial );
        }

        $post_date = $cert->post_date;
        $issue_year = date( 'Y', strtotime( $post_date ) );
        $issue_month = date( 'n', strtotime( $post_date ) );

        $cert_url = add_query_arg( 'lmcp_verify', $serial, home_url( '/' ) );

        $params = array(
            'startTask'        => 'CERTIFICATION_NAME',
            'name'             => $cert_title,
            'organizationName' => $org_name,
            'issueYear'        => $issue_year,
            'issueMonth'       => $issue_month,
            'certUrl'          => $cert_url,
            'certId'           => $serial,
        );

        return 'https://www.linkedin.com/profile/add?' . http_build_query( $params );
    }
}

if ( ! function_exists( 'lmcp_render_social_share_bar' ) ) {
    function lmcp_render_social_share_bar( $post_id ) {
        if ( get_option( 'lmcp_enable_social_sharing', 'yes' ) !== 'yes' ) {
            return '';
        }

        $unique_code = get_post_meta( $post_id, 'lmcp_unique_code', true );
        if ( empty( $unique_code ) ) {
            $unique_code = strtoupper( substr( md5( 'cert_' . $post_id ), 0, 8 ) );
            update_post_meta( $post_id, 'lmcp_unique_code', $unique_code );
        }
        $cert_url    = add_query_arg( 'lmcp_verify', $unique_code, home_url( '/' ) );
        $title       = get_the_title( $post_id );
        $site_name   = get_bloginfo( 'name' );

        $linkedin_url = lmcp_get_linkedin_add_cert_url( $post_id );
        
        $custom_template = get_option( 'lmcp_social_share_template', '' );
        if ( ! empty( $custom_template ) ) {
            $share_text = str_replace(
                array( '{certificate_title}', '{site_name}' ),
                array( $title, $site_name ),
                $custom_template
            );
        } else {
            $share_text = sprintf( __( 'I am excited to share my official certificate for "%1$s" issued by %2$s! Verify here:', 'lm-certificate-publisher' ), $title, $site_name );
        }
        
        $wa_url       = 'https://api.whatsapp.com/send?text=' . rawurlencode( $share_text . ' ' . $cert_url );
        $tw_url       = 'https://twitter.com/intent/tweet?text=' . rawurlencode( $share_text ) . '&url=' . rawurlencode( $cert_url );
        $fb_url       = 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $cert_url );

        $show_linkedin = get_option( 'lmcp_social_share_linkedin', 'yes' ) === 'yes';
        $show_wa       = get_option( 'lmcp_social_share_whatsapp', 'yes' ) === 'yes';
        $show_x        = get_option( 'lmcp_social_share_x', 'yes' ) === 'yes';
        $show_fb       = get_option( 'lmcp_social_share_facebook', 'yes' ) === 'yes';
        $show_copylink = get_option( 'lmcp_social_share_copylink', 'yes' ) === 'yes';

        if ( ! $show_linkedin && ! $show_wa && ! $show_x && ! $show_fb && ! $show_copylink ) {
            return '';
        }

        $share_heading  = lmcp_get_label( 'lmcp_label_share_heading', __( 'Share & Add to Profile', 'lm-certificate-publisher' ) );
        $linkedin_label = lmcp_get_label( 'lmcp_label_share_linkedin', __( 'Add to LinkedIn', 'lm-certificate-publisher' ) );
        $copylink_label = lmcp_get_label( 'lmcp_label_share_copy_link', __( 'Copy Link', 'lm-certificate-publisher' ) );

        ob_start();
        ?>
        <div class="lmcp-social-share-wrap" style="margin: 18px 0 10px 0; padding: 14px 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; text-align: center; box-sizing: border-box;">
            <div style="font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                <?php echo esc_html( $share_heading ); ?>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; align-items: center;">
                
                <?php if ( $show_linkedin ) : ?>
                <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener noreferrer" class="lmcp-share-btn lmcp-share-linkedin" style="display: inline-flex; align-items: center; gap: 6px; background: #0a66c2; color: #ffffff !important; text-decoration: none; padding: 7px 13px; border-radius: 6px; font-size: 12px; font-weight: 600; box-shadow: 0 1px 3px rgba(10, 102, 194, 0.2);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                    <?php echo esc_html( $linkedin_label ); ?>
                </a>
                <?php endif; ?>

                <?php if ( $show_wa ) : ?>
                <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="lmcp-share-btn lmcp-share-wa" style="display: inline-flex; align-items: center; gap: 6px; background: #25d366; color: #ffffff !important; text-decoration: none; padding: 7px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2m.01 1.67c4.54 0 8.24 3.7 8.24 8.24 0 2.2-.86 4.28-2.42 5.84-1.56 1.56-3.64 2.42-5.84 2.42-1.44 0-2.86-.38-4.12-1.11l-.3-.17-3.12.82.83-3.04-.19-.31a8.19 8.19 0 0 1-1.26-4.45c0-4.54 3.7-8.24 8.24-8.24m4.52 11.66c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.25-.75-.67-1.26-1.5-1.41-1.75-.15-.25-.02-.39.11-.51.11-.11.25-.29.38-.44.12-.14.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1 0 1.24.9 2.44 1.03 2.61.13.17 1.78 2.72 4.31 3.81.6.26 1.07.42 1.44.54.61.19 1.16.17 1.6.1.49-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.06-.1-.23-.17-.48-.3z"/></svg>
                    <?php esc_html_e( 'WhatsApp', 'lm-certificate-publisher' ); ?>
                </a>
                <?php endif; ?>

                <?php if ( $show_x ) : ?>
                <a href="<?php echo esc_url( $tw_url ); ?>" target="_blank" rel="noopener noreferrer" class="lmcp-share-btn lmcp-share-x" style="display: inline-flex; align-items: center; gap: 6px; background: #0f172a; color: #ffffff !important; text-decoration: none; padding: 7px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    <?php esc_html_e( 'Share', 'lm-certificate-publisher' ); ?>
                </a>
                <?php endif; ?>

                <?php if ( $show_fb ) : ?>
                <a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener noreferrer" class="lmcp-share-btn lmcp-share-fb" style="display: inline-flex; align-items: center; gap: 6px; background: #1877f2; color: #ffffff !important; text-decoration: none; padding: 7px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    <?php esc_html_e( 'Facebook', 'lm-certificate-publisher' ); ?>
                </a>
                <?php endif; ?>

                <?php if ( $show_copylink ) : ?>
                <button type="button" class="lmcp-copy-link-btn" data-url="<?php echo esc_url( $cert_url ); ?>" style="display: inline-flex; align-items: center; gap: 5px; background: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    <span class="lmcp-copy-btn-text"><?php echo esc_html( $copylink_label ); ?></span>
                </button>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

/* ==========================================================================
   2. Admin Menu Registration (Menu Rank = 2)
   ========================================================================== */
function lmcp_register_admin_menu() { 
    $menu_name = get_option('lmcp_admin_menu_name', __('Certificates', 'lm-certificate-publisher'));
    if (empty($menu_name)) {
        $menu_name = __('Certificates', 'lm-certificate-publisher');
    }

    add_menu_page(
        $menu_name, 
        $menu_name, 
        'manage_options', 
        'lmcp_all_certificates', 
        'lmcp_all_certificates_page_view', 
        'dashicons-awards', 
        2 // Rank 2 as requested
    ); 
    add_submenu_page(
        'lmcp_all_certificates', 
        __('All Certificates', 'lm-certificate-publisher'), 
        __('All Certificates', 'lm-certificate-publisher'), 
        'manage_options', 
        'lmcp_all_certificates', 
        'lmcp_all_certificates_page_view'
    ); 
    add_submenu_page(
        'lmcp_all_certificates', 
        __('Add Certificate', 'lm-certificate-publisher'), 
        __('Add Certificate', 'lm-certificate-publisher'), 
        'manage_options', 
        'lmcp_add_certificate', 
        'lmcp_add_certificate_page_view'
    ); 
    add_submenu_page(
        'lmcp_all_certificates', 
        __('Tags & Categories', 'lm-certificate-publisher'), 
        __('Tags & Categories', 'lm-certificate-publisher'), 
        'manage_options', 
        'lmcp_tags_categories', 
        'lmcp_tags_categories_page_view'
    ); 
    add_submenu_page(
        'lmcp_all_certificates', 
        __('Custom Fields', 'lm-certificate-publisher'), 
        __('Custom Fields', 'lm-certificate-publisher'), 
        'manage_options', 
        'lmcp_custom_fields', 
        'lmcp_custom_fields_page_view'
    ); 
    add_submenu_page(
        'lmcp_all_certificates', 
        __('Settings', 'lm-certificate-publisher'), 
        __('Settings', 'lm-certificate-publisher'), 
        'manage_options', 
        'lmcp_search_field', 
        'lmcp_search_field_page_view'
    ); 
}
add_action('admin_menu', 'lmcp_register_admin_menu');

function lmcp_all_certificates_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-all-certificates.php'; 
}
function lmcp_bulk_operations_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-bulk-operations.php'; 
}
function lmcp_add_certificate_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-add-edit-certificate.php'; 
}
function lmcp_tags_categories_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-tags-categories.php'; 
}
function lmcp_custom_fields_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-custom-fields.php'; 
}
function lmcp_search_field_page_view() { 
    require_once LMCP_PLUGIN_PATH . 'admin/views/view-search-field-selection.php'; 
}

/* ==========================================================================
   3. Scripts & Styles Enqueue
   ========================================================================== */
function lmcp_admin_enqueue_scripts( $hook ) { 
    $screen = get_current_screen(); 
    if ( $screen && strpos($screen->id, 'lmcp_') !== false ) { 
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_media(); 
        wp_enqueue_style('lmcp-admin-css', LMCP_PLUGIN_URL . 'assets/css/lmcp-admin-styles.css', [], LMCP_VERSION); 

        // Whitelabel color override
        $primary_color = get_option('lmcp_admin_primary_color', '#14bda9');
        if (empty($primary_color)) {
            $primary_color = '#14bda9';
        }
        $dynamic_css = ":root { --lmcp-primary-color: " . esc_attr($primary_color) . "; --lmcp-primary-hover: " . esc_attr($primary_color) . "; }";
        wp_add_inline_style('lmcp-admin-css', $dynamic_css);

        wp_enqueue_script('lmcp-admin-js', LMCP_PLUGIN_URL . 'assets/js/lmcp-admin.js', ['jquery', 'jquery-ui-sortable'], LMCP_VERSION, true); 

        $logo_url = get_option('lmcp_admin_logo', '');
        $remove_credits = get_option('lmcp_whitelabel_remove_credits', 'no') === 'yes';
        wp_localize_script('lmcp-admin-js', 'lmcpWhitelabel', array(
            'logoUrl'       => esc_url($logo_url),
            'primaryColor'  => esc_attr($primary_color),
            'removeCredits' => $remove_credits
        ));
    } 
}
add_action('admin_enqueue_scripts', 'lmcp_admin_enqueue_scripts');

function lmcp_enqueue_front_scripts() { 
    wp_enqueue_script('lmcp-front-js', LMCP_PLUGIN_URL . 'assets/js/lmcp-front.js', ['jquery'], LMCP_VERSION, true); 
    wp_localize_script('lmcp-front-js', 'lmcp_ajax_obj', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('lmcp_ajax_nonce'),
        'plugin_url' => LMCP_PLUGIN_URL,
        'labels'     => array(
            'searching'  => lmcp_get_label('lmcp_label_searching', __('Searching...', 'lm-certificate-publisher')),
            'no_results' => lmcp_get_label('lmcp_label_no_results', __('No certificate records found matching your query.', 'lm-certificate-publisher')),
            'copied'     => lmcp_get_label('lmcp_label_copied', __('Copied to clipboard!', 'lm-certificate-publisher')),
            'copy_link'  => lmcp_get_label('lmcp_label_share_copy_link', __('Copy Link', 'lm-certificate-publisher')),
            'reset'      => lmcp_get_label('lmcp_label_reset_button', __('Clear', 'lm-certificate-publisher')),
            'print'      => lmcp_get_label('lmcp_label_print_button', __('Print Results', 'lm-certificate-publisher')),
        )
    )); 
    wp_enqueue_style('lmcp-front-css', LMCP_PLUGIN_URL . 'assets/css/lmcp-front.css', [], LMCP_VERSION); 

    // Dynamic frontend custom styling injection
    $btn_bg       = get_option('lmcp_btn_bg_color', get_option('lmcp_admin_primary_color', '#14bda9'));
    if (empty($btn_bg)) $btn_bg = '#14bda9';
    $btn_text     = get_option('lmcp_btn_text_color', '#ffffff');
    if (empty($btn_text)) $btn_text = '#ffffff';
    $btn_hover    = get_option('lmcp_btn_hover_bg_color', '#0ea391');
    if (empty($btn_hover)) $btn_hover = '#0ea391';
    $btn_radius   = get_option('lmcp_btn_border_radius', '6px');
    $form_bg      = get_option('lmcp_search_form_bg_color', '#f8fafc');
    $form_border  = get_option('lmcp_form_border_color', '#e2e8f0');
    $form_radius  = get_option('lmcp_form_border_radius', '8px');
    $card_bg      = get_option('lmcp_card_bg_color', '#ffffff');
    $card_border  = get_option('lmcp_card_border_color', '#e2e8f0');
    $card_radius  = get_option('lmcp_card_border_radius', '8px');

    $dynamic_front_css = "
    :root {
        --lmcp-btn-bg: " . esc_attr($btn_bg) . ";
        --lmcp-btn-text: " . esc_attr($btn_text) . ";
        --lmcp-btn-hover: " . esc_attr($btn_hover) . ";
        --lmcp-btn-radius: " . esc_attr($btn_radius) . ";
        --lmcp-form-bg: " . esc_attr($form_bg) . ";
        --lmcp-form-border: " . esc_attr($form_border) . ";
        --lmcp-form-radius: " . esc_attr($form_radius) . ";
        --lmcp-card-bg: " . esc_attr($card_bg) . ";
        --lmcp-card-border: " . esc_attr($card_border) . ";
        --lmcp-card-radius: " . esc_attr($card_radius) . ";
    }";
    wp_add_inline_style('lmcp-front-css', $dynamic_front_css);
}
add_action('wp_enqueue_scripts', 'lmcp_enqueue_front_scripts');

/* ==========================================================================
   4. Form & Data Processing
   ========================================================================== */
function lmcp_process_certificate_deletion() {
    $page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : '';
    $action = isset( $_GET['action'] ) ? sanitize_key( wp_unslash( $_GET['action'] ) ) : '';
    $cert_id = isset( $_GET['cert_id'] ) ? intval( $_GET['cert_id'] ) : ( isset( $_GET['certificate_id'] ) ? intval( $_GET['certificate_id'] ) : 0 );
    $nonce = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';

    if ( $page === 'lmcp_all_certificates' && $action === 'delete' && $cert_id > 0 ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( esc_html__( 'You do not have permission to delete certificate records.', 'lm-certificate-publisher' ) );
        }

        if ( ! $nonce || ( ! wp_verify_nonce( $nonce, 'lmcp_delete_cert_' . $cert_id ) && ! wp_verify_nonce( $nonce, 'delete_certificate_' . $cert_id ) ) ) {
            wp_die( esc_html__( 'Security check failed. Nonce verification failed.', 'lm-certificate-publisher' ) );
        }

        $post_to_delete = get_post( $cert_id );
        if ( $post_to_delete && $post_to_delete->post_type === 'lmc_certificate' ) {
            wp_delete_post( $cert_id, true );
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_all_certificates&message=deleted' ) );
            exit;
        } else {
            wp_die( esc_html__( 'Certificate record not found.', 'lm-certificate-publisher' ) );
        }
    }
}
add_action('admin_init', 'lmcp_process_certificate_deletion');

function lmcp_process_custom_field_deletion() {
    $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    if ( 'lmcp_custom_fields' !== $page ) {
        return;
    }

    $action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $slug = filter_input( INPUT_GET, 'field_slug', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    $nonce = filter_input( INPUT_GET, '_wpnonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

    if ( 'delete_field' === $action && $slug ) {
        if ( $nonce && wp_verify_nonce( $nonce, 'lmcp_delete_field_' . $slug ) && current_user_can( 'manage_options' ) ) {
            $custom_fields = get_option( 'lmcp_custom_fields', array() );
            $updated_fields = array_filter( $custom_fields, function( $field ) use ( $slug ) {
                return $field['slug'] !== $slug;
            } );
            update_option( 'lmcp_custom_fields', array_values( $updated_fields ) );
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_custom_fields&message=field_deleted' ) );
            exit;
        }
    }
}
add_action('admin_init', 'lmcp_process_custom_field_deletion');

function lmcp_process_add_edit_certificate() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = isset( $_POST['lmcp_certificate_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['lmcp_certificate_nonce'] ) ) : '';
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'lmcp_save_certificate' ) ) {
            wp_die( esc_html__( 'Nonce verification failed. Please try again.', 'lm-certificate-publisher' ) );
        }

        $certificate_id = isset( $_POST['certificate_id'] ) ? intval( $_POST['certificate_id'] ) : 0;
        $editing = ( $certificate_id > 0 );

        if ( $editing ) {
            $existing_post = get_post( $certificate_id );
            if ( ! $existing_post || $existing_post->post_type !== 'lmc_certificate' ) {
                wp_die( esc_html__( 'Invalid certificate record.', 'lm-certificate-publisher' ) );
            }
        }

        $post_status = isset( $_POST['save_as_draft'] ) ? 'draft' : 'publish';
        $title = isset( $_POST['certificate_title'] ) ? sanitize_text_field( wp_unslash( $_POST['certificate_title'] ) ) : '';
        if ( empty( $title ) ) {
            $title = __( 'Untitled Certificate', 'lm-certificate-publisher' );
        }

        $certificate_data = array(
            'post_title'  => $title,
            'post_type'   => 'lmc_certificate',
            'post_status' => $post_status
        );

        if ( $editing ) {
            $certificate_data['ID'] = $certificate_id;
            $cert_id = wp_update_post( $certificate_data, true );
        } else {
            $cert_id = wp_insert_post( $certificate_data, true );
        }

        if ( ! is_wp_error( $cert_id ) && $cert_id > 0 ) {
            $custom_fields = get_option( 'lmcp_custom_fields', array() );
            foreach ( $custom_fields as $field ) {
                $slug = $field['slug'];
                $type = isset( $field['type'] ) ? $field['type'] : 'text';

                if ( $type === 'table' ) {
                    if ( isset( $_POST[ $slug ] ) && is_array( $_POST[ $slug ] ) ) {
                        $sanitized_table = array();
                        foreach ( $_POST[ $slug ] as $r => $cols ) {
                            if ( is_array( $cols ) ) {
                                foreach ( $cols as $c => $val ) {
                                    $sanitized_table[ intval( $r ) ][ intval( $c ) ] = sanitize_text_field( wp_unslash( $val ) );
                                }
                            }
                        }
                        update_post_meta( $cert_id, $slug, wp_json_encode( $sanitized_table ) );
                    }
                } elseif ( in_array( $type, array( 'url', 'image', 'image_upload', 'file', 'file_upload' ), true ) ) {
                    if ( isset( $_POST[ $slug ] ) ) {
                        update_post_meta( $cert_id, $slug, esc_url_raw( wp_unslash( $_POST[ $slug ] ) ) );
                    }
                } else {
                    if ( isset( $_POST[ $slug ] ) ) {
                        update_post_meta( $cert_id, $slug, sanitize_text_field( wp_unslash( $_POST[ $slug ] ) ) );
                    }
                }
            }

            $categories_raw = isset( $_POST['certificate_categories'] ) && is_array( $_POST['certificate_categories'] ) ? $_POST['certificate_categories'] : array();
            $categories = array_map( 'intval', wp_unslash( $categories_raw ) );
            wp_set_object_terms( $cert_id, $categories, 'lmc_certificate_category' );

            $tags_raw = isset( $_POST['certificate_tags'] ) && is_array( $_POST['certificate_tags'] ) ? $_POST['certificate_tags'] : array();
            $tags = array_map( 'intval', wp_unslash( $tags_raw ) );
            wp_set_object_terms( $cert_id, $tags, 'lmc_certificate_tag' );

            // Ensure unique code is set for online verification & social sharing
            $unique_code = get_post_meta( $cert_id, 'lmcp_unique_code', true );
            if ( empty( $unique_code ) ) {
                $unique_code = strtoupper( wp_generate_password( 8, false, false ) );
                update_post_meta( $cert_id, 'lmcp_unique_code', $unique_code );
            }

            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_all_certificates&message=saved' ) );
            exit;
        } else {
            wp_die( esc_html__( 'There was an error saving the certificate.', 'lm-certificate-publisher' ) );
        }
    }
}
add_action('admin_post_lmcp_process_add_edit_certificate', 'lmcp_process_add_edit_certificate');

function lmcp_process_custom_field_form() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'lmcp_field_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'lmcp_add_field_nonce' ) && ! wp_verify_nonce( $nonce, 'lmcp_save_field' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'lm-certificate-publisher' ) );
        }

        $action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        $custom_fields = get_option( 'lmcp_custom_fields', array() );

        if ( 'lmcp_add_custom_field' === $action || 'lmcp_add_field' === $action ) {
            $field_name = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'field_name', FILTER_UNSAFE_RAW ) ?? '' ) );
            $field_slug = sanitize_title( wp_unslash( filter_input( INPUT_POST, 'field_slug', FILTER_UNSAFE_RAW ) ?? '' ) );
            if (empty($field_slug)) {
                $field_slug = sanitize_title($field_name);
            }
            $field_type = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'field_type', FILTER_UNSAFE_RAW ) ?? 'text' ) );
            $default_value = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'field_default_value', FILTER_UNSAFE_RAW ) ?? '' ) );

            if ( empty( $field_name ) ) {
                wp_safe_redirect( admin_url( 'admin.php?page=lmcp_custom_fields&message=empty_name' ) );
                exit;
            }

            foreach ( $custom_fields as $field ) {
                if ( $field['slug'] === $field_slug ) {
                    wp_safe_redirect( admin_url( 'admin.php?page=lmcp_custom_fields&message=field_exists' ) );
                    exit;
                }
            }

            $new_field = array(
                'name'          => $field_name,
                'slug'          => $field_slug,
                'type'          => $field_type,
                'default_value' => $default_value,
            );

            if ($field_type === 'table') {
                $new_field['default_rows']    = intval(filter_input(INPUT_POST, 'field_default_rows', FILTER_VALIDATE_INT) ?: 3);
                $new_field['default_columns'] = intval(filter_input(INPUT_POST, 'field_default_columns', FILTER_VALIDATE_INT) ?: 3);
                $new_field['column_headers']  = sanitize_text_field(wp_unslash(filter_input(INPUT_POST, 'field_column_headers', FILTER_UNSAFE_RAW) ?? ''));
            }

            $custom_fields[] = $new_field;
            update_option( 'lmcp_custom_fields', $custom_fields );
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_custom_fields&message=field_added' ) );
            exit;

        } elseif ( 'lmcp_save_field_order' === $action ) {
            $ordered_slugs_raw = filter_input( INPUT_POST, 'field_order', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
            $ordered_slugs = is_array( $ordered_slugs_raw ) ? array_map( 'sanitize_text_field', wp_unslash( $ordered_slugs_raw ) ) : array();
            $new_order_fields = array();
            $fields_by_slug = array_column( $custom_fields, null, 'slug' );
            foreach ( $ordered_slugs as $slug ) {
                if ( isset( $fields_by_slug[ $slug ] ) ) {
                    $new_order_fields[] = $fields_by_slug[ $slug ];
                }
            }
            update_option( 'lmcp_custom_fields', $new_order_fields );
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_custom_fields&message=order_saved' ) );
            exit;
        }
    }
}
add_action('admin_post_lmcp_add_custom_field', 'lmcp_process_custom_field_form');
add_action('admin_post_lmcp_add_field', 'lmcp_process_custom_field_form'); 
add_action('admin_post_lmcp_save_field_order', 'lmcp_process_custom_field_form');

function lmcp_process_save_search_settings() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'lmcp_save_settings_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'lmcp_save_settings_action' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'lm-certificate-publisher' ) );
        }

        // 1. Search Fields
        $search_fields_raw = filter_input( INPUT_POST, 'lmcp_search_fields', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
        $search_fields = is_array( $search_fields_raw ) ? array_map( 'sanitize_text_field', wp_unslash( $search_fields_raw ) ) : array();
        
        $search_input_label       = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_input_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $search_input_placeholder = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_input_placeholder', FILTER_UNSAFE_RAW ) ?? '' ) );
        $category_label           = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_category_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $category_placeholder     = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_category_placeholder', FILTER_UNSAFE_RAW ) ?? '' ) );
        $tag_label                = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_tag_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $tag_placeholder          = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_tag_placeholder', FILTER_UNSAFE_RAW ) ?? '' ) );
        $button_label             = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_button_label', FILTER_UNSAFE_RAW ) ?? '' ) );
        $bg_color                 = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_search_form_bg_color', FILTER_UNSAFE_RAW ) ?? '' ) );

        // 2. Whitelabel Settings
        $admin_logo         = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_admin_logo', FILTER_UNSAFE_RAW ) ?? '' ) );
        $admin_menu_name    = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_admin_menu_name', FILTER_UNSAFE_RAW ) ?? '' ) );
        $admin_primary_color= sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'lmcp_admin_primary_color', FILTER_UNSAFE_RAW ) ?? '#14bda9' ) );
        $remove_credits     = isset( $_POST['lmcp_whitelabel_remove_credits'] ) ? 'yes' : 'no';

        // 3. Frontend Text & Labels Customizer
        $label_fields = array(
            'lmcp_label_print_button',
            'lmcp_label_download_pdf_button',
            'lmcp_label_fullscreen_button',
            'lmcp_label_share_copy_link',
            'lmcp_label_copied',
            'lmcp_label_searching',
            'lmcp_label_preloader_text',
            'lmcp_label_no_results',
            'lmcp_label_scan_to_verify',
            'lmcp_label_certificate_code',
            'lmcp_label_serial_number',
            'lmcp_label_issuer',
            'lmcp_label_share_heading',
            'lmcp_label_share_linkedin',
            'lmcp_label_reset_button',
            'lmcp_label_verify_button',
            'lmcp_label_certificate_badge',
        );
        foreach ( $label_fields as $lbl ) {
            if ( isset( $_POST[ $lbl ] ) ) {
                update_option( $lbl, sanitize_text_field( wp_unslash( $_POST[ $lbl ] ) ) );
            }
        }

        // 3.1 Template & Visual Styling Configuration
        $template = isset( $_POST['lmcp_certificate_template'] ) ? sanitize_key( wp_unslash( $_POST['lmcp_certificate_template'] ) ) : 'vertical';
        if ( ! in_array( $template, array( 'horizontal', 'vertical' ), true ) ) {
            $template = 'vertical';
        }
        update_option( 'lmcp_certificate_template', $template );

        if ( isset( $_POST['lmcp_btn_bg_color'] ) ) {
            update_option( 'lmcp_btn_bg_color', sanitize_text_field( wp_unslash( $_POST['lmcp_btn_bg_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_btn_text_color'] ) ) {
            update_option( 'lmcp_btn_text_color', sanitize_text_field( wp_unslash( $_POST['lmcp_btn_text_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_btn_hover_bg_color'] ) ) {
            update_option( 'lmcp_btn_hover_bg_color', sanitize_text_field( wp_unslash( $_POST['lmcp_btn_hover_bg_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_btn_border_radius'] ) ) {
            update_option( 'lmcp_btn_border_radius', sanitize_text_field( wp_unslash( $_POST['lmcp_btn_border_radius'] ) ) );
        }
        if ( isset( $_POST['lmcp_btn_size'] ) ) {
            update_option( 'lmcp_btn_size', sanitize_key( wp_unslash( $_POST['lmcp_btn_size'] ) ) );
        }
        if ( isset( $_POST['lmcp_form_border_color'] ) ) {
            update_option( 'lmcp_form_border_color', sanitize_text_field( wp_unslash( $_POST['lmcp_form_border_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_form_border_radius'] ) ) {
            update_option( 'lmcp_form_border_radius', sanitize_text_field( wp_unslash( $_POST['lmcp_form_border_radius'] ) ) );
        }
        if ( isset( $_POST['lmcp_card_bg_color'] ) ) {
            update_option( 'lmcp_card_bg_color', sanitize_text_field( wp_unslash( $_POST['lmcp_card_bg_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_card_border_color'] ) ) {
            update_option( 'lmcp_card_border_color', sanitize_text_field( wp_unslash( $_POST['lmcp_card_border_color'] ) ) );
        }
        if ( isset( $_POST['lmcp_card_border_radius'] ) ) {
            update_option( 'lmcp_card_border_radius', sanitize_text_field( wp_unslash( $_POST['lmcp_card_border_radius'] ) ) );
        }

        // 4. Social Sharing & LinkedIn "Add to Profile"
        update_option( 'lmcp_enable_social_sharing', isset( $_POST['lmcp_enable_social_sharing'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_social_share_linkedin', isset( $_POST['lmcp_social_share_linkedin'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_social_share_whatsapp', isset( $_POST['lmcp_social_share_whatsapp'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_social_share_x', isset( $_POST['lmcp_social_share_x'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_social_share_facebook', isset( $_POST['lmcp_social_share_facebook'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_social_share_copylink', isset( $_POST['lmcp_social_share_copylink'] ) ? 'yes' : 'no' );
        if ( isset( $_POST['lmcp_social_linkedin_org_name'] ) ) {
            update_option( 'lmcp_social_linkedin_org_name', sanitize_text_field( wp_unslash( $_POST['lmcp_social_linkedin_org_name'] ) ) );
        }
        if ( isset( $_POST['lmcp_social_share_template'] ) ) {
            update_option( 'lmcp_social_share_template', sanitize_textarea_field( wp_unslash( $_POST['lmcp_social_share_template'] ) ) );
        }

        // 5. Certificate Privacy, Sitemaps & Anti-Indexing
        update_option( 'lmcp_disable_certificate_sitemap', isset( $_POST['lmcp_disable_certificate_sitemap'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_noindex_certificates', isset( $_POST['lmcp_noindex_certificates'] ) ? 'yes' : 'no' );
        update_option( 'lmcp_restrict_direct_cert_access', isset( $_POST['lmcp_restrict_direct_cert_access'] ) ? 'yes' : 'no' );

        // 6. Base Search Options
        update_option( 'lmcp_search_fields', $search_fields );
        update_option( 'lmcp_search_label', $search_input_label );
        update_option( 'lmcp_search_input_label', $search_input_label );
        update_option( 'lmcp_search_input_placeholder', $search_input_placeholder );
        update_option( 'lmcp_category_label', $category_label );
        update_option( 'lmcp_search_category_label', $category_label );
        update_option( 'lmcp_category_placeholder', $category_placeholder );
        update_option( 'lmcp_tag_label', $tag_label );
        update_option( 'lmcp_search_tag_label', $tag_label );
        update_option( 'lmcp_tag_placeholder', $tag_placeholder );
        update_option( 'lmcp_search_button_label', $button_label );
        update_option( 'lmcp_search_form_bg_color', $bg_color );
        update_option( 'lmcp_admin_logo', $admin_logo );
        update_option( 'lmcp_admin_menu_name', $admin_menu_name );
        update_option( 'lmcp_admin_primary_color', $admin_primary_color );
        update_option( 'lmcp_whitelabel_remove_credits', $remove_credits );

        $active_tab = sanitize_key( wp_unslash( filter_input( INPUT_POST, 'lmcp_active_tab', FILTER_DEFAULT ) ?? 'tab-search' ) );
        if ( empty( $active_tab ) ) {
            $active_tab = 'tab-search';
        }

        wp_safe_redirect( admin_url( 'admin.php?page=lmcp_search_field&message=settings_saved&tab=' . urlencode( $active_tab ) ) );
        exit;
    }
}
add_action('admin_post_lmcp_save_search_settings', 'lmcp_process_save_search_settings');

/* ==========================================================================
   5. Bulk Operations: CSV Demo Download & CSV Import Handler
   ========================================================================== */
function lmcp_download_demo_csv() {
    if ( isset($_GET['action']) && $_GET['action'] === 'lmcp_download_demo_csv' ) {
        $nonce = filter_input( INPUT_GET, '_wpnonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'lmcp_download_demo_csv_nonce' ) || ! current_user_can( 'manage_options' ) ) {
            wp_die( esc_html__( 'Security check failed.', 'lm-certificate-publisher' ) );
        }

        $custom_fields = get_option('lmcp_custom_fields', array());
        $categories = get_terms(array('taxonomy' => 'lmc_certificate_category', 'hide_empty' => false));
        $tags = get_terms(array('taxonomy' => 'lmc_certificate_tag', 'hide_empty' => false));

        $headers = array('certificate_title');
        $sample_row = array('Jane Doe - Advanced Web Engineering Certificate');

        if (!empty($custom_fields)) {
            foreach ($custom_fields as $f) {
                $headers[] = $f['slug'];
                if ($f['type'] === 'number') {
                    $sample_row[] = '9850';
                } elseif ($f['type'] === 'date') {
                    $sample_row[] = '2026-06-15';
                } elseif ($f['type'] === 'url') {
                    $sample_row[] = 'https://example.com/verify';
                } elseif ($f['type'] === 'table') {
                    $sample_row[] = 'Subject A:95|Subject B:98';
                } else {
                    $sample_row[] = !empty($f['default_value']) ? $f['default_value'] : 'Sample ' . $f['name'];
                }
            }
        }

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $cat) {
                $headers[] = 'category:' . $cat->slug;
                $sample_row[] = '1';
            }
        }

        if (!empty($tags) && !is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $headers[] = 'tag:' . $tag->slug;
                $sample_row[] = '1';
            }
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=certificates_demo_template.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        fputcsv($output, $headers);
        fputcsv($output, $sample_row);
        fclose($output);
        exit;
    }
}
add_action('admin_init', 'lmcp_download_demo_csv');

function lmcp_process_csv_import() {
    if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] && current_user_can( 'manage_options' ) ) {
        $nonce = filter_input( INPUT_POST, 'lmcp_csv_import_nonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $nonce || ! wp_verify_nonce( $nonce, 'lmcp_csv_import_action' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'lm-certificate-publisher' ) );
        }

        if ( ! isset($_FILES['csv_file']) || empty($_FILES['csv_file']['tmp_name']) ) {
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_bulk_operations&message=error_file' ) );
            exit;
        }

        $file_tmp = $_FILES['csv_file']['tmp_name'];
        $file_name = sanitize_file_name($_FILES['csv_file']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_ext !== 'csv') {
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_bulk_operations&message=error_file' ) );
            exit;
        }

        $handle = fopen($file_tmp, 'r');
        if (!$handle) {
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_bulk_operations&message=error_file' ) );
            exit;
        }

        $header = fgetcsv($handle, 10000, ',');
        if (!$header || empty($header)) {
            fclose($handle);
            wp_safe_redirect( admin_url( 'admin.php?page=lmcp_bulk_operations&message=error_file' ) );
            exit;
        }

        $header = array_map(function($h) {
            return trim(strtolower((string)$h));
        }, $header);

        $custom_fields = get_option('lmcp_custom_fields', array());
        $imported_count = 0;

        while (($row = fgetcsv($handle, 10000, ',')) !== false) {
            if (empty($row) || (count($row) === 1 && empty($row[0]))) {
                continue;
            }

            $row_data = array();
            foreach ($header as $idx => $col_name) {
                $row_data[$col_name] = isset($row[$idx]) ? trim($row[$idx]) : '';
            }

            $title = !empty($row_data['certificate_title']) ? $row_data['certificate_title'] : (!empty($row_data['title']) ? $row_data['title'] : 'Certificate #' . ($imported_count + 1));

            $cert_id = wp_insert_post(array(
                'post_title'  => sanitize_text_field($title),
                'post_type'   => 'lmc_certificate',
                'post_status' => 'publish'
            ));

            if (!is_wp_error($cert_id) && $cert_id > 0) {
                // Save custom fields
                foreach ($custom_fields as $f) {
                    $slug = $f['slug'];
                    if (isset($row_data[$slug])) {
                        update_post_meta($cert_id, $slug, sanitize_text_field($row_data[$slug]));
                    }
                }

                // Handle categories and tags
                $cat_ids = array();
                $tag_ids = array();

                foreach ($row_data as $key => $val) {
                    if (strpos($key, 'category:') === 0 && ($val === '1' || strtolower($val) === 'yes' || strtolower($val) === 'true')) {
                        $cat_slug = substr($key, 9);
                        $term = get_term_by('slug', $cat_slug, 'lmc_certificate_category');
                        if ($term) {
                            $cat_ids[] = intval($term->term_id);
                        }
                    } elseif (strpos($key, 'tag:') === 0 && ($val === '1' || strtolower($val) === 'yes' || strtolower($val) === 'true')) {
                        $tag_slug = substr($key, 4);
                        $term = get_term_by('slug', $tag_slug, 'lmc_certificate_tag');
                        if ($term) {
                            $tag_ids[] = intval($term->term_id);
                        }
                    }
                }

                if (!empty($cat_ids)) {
                    wp_set_object_terms($cert_id, $cat_ids, 'lmc_certificate_category');
                }
                if (!empty($tag_ids)) {
                    wp_set_object_terms($cert_id, $tag_ids, 'lmc_certificate_tag');
                }

                // Ensure unique code is set for online verification & social sharing
                $unique_code = strtoupper( wp_generate_password( 8, false, false ) );
                update_post_meta( $cert_id, 'lmcp_unique_code', $unique_code );

                $imported_count++;
            }
        }

        fclose($handle);
        wp_safe_redirect( admin_url( 'admin.php?page=lmcp_bulk_operations&message=imported&count=' . $imported_count ) );
        exit;
    }
}
add_action('admin_post_lmcp_import_csv', 'lmcp_process_csv_import');

/* ==========================================================================
   6. Ajax Search Handler
   ========================================================================== */
function lmcp_ajax_search() {
    check_ajax_referer( 'lmcp_ajax_nonce', 'nonce' );

    $search_query = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'search_query', FILTER_UNSAFE_RAW ) ?? '' ) );
    $category     = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'category', FILTER_UNSAFE_RAW ) ?? '' ) );
    $tag          = sanitize_text_field( wp_unslash( filter_input( INPUT_POST, 'tag', FILTER_UNSAFE_RAW ) ?? '' ) );
    
    $search_fields = get_option( 'lmcp_search_fields', array() );
    if (!is_array($search_fields)) {
        $search_fields = array_filter(array_map('trim', explode(',', (string)$search_fields)));
    }

    $meta_query = array('relation' => 'OR');
    if (!empty($search_query) && !empty($search_fields)) { 
        foreach ($search_fields as $field_slug) { 
            $meta_query[] = array(
                'key'     => $field_slug, 
                'value'   => $search_query, 
                'compare' => 'LIKE'
            ); 
        } 
    }

    $args = array( 
        'post_type'      => 'lmc_certificate', 
        'post_status'    => 'publish', 
        'posts_per_page' => -1 
    );

    if (!empty($search_query) && !empty($search_fields)) {
        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Required for certificate search
        $args['meta_query'] = $meta_query;
    }

    if (!empty($category) || !empty($tag)) {
        $tax_query = array('relation' => 'AND');
        if (!empty($category)) { 
            $tax_query[] = array(
                'taxonomy' => 'lmc_certificate_category', 
                'field'    => 'slug', 
                'terms'    => $category
            ); 
        }
        if (!empty($tag)) { 
            $tax_query[] = array(
                'taxonomy' => 'lmc_certificate_tag', 
                'field'    => 'slug', 
                'terms'    => $tag
            ); 
        }
        // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Required for category/tag filtering
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query($args); 
    $results = array(); 

    if ($query->have_posts()) { 
        while ($query->have_posts()) { 
            $query->the_post(); 
            $cert_id = get_the_ID(); 

            ob_start(); 
            $custom_fields = get_option('lmcp_custom_fields', array());
            $template_layout = get_option('lmcp_certificate_template', 'vertical');

            if ($template_layout === 'vertical') : ?>
                <div class="lmcp-cert-card lmcp-cert-vertical-template">
                    <div class="lmcp-cert-vertical-header">
                        <div class="lmcp-cert-vertical-badge"><?php echo esc_html( lmcp_get_label( 'lmcp_label_certificate_badge', __( 'Official Certificate Record', 'lm-certificate-publisher' ) ) ); ?></div>
                        <h3 class="lmcp-cert-vertical-title"><?php echo esc_html(get_the_title()); ?></h3>
                    </div>
                    <div class="lmcp-cert-vertical-body">
                        <?php foreach ($custom_fields as $field) : 
                            $value = get_post_meta($cert_id, $field['slug'], true); 
                            if (!empty($value)) : ?>
                            <div class="lmcp-cert-field-vertical">
                                <div class="lmcp-cert-label-vertical"><?php echo esc_html($field['name']); ?></div>
                                <div class="lmcp-cert-value-vertical">
                                    <?php 
                                    $ftype = isset($field['type']) ? $field['type'] : 'text';
                                    if ($ftype === 'image' || $ftype === 'image_upload') { 
                                        echo '<img src="' . esc_url($value) . '" style="max-width:180px; height:auto; border-radius:6px; border:1px solid #e2e8f0; margin-top:4px;" alt="' . esc_attr($field['name']) . '"/>'; 
                                    } elseif ($ftype === 'url') { 
                                        echo '<a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer" style="color:var(--lmcp-btn-bg, #14bda9); font-weight:600; text-decoration:none;">' . esc_html(lmcp_get_label('lmcp_label_verify_button', __('View Link', 'lm-certificate-publisher'))) . ' &rarr;</a>'; 
                                    } elseif ($ftype === 'file' || $ftype === 'file_upload') { 
                                        echo '<a href="' . esc_url($value) . '" class="lmcp-download-btn" download>' . esc_html(lmcp_get_label('lmcp_label_download_pdf_button', __('Download Document', 'lm-certificate-publisher'))) . '</a>'; 
                                    } elseif ($ftype === 'table') {
                                        $table_data = is_array($value) ? $value : json_decode($value, true);
                                        if (!empty($table_data) && is_array($table_data)) {
                                            $headers = isset($field['column_headers']) && !empty($field['column_headers']) ? explode(',', $field['column_headers']) : array();
                                            echo '<table class="lmcp-sub-table" style="width:100%; border-collapse:collapse; margin-top:6px; border:1px solid #e2e8f0; border-radius:6px; overflow:hidden;">';
                                            if (!empty($headers)) {
                                                echo '<thead><tr>';
                                                foreach ($headers as $h) {
                                                    echo '<th style="border:1px solid #e2e8f0; padding:8px 10px; background:#f8fafc; font-size:12px; font-weight:700; color:#475569;">' . esc_html(trim($h)) . '</th>';
                                                }
                                                echo '</tr></thead>';
                                            }
                                            echo '<tbody>';
                                            foreach ($table_data as $row) {
                                                echo '<tr>';
                                                if (is_array($row)) {
                                                    foreach ($row as $cell) {
                                                        echo '<td style="border:1px solid #e2e8f0; padding:8px 10px; font-size:13px; color:#1e293b;">' . esc_html($cell) . '</td>';
                                                    }
                                                }
                                                echo '</tr>';
                                            }
                                            echo '</tbody></table>';
                                        }
                                    } else { 
                                        echo esc_html($value); 
                                    } 
                                    ?>
                                </div>
                            </div>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <table class="lmcp-cert-table">
                    <thead><tr><th colspan="2"><?php echo esc_html(get_the_title()); ?></th></tr></thead>
                    <tbody><?php foreach ($custom_fields as $field) : 
                        $value = get_post_meta($cert_id, $field['slug'], true); 
                        if (!empty($value)) : ?>
                        <tr>
                            <td><strong><?php echo esc_html($field['name']); ?></strong></td>
                            <td>
                                <?php 
                                $ftype = isset($field['type']) ? $field['type'] : 'text';
                                if ($ftype === 'image' || $ftype === 'image_upload') { 
                                    echo '<img src="' . esc_url($value) . '" style="max-width:150px; height:auto; border-radius:4px;" alt="' . esc_attr($field['name']) . '"/>'; 
                                } elseif ($ftype === 'url') { 
                                    echo '<a href="' . esc_url($value) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('View Link', 'lm-certificate-publisher') . ' &rarr;</a>'; 
                                } elseif ($ftype === 'file' || $ftype === 'file_upload') { 
                                    echo '<a href="' . esc_url($value) . '" class="lmcp-download-btn" download>' . esc_html(lmcp_get_label('lmcp_label_download_pdf_button', __('Download Document', 'lm-certificate-publisher'))) . '</a>'; 
                                } elseif ($ftype === 'table') {
                                    $table_data = is_array($value) ? $value : json_decode($value, true);
                                    if (!empty($table_data) && is_array($table_data)) {
                                        $headers = isset($field['column_headers']) && !empty($field['column_headers']) ? explode(',', $field['column_headers']) : array();
                                        echo '<table class="lmcp-sub-table" style="width:100%; border-collapse:collapse; margin-top:5px;">';
                                        if (!empty($headers)) {
                                            echo '<thead><tr>';
                                            foreach ($headers as $h) {
                                                echo '<th style="border:1px solid #e2e8f0; padding:6px; background:#f8fafc; font-size:12px;">' . esc_html(trim($h)) . '</th>';
                                            }
                                            echo '</tr></thead>';
                                        }
                                        echo '<tbody>';
                                        foreach ($table_data as $row) {
                                            echo '<tr>';
                                            if (is_array($row)) {
                                                foreach ($row as $cell) {
                                                    echo '<td style="border:1px solid #e2e8f0; padding:6px; font-size:12px;">' . esc_html($cell) . '</td>';
                                                }
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</tbody></table>';
                                    }
                                } else { 
                                    echo esc_html($value); 
                                } 
                                ?>
                            </td>
                        </tr>
                    <?php endif; endforeach; ?></tbody>
                </table>
            <?php endif; ?>
            <?php 
            if ( function_exists( 'lmcp_render_social_share_bar' ) ) {
                echo lmcp_render_social_share_bar( $cert_id );
            }
            $results[] = ob_get_clean(); 
        } 
        wp_reset_postdata(); 
    } 
    wp_send_json_success( $results ); 
} 
add_action('wp_ajax_lmcp_ajax_search', 'lmcp_ajax_search'); 
add_action('wp_ajax_nopriv_lmcp_ajax_search', 'lmcp_ajax_search');

/* ==========================================================================
   7. Shortcodes
   ========================================================================== */
function lmcp_search_shortcode( $atts ) { 
    $search_label       = get_option('lmcp_search_input_label', get_option('lmcp_search_label', __('Search Certificate', 'lm-certificate-publisher'))); 
    $search_placeholder = get_option('lmcp_search_input_placeholder', __('Enter recipient name, roll no, or certificate ID...', 'lm-certificate-publisher'));
    $btn_label          = get_option('lmcp_search_button_label', __('Search', 'lm-certificate-publisher'));
    $print_label        = lmcp_get_label('lmcp_label_print_button', __('Print Results', 'lm-certificate-publisher'));
    $bg_color           = get_option('lmcp_search_form_bg_color', '');
    $bg_style           = !empty($bg_color) ? 'background-color:' . esc_attr($bg_color) . ';' : '';
    
    ob_start(); 
    ?> 
    <div id="lmcp-search-form" class="lmcp-search-form" style="<?php echo esc_attr($bg_style); ?>">
        <div class="lmcp-search-input-group">
            <label for="lmcp-search-query" class="lmcp-field-label"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="lmcp-search-query" placeholder="<?php echo esc_attr($search_placeholder); ?>">
        </div>
        <div class="lmcp-search-btn-group">
            <button id="lmcp-search-btn"><?php echo esc_html($btn_label); ?></button>
            <button id="lmcp-print-btn"><?php echo esc_html($print_label); ?></button>
        </div>
        <div id="lmcp-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('lmc_certificate_search', 'lmcp_search_shortcode');
add_shortcode('lmc_search_field', 'lmcp_search_shortcode');

function lmcp_search_categories_shortcode( $atts ) { 
    $search_label        = get_option('lmcp_search_input_label', get_option('lmcp_search_label', __('Search Certificate', 'lm-certificate-publisher'))); 
    $search_placeholder  = get_option('lmcp_search_input_placeholder', __('Enter recipient name, roll no, or certificate ID...', 'lm-certificate-publisher'));
    $category_label      = get_option('lmcp_search_category_label', get_option('lmcp_category_label', __('Certificate Category', 'lm-certificate-publisher'))); 
    $category_placeholder= get_option('lmcp_category_placeholder', __('Select Category / All Categories', 'lm-certificate-publisher'));
    $btn_label           = get_option('lmcp_search_button_label', __('Search', 'lm-certificate-publisher'));
    $print_label         = lmcp_get_label('lmcp_label_print_button', __('Print Results', 'lm-certificate-publisher'));
    $bg_color            = get_option('lmcp_search_form_bg_color', '');
    $bg_style            = !empty($bg_color) ? 'background-color:' . esc_attr($bg_color) . ';' : '';
    
    $categories = get_terms(array('taxonomy' => 'lmc_certificate_category', 'hide_empty' => false)); 
    ob_start(); 
    ?> 
    <div id="lmcp-search-form" class="lmcp-search-form" style="<?php echo esc_attr($bg_style); ?>">
        <div class="lmcp-search-input-group">
            <label for="lmcp-search-query" class="lmcp-field-label"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="lmcp-search-query" placeholder="<?php echo esc_attr($search_placeholder); ?>">
        </div>
        <div class="lmcp-search-select-group">
            <div class="lmcp-select">
                <label for="lmcp-category-selector" class="lmcp-field-label"><?php echo esc_html($category_label); ?></label>
                <select id="lmcp-category-selector" name="category" aria-label="<?php echo esc_attr($category_label); ?>">
                    <option value=""><?php echo esc_html($category_placeholder ? $category_placeholder : sprintf(__('Select %s...', 'lm-certificate-publisher'), $category_label)); ?></option>
                    <?php if (!empty($categories) && !is_wp_error($categories)) : foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } endif; ?>
                </select>
            </div>
        </div>
        <div class="lmcp-search-btn-group">
            <button id="lmcp-search-btn"><?php echo esc_html($btn_label); ?></button>
            <button id="lmcp-print-btn"><?php echo esc_html($print_label); ?></button>
        </div>
        <div id="lmcp-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('lmc_certificate_search_categories', 'lmcp_search_categories_shortcode');

function lmcp_search_tags_categories_shortcode( $atts ) { 
    $search_label        = get_option('lmcp_search_input_label', get_option('lmcp_search_label', __('Search Certificate', 'lm-certificate-publisher'))); 
    $search_placeholder  = get_option('lmcp_search_input_placeholder', __('Enter recipient name, roll no, or certificate ID...', 'lm-certificate-publisher'));
    $category_label      = get_option('lmcp_search_category_label', get_option('lmcp_category_label', __('Certificate Category', 'lm-certificate-publisher'))); 
    $category_placeholder= get_option('lmcp_category_placeholder', __('Select Category / All Categories', 'lm-certificate-publisher'));
    $tag_label           = get_option('lmcp_search_tag_label', get_option('lmcp_tag_label', __('Certificate Tag', 'lm-certificate-publisher'))); 
    $tag_placeholder     = get_option('lmcp_tag_placeholder', __('Select Tag / All Tags', 'lm-certificate-publisher'));
    $btn_label           = get_option('lmcp_search_button_label', __('Search', 'lm-certificate-publisher'));
    $print_label         = lmcp_get_label('lmcp_label_print_button', __('Print Results', 'lm-certificate-publisher'));
    $bg_color            = get_option('lmcp_search_form_bg_color', '');
    $bg_style            = !empty($bg_color) ? 'background-color:' . esc_attr($bg_color) . ';' : '';
    
    $categories = get_terms(array('taxonomy' => 'lmc_certificate_category', 'hide_empty' => false)); 
    $tags       = get_terms(array('taxonomy' => 'lmc_certificate_tag', 'hide_empty' => false)); 
    ob_start(); 
    ?> 
    <div id="lmcp-search-form" class="lmcp-search-form" style="<?php echo esc_attr($bg_style); ?>">
        <div class="lmcp-search-input-group">
            <label for="lmcp-search-query" class="lmcp-field-label"><?php echo esc_html($search_label); ?></label>
            <input type="text" id="lmcp-search-query" placeholder="<?php echo esc_attr($search_placeholder); ?>">
        </div>
        <div class="lmcp-search-select-group">
            <div class="lmcp-select">
                <label for="lmcp-category-selector" class="lmcp-field-label"><?php echo esc_html($category_label); ?></label>
                <select id="lmcp-category-selector" name="category" aria-label="<?php echo esc_attr($category_label); ?>">
                    <option value=""><?php echo esc_html($category_placeholder ? $category_placeholder : sprintf(__('Select %s...', 'lm-certificate-publisher'), $category_label)); ?></option>
                    <?php if (!empty($categories) && !is_wp_error($categories)) : foreach ($categories as $cat) { echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>'; } endif; ?>
                </select>
            </div>
            <div class="lmcp-select">
                <label for="lmcp-tag-selector" class="lmcp-field-label"><?php echo esc_html($tag_label); ?></label>
                <select id="lmcp-tag-selector" name="tag" aria-label="<?php echo esc_attr($tag_label); ?>">
                    <option value=""><?php echo esc_html($tag_placeholder ? $tag_placeholder : sprintf(__('Select %s...', 'lm-certificate-publisher'), $tag_label)); ?></option>
                    <?php if (!empty($tags) && !is_wp_error($tags)) : foreach ($tags as $tag) { echo '<option value="' . esc_attr($tag->slug) . '">' . esc_html($tag->name) . '</option>'; } endif; ?>
                </select>
            </div>
        </div>
        <div class="lmcp-search-btn-group">
            <button id="lmcp-search-btn"><?php echo esc_html($btn_label); ?></button>
            <button id="lmcp-print-btn"><?php echo esc_html($print_label); ?></button>
        </div>
        <div id="lmcp-search-results"></div>
    </div> 
    <?php 
    return ob_get_clean(); 
}
add_shortcode('lmc_certificate_search_tags_categories', 'lmcp_search_tags_categories_shortcode');
