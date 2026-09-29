<?php
/**
 * View: CertifyPress Settings & Configuration (Free Edition)
 *
 * Designed to match CertifyPress Pro specifications with unified borders,
 * padding, typography, golden PRO badges, and full support for Frontend Labels,
 * Social Sharing & LinkedIn, and Certificate Privacy & Sitemaps.
 *
 * @package CertifyPress
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$lmcp_custom_fields          = get_option( 'lmcp_custom_fields', array() );
$lmcp_selected_search_fields = get_option( 'lmcp_search_fields', array() );
if ( ! is_array( $lmcp_selected_search_fields ) ) {
    $lmcp_selected_search_fields = array_filter( array_map( 'trim', explode( ',', (string) $lmcp_selected_search_fields ) ) );
}

$lmcp_pro_purchase_url    = 'https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin';
$lmcp_extensions_url      = 'https://certifypress.site/#extensions';
$lmcp_admin_logo          = get_option( 'lmcp_admin_logo', '' );
$lmcp_admin_menu_name     = get_option( 'lmcp_admin_menu_name', __( 'Certificates', 'lm-certificate-publisher' ) );
$lmcp_admin_primary_color = get_option( 'lmcp_admin_primary_color', '#14bda9' );
$lmcp_active_tab_request  = sanitize_key( filter_input( INPUT_GET, 'tab', FILTER_DEFAULT ) ?? 'tab-search' );
if ( empty( $lmcp_active_tab_request ) ) {
    $lmcp_active_tab_request = 'tab-search';
}
?>

<style>
/* CertifyPress Unified Settings Architecture (Pro Matching) */
.lmcp-settings-layout {
    display: flex;
    gap: 28px;
    margin-top: 24px;
    align-items: flex-start;
}
.lmcp-settings-sidebar {
    width: 270px;
    flex-shrink: 0;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.lmcp-settings-content {
    flex: 1;
    min-width: 0;
}
.lmcp-tab-btn {
    width: 100%;
    text-align: left !important;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    border: 1px solid transparent !important;
    border-radius: 6px !important;
    padding: 11px 14px !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    font-size: 13.5px !important;
    color: #475569 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    background: transparent !important;
    margin-bottom: 0 !important;
    box-shadow: none !important;
    line-height: 1.4 !important;
}
.lmcp-tab-btn-title {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}
.lmcp-tab-btn svg {
    flex-shrink: 0;
    color: #94a3b8;
    transition: color 0.2s ease;
}
.lmcp-tab-btn:hover {
    background: #f8fafc !important;
    color: #0f172a !important;
}
.lmcp-tab-btn:hover svg {
    color: #475569;
}
.lmcp-tab-btn.active-tab {
    background: var(--lmcp-primary-color, #14bda9) !important;
    color: #ffffff !important;
    font-weight: 600 !important;
}
.lmcp-tab-btn.active-tab svg {
    color: #ffffff !important;
}
.lmcp-tab-btn.active-tab .lmcp-pro-tag {
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
}
.lmcp-tab-content {
    display: none;
    animation: lmcpTabFade 0.25s ease;
}
.lmcp-tab-content.active-content {
    display: block;
}
@keyframes lmcpTabFade {
    from { opacity: 0; transform: translateY(3px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Modern Engine Grid */
.lmcp-engine-selector-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 16px;
    margin-bottom: 24px;
}
.lmcp-engine-option {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px;
    background: #ffffff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
}
.lmcp-engine-header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}
.lmcp-engine-icon-pill {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eff6ff;
    color: #2563eb;
}
.lmcp-engine-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 6px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.lmcp-engine-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 14px 0;
    flex-grow: 1;
}

/* Golden PRO Feature Showcase Banner */
.lmcp-pro-feature-banner {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border: 1px solid #fde68a;
    border-radius: 10px;
    padding: 18px 22px;
    margin-top: 20px;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    box-shadow: 0 1px 3px rgba(217, 119, 6, 0.08);
}
.lmcp-pro-banner-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.lmcp-pro-banner-icon {
    width: 44px;
    height: 44px;
    border-radius: 9px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(217, 119, 6, 0.35);
}
.lmcp-pro-banner-title {
    margin: 0;
    font-size: 15.5px;
    font-weight: 700;
    color: #92400e;
    display: flex;
    align-items: center;
    gap: 8px;
}
.lmcp-pro-banner-desc {
    margin: 4px 0 0 0;
    font-size: 13px;
    color: #78350f;
    line-height: 1.4;
}
.lmcp-pro-btn {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 700 !important;
    padding: 9px 18px !important;
    border-radius: 6px !important;
    box-shadow: 0 2px 6px rgba(217, 119, 6, 0.3) !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
    font-size: 13px !important;
    transition: filter 0.2s ease, transform 0.15s ease !important;
    white-space: nowrap !important;
}
.lmcp-pro-btn:hover {
    filter: brightness(1.06) !important;
    transform: translateY(-1px) !important;
    color: #ffffff !important;
}

/* Extension Grid */
.lmcp-extensions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
    gap: 20px;
}
.lmcp-extension-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 24px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(15, 23, 42, 0.03);
}
.lmcp-extension-card:hover {
    border-color: #cbd5e1;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
    transform: translateY(-1px);
}

@media (max-width: 900px) {
    .lmcp-settings-layout {
        flex-direction: column;
        align-items: stretch;
    }
    .lmcp-settings-sidebar {
        width: 100%;
    }
}
</style>

<div class="wrap lmcp-admin-wrapper">
    <!-- Page Header (Matching Pro Structure) -->
    <div class="lmcp-page-header">
        <div class="lmcp-header-title-group">
            <?php if ( ! empty( $lmcp_admin_logo ) ) : ?>
                <div class="lmcp-header-logo-box">
                    <img src="<?php echo esc_url( $lmcp_admin_logo ); ?>" alt="Logo" class="lmcp-header-logo-img">
                </div>
            <?php else : ?>
                <div class="lmcp-header-icon-box">
                    <?php echo lmcp_icon( 'settings', 22 ); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__( 'LM Certificate Publisher', 'lm-certificate-publisher' ); ?> &mdash; <?php echo esc_html__( 'Settings & Configuration', 'lm-certificate-publisher' ); ?></h1>
                <p class="lmcp-page-description"><?php echo esc_html__( 'Manage certificate search fields, shortcodes, styling, frontend translations, 1-click social sharing, and search engine privacy.', 'lm-certificate-publisher' ); ?></p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                <?php echo lmcp_icon( 'sparkles', 15 ); ?> <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?>
            </a>
        </div>
    </div>

    <?php if ( isset( $_GET['message'] ) && $_GET['message'] === 'settings_saved' ) : ?>
        <div class="lmcp-notice success">
            <?php echo esc_html__( 'Settings have been saved successfully.', 'lm-certificate-publisher' ); ?>
        </div>
    <?php endif; ?>

    <!-- Unified Settings Layout Container -->
    <div class="lmcp-settings-layout">
        <!-- Sidebar Navigation on Left -->
        <div class="lmcp-settings-sidebar">
            <button type="button" class="lmcp-tab-btn active-tab" data-tab="tab-search">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'search', 16 ); ?>
                    <span><?php echo esc_html__( 'Search & Shortcodes', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-layout">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'palette', 16 ); ?>
                    <span><?php echo esc_html__( 'Templates & Style', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-labels">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'globe', 16 ); ?>
                    <span><?php echo esc_html__( 'Frontend Text & Labels', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-social">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'share', 16 ); ?>
                    <span><?php echo esc_html__( 'Social Sharing & LinkedIn', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-privacy">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'lock', 16 ); ?>
                    <span><?php echo esc_html__( 'Privacy & Sitemaps', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-serial">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'hash', 16 ); ?>
                    <span><?php echo esc_html__( 'Serial Numbers', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-qr">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'qrcode', 16 ); ?>
                    <span><?php echo esc_html__( 'QR Codes & Print', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-expiry">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'hourglass', 16 ); ?>
                    <span><?php echo esc_html__( 'Expiry & Validity', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-email">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'mail', 16 ); ?>
                    <span><?php echo esc_html__( 'Email Settings', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-recaptcha">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'shield', 16 ); ?>
                    <span><?php echo esc_html__( 'reCAPTCHA Security', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-preloader">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'bolt', 16 ); ?>
                    <span><?php echo esc_html__( 'Search Preloader', 'lm-certificate-publisher' ); ?></span>
                </div>
                <span class="lmcp-pro-tag">PRO</span>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-whitelabel">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'tag', 16 ); ?>
                    <span><?php echo esc_html__( 'Whitelabel Settings', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-export-import">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'box', 16 ); ?>
                    <span><?php echo esc_html__( 'Export & Import', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
            <button type="button" class="lmcp-tab-btn" data-tab="tab-extensions">
                <div class="lmcp-tab-btn-title">
                    <?php echo lmcp_icon( 'plug', 16 ); ?>
                    <span><?php echo esc_html__( 'Pro Extensions & Addons', 'lm-certificate-publisher' ); ?></span>
                </div>
            </button>
        </div>

        <!-- Main Form & Settings Panels on Right -->
        <div class="lmcp-settings-content">
            <form id="lmcp-settings-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <input type="hidden" name="action" value="lmcp_save_search_settings">
                <input type="hidden" name="lmcp_active_tab" id="lmcp_active_tab" value="<?php echo esc_attr( $lmcp_active_tab_request ); ?>">
                <?php wp_nonce_field( 'lmcp_save_settings_action', 'lmcp_save_settings_nonce' ); ?>

                <!-- ========================================================== -->
                <!-- Tab 1: Search & Shortcodes (Free) -->
                <!-- ========================================================== -->
                <div id="tab-search" class="lmcp-tab-content active-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'search', 18 ); ?> 
                                <?php echo esc_html__( 'Search Field Selection & Configuration', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Select which certificate fields are indexed and matched when visitors search from the frontend widgets.', 'lm-certificate-publisher' ); ?></p>

                            <table class="lmcp-form-table">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Searchable Certificate Fields', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <div style="display:flex; flex-direction:column; gap:10px;">
                                            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                                                <input type="checkbox" name="lmcp_search_fields[]" value="title" <?php checked( in_array( 'title', $lmcp_selected_search_fields, true ) ); ?>>
                                                <span><?php echo esc_html__( 'Certificate Title (Student / Recipient Name)', 'lm-certificate-publisher' ); ?></span>
                                            </label>

                                            <?php if ( ! empty( $lmcp_custom_fields ) ) : ?>
                                                <?php foreach ( $lmcp_custom_fields as $field ) : ?>
                                                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                                                        <input type="checkbox" name="lmcp_search_fields[]" value="<?php echo esc_attr( $field['slug'] ); ?>" <?php checked( in_array( $field['slug'], $lmcp_selected_search_fields, true ) ); ?>>
                                                        <span><?php echo esc_html( $field['name'] ); ?> <code style="color:#64748b; font-size:11px;">(<?php echo esc_html( $field['slug'] ); ?>)</code></span>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <p style="color:#64748b; font-size:12.5px; margin:0;"><?php echo esc_html__( 'No custom fields defined yet. Add custom fields in the Custom Fields menu.', 'lm-certificate-publisher' ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_search_input_label"><?php echo esc_html__( 'Search Field Input Label', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_search_input_label" id="lmcp_search_input_label" value="<?php echo esc_attr( get_option( 'lmcp_search_input_label', get_option( 'lmcp_search_label', __( 'Search Certificate', 'lm-certificate-publisher' ) ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Search Certificate', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'Label rendered above the search bar input on frontend forms.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_search_input_placeholder"><?php echo esc_html__( 'Search Field Input Placeholder', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_search_input_placeholder" id="lmcp_search_input_placeholder" value="<?php echo esc_attr( get_option( 'lmcp_search_input_placeholder', __( 'Enter recipient name, roll no, or certificate ID...', 'lm-certificate-publisher' ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Enter recipient name, roll no, or certificate ID...', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'Placeholder text displayed inside the search input before the user types.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_search_category_label"><?php echo esc_html__( 'Category Filter Dropdown Label', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_search_category_label" id="lmcp_search_category_label" value="<?php echo esc_attr( get_option( 'lmcp_search_category_label', get_option( 'lmcp_category_label', __( 'Certificate Category', 'lm-certificate-publisher' ) ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Certificate Category', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'Label rendered above the category dropdown filter on frontend search forms.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_category_placeholder"><?php echo esc_html__( 'Category Dropdown Placeholder Option', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_category_placeholder" id="lmcp_category_placeholder" value="<?php echo esc_attr( get_option( 'lmcp_category_placeholder', __( 'Select Category / All Categories', 'lm-certificate-publisher' ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Select Category / All Categories', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'First selectable option text in the category dropdown (placeholder).', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_search_tag_label"><?php echo esc_html__( 'Tag Filter Dropdown Label', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_search_tag_label" id="lmcp_search_tag_label" value="<?php echo esc_attr( get_option( 'lmcp_search_tag_label', get_option( 'lmcp_tag_label', __( 'Certificate Tag', 'lm-certificate-publisher' ) ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Certificate Tag', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'Label rendered above the tag dropdown filter on frontend search forms.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_tag_placeholder"><?php echo esc_html__( 'Tag Dropdown Placeholder Option', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_tag_placeholder" id="lmcp_tag_placeholder" value="<?php echo esc_attr( get_option( 'lmcp_tag_placeholder', __( 'Select Tag / All Tags', 'lm-certificate-publisher' ) ) ); ?>" placeholder="<?php echo esc_attr__( 'e.g. Select Tag / All Tags', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'First selectable option text in the tag dropdown (placeholder).', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_search_button_label"><?php echo esc_html__( 'Search Submit Button Text', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_search_button_label" id="lmcp_search_button_label" value="<?php echo esc_attr( get_option( 'lmcp_search_button_label', __( 'Search', 'lm-certificate-publisher' ) ) ); ?>" placeholder="<?php echo esc_attr__( 'Search', 'lm-certificate-publisher' ); ?>" class="regular-text">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Shortcodes Hub Card -->
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'copy', 18 ); ?> 
                                <?php echo esc_html__( 'Available Frontend Shortcodes', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Copy and paste these shortcodes onto any page, post, or Elementor page to render search widgets.', 'lm-certificate-publisher' ); ?></p>

                            <table class="lmcp-data-table">
                                <thead>
                                    <tr>
                                        <th style="width:280px;"><?php echo esc_html__( 'Shortcode', 'lm-certificate-publisher' ); ?></th>
                                        <th><?php echo esc_html__( 'Description & Output Behavior', 'lm-certificate-publisher' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="lmcp-code-badge lmcp-copy-shortcode" data-shortcode="[lmc_certificate_search]">[lmc_certificate_search]</span>
                                        </td>
                                        <td>
                                            <strong><?php echo esc_html__( 'Simple Certificate Search', 'lm-certificate-publisher' ); ?></strong><br>
                                            <span style="color:#64748b; font-size:12.5px;"><?php echo esc_html__( 'Instant AJAX search bar with print button. Searches configured metadata fields.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="lmcp-code-badge lmcp-copy-shortcode" data-shortcode="[lmc_certificate_search_categories]">[lmc_certificate_search_categories]</span>
                                        </td>
                                        <td>
                                            <strong><?php echo esc_html__( 'Category Filtered Search', 'lm-certificate-publisher' ); ?></strong><br>
                                            <span style="color:#64748b; font-size:12.5px;"><?php echo esc_html__( 'Search bar with interactive category dropdown filter.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="lmcp-code-badge lmcp-copy-shortcode" data-shortcode="[lmc_certificate_search_tags_categories]">[lmc_certificate_search_tags_categories]</span>
                                        </td>
                                        <td>
                                            <strong><?php echo esc_html__( 'Combined Category & Tag Search', 'lm-certificate-publisher' ); ?></strong><br>
                                            <span style="color:#64748b; font-size:12.5px;"><?php echo esc_html__( 'Search bar with dual dropdown selectors for precise department and year filtering.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 2: Templates & Style (Free + Pro Showcase) -->
                <!-- ========================================================== -->
                <?php
                $lmcp_current_template   = get_option( 'lmcp_certificate_template', 'vertical' );
                $lmcp_btn_bg_color       = get_option( 'lmcp_btn_bg_color', get_option( 'lmcp_admin_primary_color', '#14bda9' ) );
                if ( empty( $lmcp_btn_bg_color ) ) $lmcp_btn_bg_color = '#14bda9';
                $lmcp_btn_text_color     = get_option( 'lmcp_btn_text_color', '#ffffff' );
                if ( empty( $lmcp_btn_text_color ) ) $lmcp_btn_text_color = '#ffffff';
                $lmcp_btn_hover_bg_color = get_option( 'lmcp_btn_hover_bg_color', '#0ea391' );
                if ( empty( $lmcp_btn_hover_bg_color ) ) $lmcp_btn_hover_bg_color = '#0ea391';
                $lmcp_btn_border_radius  = get_option( 'lmcp_btn_border_radius', '6px' );
                $lmcp_form_border_color  = get_option( 'lmcp_form_border_color', '#e2e8f0' );
                $lmcp_form_border_radius = get_option( 'lmcp_form_border_radius', '8px' );
                $lmcp_card_bg_color      = get_option( 'lmcp_card_bg_color', '#ffffff' );
                $lmcp_card_border_color  = get_option( 'lmcp_card_border_color', '#e2e8f0' );
                $lmcp_card_border_radius = get_option( 'lmcp_card_border_radius', '8px' );
                ?>
                <div id="tab-layout" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'palette', 18 ); ?> 
                                <?php echo esc_html__( 'Templates & Styling Configuration', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Choose your frontend certificate presentation template, customize button labels, button colors, and result container styling.', 'lm-certificate-publisher' ); ?></p>

                            <!-- Advanced Rendering Engines (PRO Showcase) - Brought to Top -->
                            <div class="lmcp-pro-feature-banner" style="margin-top: 12px; margin-bottom: 20px;">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'sparkles', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Custom HTML5 & Elementor Canvas Engine', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Design certificates with drag-and-drop Elementor canvas templates, or code custom HTML5/CSS3 templates with dynamic merge tags, custom fonts, and PDF printing.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Get CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <div class="lmcp-engine-selector-grid" style="margin-bottom: 28px;">
                                <div class="lmcp-engine-option" style="opacity: 0.95;">
                                    <div class="lmcp-engine-header-row">
                                        <div class="lmcp-engine-icon-pill" style="background:#fdf2f8; color:#db2777;">
                                            <?php echo lmcp_icon( 'palette', 20 ); ?>
                                        </div>
                                        <span class="lmcp-pro-tag">PRO</span>
                                    </div>
                                    <div class="lmcp-engine-title">
                                        <?php echo esc_html__( 'Elementor Theme Builder Engine', 'lm-certificate-publisher' ); ?>
                                    </div>
                                    <div class="lmcp-engine-desc">
                                        <?php echo esc_html__( 'Full drag-and-drop on-canvas design using Elementor section templates and dynamic tag bindings for marksheets, signatures, and QR codes.', 'lm-certificate-publisher' ); ?>
                                    </div>
                                </div>
                                <div class="lmcp-engine-option" style="opacity: 0.95;">
                                    <div class="lmcp-engine-header-row">
                                        <div class="lmcp-engine-icon-pill">
                                            <?php echo lmcp_icon( 'code', 20 ); ?>
                                        </div>
                                        <span class="lmcp-pro-tag">PRO</span>
                                    </div>
                                    <div class="lmcp-engine-title">
                                        <?php echo esc_html__( 'Custom HTML5 & CSS3 Engine', 'lm-certificate-publisher' ); ?>
                                    </div>
                                    <div class="lmcp-engine-desc">
                                        <?php echo esc_html__( 'Pure responsive HTML5/CSS3 certificate generation with zero third-party dependencies, instant rendering, and scoped print stylesheet.', 'lm-certificate-publisher' ); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 1: Template Selection -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 4px;">
                                    <?php echo lmcp_icon( 'palette', 16 ); ?> <?php echo esc_html__( 'Certificate Display Template / Layout', 'lm-certificate-publisher' ); ?>
                                </h3>

                                <div class="lmcp-template-picker-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 16px; margin: 16px 0 20px 0;">
                                    <!-- Template 1: Modern Vertical / Stacked Layout (DEFAULT) -->
                                    <label class="lmcp-template-card" style="border: 2px solid <?php echo $lmcp_current_template === 'vertical' ? 'var(--lmcp-primary-color, #14bda9)' : '#e2e8f0'; ?>; border-radius: 10px; padding: 18px; cursor: pointer; display: flex; flex-direction: column; justify-content: space-between; background: <?php echo $lmcp_current_template === 'vertical' ? '#f0fdfa' : '#ffffff'; ?>; transition: all 0.2s ease;">
                                        <div>
                                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                                <span style="font-weight: 700; font-size: 14.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                                    <input type="radio" name="lmcp_certificate_template" value="vertical" <?php checked( $lmcp_current_template, 'vertical' ); ?> style="margin: 0;">
                                                    <?php echo esc_html__( 'Modern Vertical / Stacked', 'lm-certificate-publisher' ); ?>
                                                </span>
                                                <span style="font-size: 11px; font-weight: 700; background: #ccfbf1; color: #0f766e; padding: 2px 7px; border-radius: 4px;"><?php echo esc_html__( 'Default (Recommended)', 'lm-certificate-publisher' ); ?></span>
                                            </div>
                                            <!-- Mini visual illustration of vertical layout -->
                                            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; margin-bottom: 12px;">
                                                <div style="background: var(--lmcp-primary-color, #14bda9); height: 8px; border-radius: 2px; width: 40px; margin-bottom: 4px;"></div>
                                                <div style="background: #0f172a; height: 11px; border-radius: 2px; margin-bottom: 8px; width: 85%;"></div>
                                                <div style="margin-bottom: 5px;">
                                                    <div style="background: #94a3b8; height: 6px; width: 30%; border-radius: 2px; margin-bottom: 3px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 75%; border-radius: 2px;"></div>
                                                </div>
                                                <div style="margin-bottom: 5px;">
                                                    <div style="background: #94a3b8; height: 6px; width: 35%; border-radius: 2px; margin-bottom: 3px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 90%; border-radius: 2px;"></div>
                                                </div>
                                                <div>
                                                    <div style="background: #94a3b8; height: 6px; width: 25%; border-radius: 2px; margin-bottom: 3px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 60%; border-radius: 2px;"></div>
                                                </div>
                                            </div>
                                            <p style="font-size: 12.5px; color: #64748b; margin: 0; line-height: 1.5;">
                                                <?php echo esc_html__( 'Modern stacked vertical layout: Certificate title rendered at top banner, then each field neatly stacked with Heading on top and Value below.', 'lm-certificate-publisher' ); ?>
                                            </p>
                                        </div>
                                    </label>

                                    <!-- Template 2: Classic Horizontal Table -->
                                    <label class="lmcp-template-card" style="border: 2px solid <?php echo $lmcp_current_template === 'horizontal' ? 'var(--lmcp-primary-color, #14bda9)' : '#e2e8f0'; ?>; border-radius: 10px; padding: 18px; cursor: pointer; display: flex; flex-direction: column; justify-content: space-between; background: <?php echo $lmcp_current_template === 'horizontal' ? '#f0fdfa' : '#ffffff'; ?>; transition: all 0.2s ease;">
                                        <div>
                                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                                <span style="font-weight: 700; font-size: 14.5px; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                                    <input type="radio" name="lmcp_certificate_template" value="horizontal" <?php checked( $lmcp_current_template, 'horizontal' ); ?> style="margin: 0;">
                                                    <?php echo esc_html__( 'Classic Horizontal Table', 'lm-certificate-publisher' ); ?>
                                                </span>
                                                <span style="font-size: 11px; font-weight: 700; background: #e2e8f0; color: #475569; padding: 2px 7px; border-radius: 4px;"><?php echo esc_html__( 'Classic Rows', 'lm-certificate-publisher' ); ?></span>
                                            </div>
                                            <!-- Mini visual illustration of horizontal layout -->
                                            <div style="background: #ffffff; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px; margin-bottom: 12px;">
                                                <div style="background: #0f172a; height: 10px; border-radius: 2px; margin-bottom: 8px; width: 65%;"></div>
                                                <div style="display: flex; gap: 8px; margin-bottom: 5px;">
                                                    <div style="background: #e2e8f0; height: 8px; width: 35%; border-radius: 2px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 65%; border-radius: 2px;"></div>
                                                </div>
                                                <div style="display: flex; gap: 8px; margin-bottom: 5px;">
                                                    <div style="background: #e2e8f0; height: 8px; width: 35%; border-radius: 2px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 65%; border-radius: 2px;"></div>
                                                </div>
                                                <div style="display: flex; gap: 8px;">
                                                    <div style="background: #e2e8f0; height: 8px; width: 35%; border-radius: 2px;"></div>
                                                    <div style="background: #cbd5e1; height: 8px; width: 65%; border-radius: 2px;"></div>
                                                </div>
                                            </div>
                                            <p style="font-size: 12.5px; color: #64748b; margin: 0; line-height: 1.5;">
                                                <?php echo esc_html__( 'Traditional 2-column table: Certificate title at top table header, field labels on left, and corresponding student values on right.', 'lm-certificate-publisher' ); ?>
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Section 2: Action Button Labels -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 4px;">
                                    <?php echo lmcp_icon( 'bolt', 16 ); ?> <?php echo esc_html__( 'Button Labels & Call-to-Actions', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_search_button_label"><?php echo esc_html__( 'Search Submit Button Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_search_button_label" id="lmcp_search_button_label" value="<?php echo esc_attr( get_option( 'lmcp_search_button_label', __( 'Search', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Label on the search submission button.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_print_button"><?php echo esc_html__( 'Print Certificate Button Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_print_button" id="lmcp_label_print_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_print_button', __( 'Print Results', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Label on the print action button.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_download_pdf_button"><?php echo esc_html__( 'Download Document / PDF Button Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_download_pdf_button" id="lmcp_label_download_pdf_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_download_pdf_button', __( 'Download Document', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Button text for file / PDF download attachments.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_reset_button"><?php echo esc_html__( 'Clear / Reset Button Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_reset_button" id="lmcp_label_reset_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_reset_button', __( 'Clear', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Label used for reset / clear controls.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_verify_button"><?php echo esc_html__( 'Verified Link Button Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_verify_button" id="lmcp_label_verify_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_verify_button', __( 'View Verified Link', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Text displayed for clickable verification URL fields.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_certificate_badge"><?php echo esc_html__( 'Vertical Template Top Badge Text', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_certificate_badge" id="lmcp_label_certificate_badge" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_certificate_badge', __( 'Official Certificate Record', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Badge rendered at the top of the Modern Vertical layout card.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Section 3: Button Styling & Colors -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 4px;">
                                    <?php echo lmcp_icon( 'palette', 16 ); ?> <?php echo esc_html__( 'Buttons Styling & Colors', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_btn_bg_color"><?php echo esc_html__( 'Button Background Color', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <input type="color" value="<?php echo esc_attr( $lmcp_btn_bg_color ); ?>" onchange="document.getElementById('lmcp_btn_bg_color').value=this.value" style="width: 40px; height: 38px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                                <input type="text" name="lmcp_btn_bg_color" id="lmcp_btn_bg_color" value="<?php echo esc_attr( $lmcp_btn_bg_color ); ?>" class="regular-text" style="width: 140px;">
                                            </div>
                                            <span class="description"><?php echo esc_html__( 'Primary color applied to search and download action buttons.', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_btn_text_color"><?php echo esc_html__( 'Button Text Color', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <input type="color" value="<?php echo esc_attr( $lmcp_btn_text_color ); ?>" onchange="document.getElementById('lmcp_btn_text_color').value=this.value" style="width: 40px; height: 38px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                                <input type="text" name="lmcp_btn_text_color" id="lmcp_btn_text_color" value="<?php echo esc_attr( $lmcp_btn_text_color ); ?>" class="regular-text" style="width: 140px;">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_btn_hover_bg_color"><?php echo esc_html__( 'Button Hover Background Color', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <input type="color" value="<?php echo esc_attr( $lmcp_btn_hover_bg_color ); ?>" onchange="document.getElementById('lmcp_btn_hover_bg_color').value=this.value" style="width: 40px; height: 38px; padding: 2px; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer;">
                                                <input type="text" name="lmcp_btn_hover_bg_color" id="lmcp_btn_hover_bg_color" value="<?php echo esc_attr( $lmcp_btn_hover_bg_color ); ?>" class="regular-text" style="width: 140px;">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_btn_border_radius"><?php echo esc_html__( 'Button Corner Radius', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <select name="lmcp_btn_border_radius" id="lmcp_btn_border_radius">
                                                <option value="0px" <?php selected( $lmcp_btn_border_radius, '0px' ); ?>><?php echo esc_html__( 'Square (0px)', 'lm-certificate-publisher' ); ?></option>
                                                <option value="4px" <?php selected( $lmcp_btn_border_radius, '4px' ); ?>><?php echo esc_html__( 'Subtle (4px)', 'lm-certificate-publisher' ); ?></option>
                                                <option value="6px" <?php selected( $lmcp_btn_border_radius, '6px' ); ?>><?php echo esc_html__( 'Standard (6px - Default)', 'lm-certificate-publisher' ); ?></option>
                                                <option value="8px" <?php selected( $lmcp_btn_border_radius, '8px' ); ?>><?php echo esc_html__( 'Rounded (8px)', 'lm-certificate-publisher' ); ?></option>
                                                <option value="12px" <?php selected( $lmcp_btn_border_radius, '12px' ); ?>><?php echo esc_html__( 'Extra Rounded (12px)', 'lm-certificate-publisher' ); ?></option>
                                                <option value="24px" <?php selected( $lmcp_btn_border_radius, '24px' ); ?>><?php echo esc_html__( 'Pill Shaped (24px)', 'lm-certificate-publisher' ); ?></option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Section 4: Search Form & Card Containers Styling -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 4px;">
                                    <?php echo lmcp_icon( 'box', 16 ); ?> <?php echo esc_html__( 'Search Form & Result Cards Styling', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_search_form_bg_color"><?php echo esc_html__( 'Search Form Background', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_search_form_bg_color" id="lmcp_search_form_bg_color" value="<?php echo esc_attr( get_option( 'lmcp_search_form_bg_color', '#f8fafc' ) ); ?>" placeholder="e.g. #f8fafc or transparent" class="regular-text">
                                            <span class="description"><?php echo esc_html__( 'Custom background for frontend search form (hex, rgb, or transparent).', 'lm-certificate-publisher' ); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_form_border_color"><?php echo esc_html__( 'Form Border Color', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_form_border_color" id="lmcp_form_border_color" value="<?php echo esc_attr( $lmcp_form_border_color ); ?>" placeholder="#e2e8f0" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_form_border_radius"><?php echo esc_html__( 'Form Border Radius', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <select name="lmcp_form_border_radius" id="lmcp_form_border_radius">
                                                <option value="4px" <?php selected( $lmcp_form_border_radius, '4px' ); ?>>4px</option>
                                                <option value="8px" <?php selected( $lmcp_form_border_radius, '8px' ); ?>>8px (Default)</option>
                                                <option value="12px" <?php selected( $lmcp_form_border_radius, '12px' ); ?>>12px</option>
                                                <option value="16px" <?php selected( $lmcp_form_border_radius, '16px' ); ?>>16px</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_card_bg_color"><?php echo esc_html__( 'Results Card Background', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_card_bg_color" id="lmcp_card_bg_color" value="<?php echo esc_attr( $lmcp_card_bg_color ); ?>" placeholder="#ffffff" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_card_border_color"><?php echo esc_html__( 'Results Card Border Color', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_card_border_color" id="lmcp_card_border_color" value="<?php echo esc_attr( $lmcp_card_border_color ); ?>" placeholder="#e2e8f0" class="regular-text">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 3: Frontend Text & Labels (FREE - FULL FEATURE) -->
                <!-- ========================================================== -->
                <div id="tab-labels" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'globe', 18 ); ?> 
                                <?php echo esc_html__( 'Frontend Text & Labels Customizer (No-Code Translation)', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Translate or customize global certificate action buttons, interactive feedback, and metadata labels without editing PHP code or translation files.', 'lm-certificate-publisher' ); ?></p>

                            <!-- Group 1: Action Buttons & Controls -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <?php echo lmcp_icon( 'bolt', 16 ); ?> <?php echo esc_html__( 'Action Buttons & Controls', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_label_print_button"><?php echo esc_html__( 'Print Certificate Button', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_print_button" id="lmcp_label_print_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_print_button', __( 'Print Certificate', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_download_pdf_button"><?php echo esc_html__( 'Download PDF Button', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_download_pdf_button" id="lmcp_label_download_pdf_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_download_pdf_button', __( 'Download PDF', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_fullscreen_button"><?php echo esc_html__( 'Full Screen Button', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_fullscreen_button" id="lmcp_label_fullscreen_button" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_fullscreen_button', __( 'Full Screen', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_share_copy_link"><?php echo esc_html__( 'Copy Link Button', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_share_copy_link" id="lmcp_label_share_copy_link" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_share_copy_link', __( 'Copy Link', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_copied"><?php echo esc_html__( 'Link Copied Confirmation', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_copied" id="lmcp_label_copied" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_copied', __( 'Copied to clipboard!', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Group 2: Interactive Feedback & Status Indicators -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <?php echo lmcp_icon( 'alert', 16 ); ?> <?php echo esc_html__( 'Interactive Feedback & Status Indicators', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_label_searching"><?php echo esc_html__( '"Searching..." State Text', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_searching" id="lmcp_label_searching" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_searching', __( 'Searching...', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_preloader_text"><?php echo esc_html__( 'Preloader Verification Text', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_preloader_text" id="lmcp_label_preloader_text" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_preloader_text', __( 'Verifying certificate credentials, please wait...', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text" style="width:100%; max-width:480px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_no_results"><?php echo esc_html__( 'No Records Found Message', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_no_results" id="lmcp_label_no_results" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_no_results', __( 'No certificate records found matching your query.', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text" style="width:100%; max-width:480px;">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Group 3: Certificate Metadata Labels -->
                            <div style="margin-bottom: 28px;">
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <?php echo lmcp_icon( 'code', 16 ); ?> <?php echo esc_html__( 'Certificate Metadata & Verification Labels', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_label_scan_to_verify"><?php echo esc_html__( 'Scan to Verify Text', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_scan_to_verify" id="lmcp_label_scan_to_verify" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_scan_to_verify', __( 'Scan to Verify', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_certificate_code"><?php echo esc_html__( 'Verification Code Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_certificate_code" id="lmcp_label_certificate_code" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_certificate_code', __( 'Verification Code:', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_serial_number"><?php echo esc_html__( 'Serial Number Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_serial_number" id="lmcp_label_serial_number" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_serial_number', __( 'Serial Number:', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_issuer"><?php echo esc_html__( 'Issuer Organization Label', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_issuer" id="lmcp_label_issuer" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_issuer', __( 'Issued by:', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Group 4: Social Sharing Labels -->
                            <div>
                                <h3 style="font-size: 14.5px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 7px; padding-bottom: 8px; border-bottom: 1px solid #e2e8f0;">
                                    <?php echo lmcp_icon( 'share', 16 ); ?> <?php echo esc_html__( 'Social Sharing Toolbar Labels', 'lm-certificate-publisher' ); ?>
                                </h3>
                                <table class="lmcp-form-table">
                                    <tr>
                                        <th><label for="lmcp_label_share_heading"><?php echo esc_html__( 'Social Share Bar Heading', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_share_heading" id="lmcp_label_share_heading" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_share_heading', __( 'Share & Add to Profile', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="lmcp_label_share_linkedin"><?php echo esc_html__( 'LinkedIn Button Text', 'lm-certificate-publisher' ); ?></label></th>
                                        <td>
                                            <input type="text" name="lmcp_label_share_linkedin" id="lmcp_label_share_linkedin" value="<?php echo esc_attr( lmcp_get_label( 'lmcp_label_share_linkedin', __( 'Add to LinkedIn', 'lm-certificate-publisher' ) ) ); ?>" class="regular-text">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 4: Social Sharing & LinkedIn (FREE - FULL FEATURE) -->
                <!-- ========================================================== -->
                <div id="tab-social" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'share', 18 ); ?> 
                                <?php echo esc_html__( 'One-Click Social Sharing & LinkedIn "Add to Profile"', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Allow students and recipients to publish verified certificates directly to their official LinkedIn profile and share achievements across WhatsApp, X (Twitter), and Facebook.', 'lm-certificate-publisher' ); ?></p>

                            <table class="lmcp-form-table">
                                <tr>
                                    <th><label for="lmcp_enable_social_sharing"><?php echo esc_html__( 'Enable Social Sharing Toolbar', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_enable_social_sharing" id="lmcp_enable_social_sharing" value="yes" <?php checked( get_option( 'lmcp_enable_social_sharing', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Display the sharing bar underneath certificate search results and views.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_linkedin"><?php echo esc_html__( 'LinkedIn "Add to Profile"', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_social_share_linkedin" id="lmcp_social_share_linkedin" value="yes" <?php checked( get_option( 'lmcp_social_share_linkedin', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Directly opens LinkedIn Certification composer pre-filling credential name, issuing organization, and verification link.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_linkedin_org_name"><?php echo esc_html__( 'LinkedIn Issuing Organization Name', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_social_linkedin_org_name" id="lmcp_social_linkedin_org_name" value="<?php echo esc_attr( get_option( 'lmcp_social_linkedin_org_name', get_bloginfo( 'name' ) ) ); ?>" class="regular-text">
                                        <span class="description"><?php echo esc_html__( 'The academy, school, university, or company name associated with the credential.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_whatsapp"><?php echo esc_html__( 'WhatsApp 1-Click Sharing', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_social_share_whatsapp" id="lmcp_social_share_whatsapp" value="yes" <?php checked( get_option( 'lmcp_social_share_whatsapp', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_x"><?php echo esc_html__( 'X (Twitter) Sharing', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_social_share_x" id="lmcp_social_share_x" value="yes" <?php checked( get_option( 'lmcp_social_share_x', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_facebook"><?php echo esc_html__( 'Facebook Sharing', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_social_share_facebook" id="lmcp_social_share_facebook" value="yes" <?php checked( get_option( 'lmcp_social_share_facebook', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_copylink"><?php echo esc_html__( '1-Click Copy Verification Link', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_social_share_copylink" id="lmcp_social_share_copylink" value="yes" <?php checked( get_option( 'lmcp_social_share_copylink', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_social_share_template"><?php echo esc_html__( 'Social Broadcast Message Template', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <textarea name="lmcp_social_share_template" id="lmcp_social_share_template" rows="3" class="large-text"><?php echo esc_textarea( get_option( 'lmcp_social_share_template', 'I am excited to share my official certificate for "{certificate_title}" issued by {site_name}! Verify here:' ) ); ?></textarea>
                                        <span class="description"><?php echo esc_html__( 'Available dynamic tags: {certificate_title}, {site_name}', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>

                            <!-- Interactive Live Preview -->
                            <div style="margin-top: 24px; padding: 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <h4 style="margin: 0 0 12px 0; font-size: 13px; color: #475569; font-weight: 700;"><?php echo esc_html__( 'Live Visual Preview of Social Toolbar', 'lm-certificate-publisher' ); ?></h4>
                                <div style="display: inline-flex; flex-wrap: wrap; gap: 8px; align-items: center;">
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #0a66c2; color: #ffffff; padding: 7px 13px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                                        <?php echo esc_html( lmcp_get_label( 'lmcp_label_share_linkedin', __( 'Add to LinkedIn', 'lm-certificate-publisher' ) ) ); ?>
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #25d366; color: #ffffff; padding: 7px 13px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <?php esc_html_e( 'WhatsApp', 'lm-certificate-publisher' ); ?>
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #0f172a; color: #ffffff; padding: 7px 13px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <?php esc_html_e( 'Share', 'lm-certificate-publisher' ); ?>
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #1877f2; color: #ffffff; padding: 7px 13px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <?php esc_html_e( 'Facebook', 'lm-certificate-publisher' ); ?>
                                    </span>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; background: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <?php echo esc_html( lmcp_get_label( 'lmcp_label_share_copy_link', __( 'Copy Link', 'lm-certificate-publisher' ) ) ); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 5: Privacy & Sitemaps (FREE - FULL FEATURE) -->
                <!-- ========================================================== -->
                <div id="tab-privacy" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'lock', 18 ); ?> 
                                <?php echo esc_html__( 'Certificate Privacy & SEO Settings', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Protect student records, personal information, and certificates from being indexed or harvested by search engine crawlers.', 'lm-certificate-publisher' ); ?></p>

                            <table class="lmcp-form-table">
                                <tr>
                                    <th><label for="lmcp_disable_certificate_sitemap"><?php echo esc_html__( 'Exclude from XML Sitemaps', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" id="lmcp_disable_certificate_sitemap" name="lmcp_disable_certificate_sitemap" value="yes" <?php checked( get_option( 'lmcp_disable_certificate_sitemap', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Excludes certificates, categories, and tags from WordPress Core Sitemaps, Yoast SEO, Rank Math, All in One SEO, and SEOPress sitemaps. (Enabled by default).', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_noindex_certificates"><?php echo esc_html__( 'Noindex Single Certificate URLs', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" id="lmcp_noindex_certificates" name="lmcp_noindex_certificates" value="yes" <?php checked( get_option( 'lmcp_noindex_certificates', 'yes' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Instructs Google and search engines not to index single certificate post URLs (adds "noindex, nofollow, noarchive" exclusively to certificate records).', 'lm-certificate-publisher' ); ?></span>

                                        <div style="margin-top: 12px; font-size: 12.5px; color: #15803d; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 10px 14px; display: inline-flex; align-items: center; gap: 8px;">
                                            <span style="font-size: 16px;">🛡️</span>
                                            <span><strong><?php echo esc_html__( 'Strict Safety Guarantee:', 'lm-certificate-publisher' ); ?></strong> <?php echo esc_html__( 'Your site pages, search & verification pages, and regular blog posts are completely untouched and will NEVER be noindexed.', 'lm-certificate-publisher' ); ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_restrict_direct_cert_access"><?php echo esc_html__( 'Block Direct Single Certificate URLs', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" id="lmcp_restrict_direct_cert_access" name="lmcp_restrict_direct_cert_access" value="yes" <?php checked( get_option( 'lmcp_restrict_direct_cert_access', 'no' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'If a visitor navigates directly to a single certificate post URL (e.g. /lmc-certificate/student-name/), safely redirect them to the home page so certificates can only be verified via search.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 6: Serial Numbers (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-serial" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'hash', 18 ); ?> 
                                <?php echo esc_html__( 'Serial Number Configurations', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'hash', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Automated Serial & Anti-Counterfeit Numbers', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Auto-increment and assign tamper-proof sequential numbers (e.g. CERT-2026-00045) with custom prefixes, year tags, and padding.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Auto Serial Numbering', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Automatically generate and assign a unique serial number to each newly published certificate.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'Serial Number Prefix', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" value="CERT-2026-" class="regular-text" disabled style="background:#f8fafc;">
                                        <span class="description"><?php echo esc_html__( 'Prefix prepended to autogenerated counters. Example: CERT-2026-00001', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 7: QR Codes & Print (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-qr" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'qrcode', 18 ); ?> 
                                <?php echo esc_html__( 'QR Codes & PDF Print Settings', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'qrcode', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Dynamic QR Verification & PDF Export Engine', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Generate high-res cryptographic QR codes linking directly to verification screens, plus pixel-perfect vector PDF downloads.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'QR Code Verification Enabler', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Generate secure QR codes linking directly to verification screens.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'QR Code Output Position', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <select disabled style="background:#f8fafc;">
                                            <option><?php echo esc_html__( 'Inside Results Table (Bottom)', 'lm-certificate-publisher' ); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( '1-Click PDF Vector Downloader', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Allow students to download print-ready vector PDF copies instantly.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 8: Expiry & Validity (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-expiry" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'hourglass', 18 ); ?> 
                                <?php echo esc_html__( 'Expiration & Search Visibility Settings', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'hourglass', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Expiration Dates & Validity Badges', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Manage certificate expirations, dynamic days-remaining countdowns, expired alert banners, and category-level expiry templates.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Certificate Expiration Feature', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'Display Validity Note', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Prints remaining days until expiry dynamically underneath verification queries.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 9: Email Settings (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-email" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'mail', 18 ); ?> 
                                <?php echo esc_html__( 'Email Notification & Templates Configuration', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'mail', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Automated Student Email Delivery', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Instantly dispatch congratulations emails with PDF attachments and direct verification links when certificates are published.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Send Auto Notifications', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Dispatch auto-emails to student recipients as soon as their certificate is published.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'Email Notification Subject', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" value="Your Certificate from {site_name}" class="regular-text" disabled style="background:#f8fafc;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 10: reCAPTCHA Security (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-recaptcha" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'shield', 18 ); ?> 
                                <?php echo esc_html__( 'Google reCAPTCHA v3 Integration', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'shield', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Invisible Anti-Bot & Scraper Shield', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Safeguard your certificate search forms from automated harvesting bots and spam requests using invisible Google reCAPTCHA v3.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Enable Google reCAPTCHA v3', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'reCAPTCHA v3 Site Key', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" value="6Lxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" class="regular-text" disabled style="background:#f8fafc;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 11: Search Preloader (PRO Showcase) -->
                <!-- ========================================================== -->
                <div id="tab-preloader" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'bolt', 18 ); ?> 
                                <?php echo esc_html__( 'Search Preloader & Loading Animation Settings', 'lm-certificate-publisher' ); ?>
                            </h2>

                            <div class="lmcp-pro-feature-banner">
                                <div class="lmcp-pro-banner-left">
                                    <div class="lmcp-pro-banner-icon">
                                        <?php echo lmcp_icon( 'bolt', 22 ); ?>
                                    </div>
                                    <div>
                                        <h3 class="lmcp-pro-banner-title">
                                            <span><?php echo esc_html__( 'Interactive Animated Preloader & Spinners', 'lm-certificate-publisher' ); ?></span>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </h3>
                                        <p class="lmcp-pro-banner-desc">
                                            <?php echo esc_html__( 'Present an elegant verification loading animation or upload a branded animated GIF/SVG while verifying certificate queries.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn">
                                    <?php echo esc_html__( 'Upgrade to CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                </a>
                            </div>

                            <table class="lmcp-form-table" style="opacity: 0.85;">
                                <tr>
                                    <th><label><?php echo esc_html__( 'Enable Search Preloader', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" disabled>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label><?php echo esc_html__( 'Preloader Theme / Type', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <select disabled style="background:#f8fafc;">
                                            <option><?php echo esc_html__( 'Elegant Modern Spinner (Default)', 'lm-certificate-publisher' ); ?></option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 12: Whitelabel Settings (FREE - FULL FEATURE) -->
                <!-- ========================================================== -->
                <div id="tab-whitelabel" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'tag', 18 ); ?> 
                                <?php echo esc_html__( 'Whitelabel Settings', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Customize brand identity, logo, colors, and admin navigation of the certificate platform.', 'lm-certificate-publisher' ); ?></p>

                            <table class="lmcp-form-table">
                                <tr>
                                    <th><label for="lmcp_admin_logo"><?php echo esc_html__( 'Custom Admin Logo URL', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <div style="display: flex; gap: 8px; max-width: 480px;">
                                            <input type="text" name="lmcp_admin_logo" id="lmcp_admin_logo" value="<?php echo esc_attr( $lmcp_admin_logo ); ?>" class="regular-text" style="flex:1;" placeholder="https://example.com/logo.png">
                                        </div>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Upload a custom logo to display on the top-right corner of Certificate admin pages.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_admin_menu_name"><?php echo esc_html__( 'Admin Menu Sidebar Name', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <input type="text" name="lmcp_admin_menu_name" id="lmcp_admin_menu_name" value="<?php echo esc_attr( $lmcp_admin_menu_name ); ?>" class="regular-text" style="max-width:350px;">
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Change the label of the Certificates menu item in the WordPress sidebar.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_admin_primary_color"><?php echo esc_html__( 'Theme Primary Accent Color', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <div style="display: flex; gap: 10px; align-items: center;">
                                            <input type="color" name="lmcp_admin_primary_color_picker" id="lmcp_admin_primary_color_picker" value="<?php echo esc_attr( $lmcp_admin_primary_color ); ?>" style="width: 50px; height: 38px; padding: 2px; border: 1px solid #d2d6dc; border-radius: 6px; cursor: pointer; background: none;">
                                            <input type="text" name="lmcp_admin_primary_color" id="lmcp_admin_primary_color" value="<?php echo esc_attr( $lmcp_admin_primary_color ); ?>" style="width: 120px;" placeholder="#14bda9">
                                        </div>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Set primary brand color for the admin panel (buttons, active tabs, toggle switches).', 'lm-certificate-publisher' ); ?></span>
                                        <script>
                                        jQuery(document).ready(function($){
                                            $('#lmcp_admin_primary_color_picker').on('input change', function(){
                                                $('#lmcp_admin_primary_color').val($(this).val());
                                            });
                                            $('#lmcp_admin_primary_color').on('input change', function(){
                                                var val = $(this).val();
                                                if(/^#[0-9A-F]{6}$/i.test(val)) {
                                                    $('#lmcp_admin_primary_color_picker').val(val);
                                                }
                                            });
                                        });
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="lmcp_whitelabel_remove_credits"><?php echo esc_html__( 'Remove Footer Credits', 'lm-certificate-publisher' ); ?></label></th>
                                    <td>
                                        <label class="lmcp-toggle-switch">
                                            <input type="checkbox" name="lmcp_whitelabel_remove_credits" id="lmcp_whitelabel_remove_credits" value="yes" <?php checked( get_option( 'lmcp_whitelabel_remove_credits', 'no' ), 'yes' ); ?>>
                                            <span class="lmcp-toggle-slider"></span>
                                        </label>
                                        <span class="description" style="display:block; margin-top:6px;"><?php echo esc_html__( 'Remove credit or developer attribution lines from public search forms.', 'lm-certificate-publisher' ); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 13: Export & Import Hub (FREE CSV + PRO XML) -->
                <!-- ========================================================== -->
                <div id="tab-export-import" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'box', 18 ); ?> 
                                <?php echo esc_html__( 'Certificate Export & Import Hub', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Quickly batch import certificates via spreadsheet or backup full marksheet datasets.', 'lm-certificate-publisher' ); ?></p>

                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-top: 15px;">
                                <!-- CSV Card (Free) -->
                                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 10px;">
                                            <span style="color:#0f766e;"><?php echo lmcp_icon( 'file', 18 ); ?></span>
                                            <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;"><?php echo esc_html__( 'CSV Spreadsheet Import', 'lm-certificate-publisher' ); ?></h3>
                                        </div>
                                        <p style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 20px;">
                                            <?php echo esc_html__( 'Import hundreds of student records from Excel / Google Sheets spreadsheets with custom fields.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <a href="<?php echo esc_url( admin_url( 'admin.php?action=lmcp_download_demo_csv&_wpnonce=' . wp_create_nonce( 'lmcp_download_demo_csv_nonce' ) ) ); ?>" class="lmcp-button lmcp-button-secondary">
                                            <?php echo lmcp_icon( 'download', 14 ); ?> <?php echo esc_html__( 'Download Demo CSV', 'lm-certificate-publisher' ); ?>
                                        </a>
                                        <a href="<?php echo esc_url( admin_url( 'admin.php?page=lmcp_bulk_operations' ) ); ?>" class="lmcp-button lmcp-button-primary">
                                            <?php echo lmcp_icon( 'box', 14 ); ?> <?php echo esc_html__( 'Open Bulk Importer', 'lm-certificate-publisher' ); ?>
                                        </a>
                                    </div>
                                </div>

                                <!-- XML Deep Marksheet Backup (Pro) -->
                                <div style="background: #ffffff; border: 1px solid #fde68a; border-radius: 8px; padding: 22px; display: flex; flex-direction: column; justify-content: space-between;">
                                    <div>
                                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <span style="color:#d97706;"><?php echo lmcp_icon( 'sparkles', 18 ); ?></span>
                                                <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #92400e;"><?php echo esc_html__( 'XML Deep Marksheet Backup', 'lm-certificate-publisher' ); ?></h3>
                                            </div>
                                            <span class="lmcp-pro-tag">PRO</span>
                                        </div>
                                        <p style="font-size: 13px; color: #78350f; line-height: 1.5; margin-bottom: 20px;">
                                            <?php echo esc_html__( 'Full dataset backup and 1-click restore including nested subject marksheet tables, serial numbers, and token keys.', 'lm-certificate-publisher' ); ?>
                                        </p>
                                    </div>
                                    <a href="<?php echo esc_url( $lmcp_pro_purchase_url ); ?>" target="_blank" class="lmcp-pro-btn" style="text-align: center; justify-content: center;">
                                        <?php echo esc_html__( 'Unlock in CertifyPress Pro', 'lm-certificate-publisher' ); ?> &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========================================================== -->
                <!-- Tab 14: Pro Extensions & Addons -->
                <!-- ========================================================== -->
                <div id="tab-extensions" class="lmcp-tab-content">
                    <div class="lmcp-card">
                        <div class="lmcp-card-body">
                            <h2 class="lmcp-tab-panel-title">
                                <?php echo lmcp_icon( 'plug', 18 ); ?> 
                                <?php echo esc_html__( 'CertifyPress Ecosystem Extensions & Addons', 'lm-certificate-publisher' ); ?>
                            </h2>
                            <p class="description"><?php echo esc_html__( 'Extend your certification system with dedicated modules for WooCommerce, ACF, Divi, student portals, and frontend profiles.', 'lm-certificate-publisher' ); ?></p>

                            <div class="lmcp-extensions-grid">
                                <!-- Extension 1: WooCommerce -->
                                <div class="lmcp-extension-card">
                                    <div>
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                            <div class="lmcp-header-icon-box">
                                                <?php echo lmcp_icon( 'cart', 20 ); ?>
                                            </div>
                                            <span class="lmcp-pro-tag">PRO EXTENSION</span>
                                        </div>
                                        <h3 class="lmcp-extension-title"><?php echo esc_html__( 'WooCommerce Auto-Issuance', 'lm-certificate-publisher' ); ?></h3>
                                        <p class="lmcp-extension-desc"><?php echo esc_html__( 'Automatically generate and issue verified certificates immediately upon course or product checkout.', 'lm-certificate-publisher' ); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( $lmcp_extensions_url ); ?>" target="_blank" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__( 'Learn More', 'lm-certificate-publisher' ); ?> &rarr;</a>
                                </div>

                                <!-- Extension 2: ACF Importer -->
                                <div class="lmcp-extension-card">
                                    <div>
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                            <div class="lmcp-header-icon-box">
                                                <?php echo lmcp_icon( 'code', 20 ); ?>
                                            </div>
                                            <span class="lmcp-pro-tag">PRO EXTENSION</span>
                                        </div>
                                        <h3 class="lmcp-extension-title"><?php echo esc_html__( 'ACF Field Importer', 'lm-certificate-publisher' ); ?></h3>
                                        <p class="lmcp-extension-desc"><?php echo esc_html__( 'Sync Advanced Custom Fields (ACF) directly into certificate records and templates seamlessly.', 'lm-certificate-publisher' ); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( $lmcp_extensions_url ); ?>" target="_blank" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__( 'Learn More', 'lm-certificate-publisher' ); ?> &rarr;</a>
                                </div>

                                <!-- Extension 3: Student Portal -->
                                <div class="lmcp-extension-card">
                                    <div>
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                            <div class="lmcp-header-icon-box">
                                                <?php echo lmcp_icon( 'cap', 20 ); ?>
                                            </div>
                                            <span class="lmcp-pro-tag">PRO EXTENSION</span>
                                        </div>
                                        <h3 class="lmcp-extension-title"><?php echo esc_html__( 'Student Portal Vault', 'lm-certificate-publisher' ); ?></h3>
                                        <p class="lmcp-extension-desc"><?php echo esc_html__( 'Frontend login dashboard with ID cards, downloadable marksheets, and document vaults for registered students.', 'lm-certificate-publisher' ); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( $lmcp_extensions_url ); ?>" target="_blank" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__( 'Learn More', 'lm-certificate-publisher' ); ?> &rarr;</a>
                                </div>

                                <!-- Extension 4: Divi Builder Addon -->
                                <div class="lmcp-extension-card">
                                    <div>
                                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                                            <div class="lmcp-header-icon-box">
                                                <?php echo lmcp_icon( 'palette', 20 ); ?>
                                            </div>
                                            <span class="lmcp-pro-tag">PRO EXTENSION</span>
                                        </div>
                                        <h3 class="lmcp-extension-title"><?php echo esc_html__( 'Divi Builder Integration', 'lm-certificate-publisher' ); ?></h3>
                                        <p class="lmcp-extension-desc"><?php echo esc_html__( 'Native Divi modules for instant certificate searches, QR scanners, and student credential cards.', 'lm-certificate-publisher' ); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( $lmcp_extensions_url ); ?>" target="_blank" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__( 'Learn More', 'lm-certificate-publisher' ); ?> &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Sticky Form Save Actions -->
                <div class="lmcp-form-actions" style="background:#ffffff; border:1px solid #e2e8f0; border-radius:8px; padding:16px 24px; box-shadow:0 1px 3px rgba(15,23,42,0.03);">
                    <button type="submit" class="lmcp-button lmcp-button-primary" style="font-weight:600; padding:10px 22px;">
                        <?php echo lmcp_icon( 'check', 15 ); ?> <?php echo esc_html__( 'Save Options', 'lm-certificate-publisher' ); ?>
                    </button>
                    <span style="color:#64748b; font-size:13px;">
                        <?php echo esc_html__( 'Your certificate search, label translations, social sharing, and privacy settings will be updated immediately.', 'lm-certificate-publisher' ); ?>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
