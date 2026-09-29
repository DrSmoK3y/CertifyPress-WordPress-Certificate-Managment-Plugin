<?php
/**
 * View: Certificate Tags & Categories Management
 * 
 * @package LM_Certificate_Publisher
 */

if (!defined('ABSPATH')) {
    exit;
}

$lmcp_admin_logo = get_option('lmcp_admin_logo', '');
$lmcp_pro_url = 'https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin';
?>

<div class="wrap lmcp-admin-wrapper">
    <div class="lmcp-page-header">
        <div class="lmcp-header-title-group">
            <?php if (!empty($lmcp_admin_logo)) : ?>
                <div class="lmcp-header-logo-box">
                    <img src="<?php echo esc_url($lmcp_admin_logo); ?>" alt="Logo" class="lmcp-header-logo-img">
                </div>
            <?php else : ?>
                <div class="lmcp-header-icon-box">
                    <?php echo lmcp_icon('tag', 22); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__('LM Certificate Publisher', 'lm-certificate-publisher'); ?> &mdash; <?php echo esc_html__('Certificate Taxonomies (Categories & Tags)', 'lm-certificate-publisher'); ?></h1>
                <p class="lmcp-page-description"><?php echo esc_html__('Categorize, filter, and structure certificate records by departments, courses, programs, or years.', 'lm-certificate-publisher'); ?></p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <a href="<?php echo esc_url($lmcp_pro_url); ?>" target="_blank" class="lmcp-pro-upgrade-btn">
                <?php echo lmcp_icon('sparkles', 14); ?> <?php echo esc_html__('Upgrade to CertifyPress Pro', 'lm-certificate-publisher'); ?>
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
        <!-- Card 1: Categories -->
        <div class="lmcp-card" style="margin-bottom: 0;">
            <div class="lmcp-card-header">
                <h2><?php echo lmcp_icon('folder', 16); ?> <?php echo esc_html__('Certificate Categories', 'lm-certificate-publisher'); ?></h2>
            </div>
            <div class="lmcp-card-body">
                <p class="description"><?php echo esc_html__('Hierarchical groupings for main credentials (e.g. "Diploma", "Short Course", "Academic Degree"). Categories can be used as dropdown filters on search forms.', 'lm-certificate-publisher'); ?></p>
                <div style="margin-top: 20px;">
                    <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=lmc_certificate_category&post_type=lmc_certificate')); ?>" class="lmcp-button lmcp-button-primary">
                        <?php echo lmcp_icon('settings', 14); ?> <?php echo esc_html__('Manage Categories in WP', 'lm-certificate-publisher'); ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2: Tags -->
        <div class="lmcp-card" style="margin-bottom: 0;">
            <div class="lmcp-card-header">
                <h2><?php echo lmcp_icon('tag', 16); ?> <?php echo esc_html__('Certificate Tags', 'lm-certificate-publisher'); ?></h2>
            </div>
            <div class="lmcp-card-body">
                <p class="description"><?php echo esc_html__('Non-hierarchical labels for specific attributes (e.g. "2026", "Spring Semester", "Honors", "Online"). Tags allow flexible multi-faceted filtering on results.', 'lm-certificate-publisher'); ?></p>
                <div style="margin-top: 20px;">
                    <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=lmc_certificate_tag&post_type=lmc_certificate')); ?>" class="lmcp-button lmcp-button-primary">
                        <?php echo lmcp_icon('settings', 14); ?> <?php echo esc_html__('Manage Tags in WP', 'lm-certificate-publisher'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Usage Best Practices -->
    <div class="lmcp-card" style="margin-top: 24px;">
        <div class="lmcp-card-header">
            <h2><?php echo esc_html__('Taxonomy Best Practices', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body" style="padding: 0;">
            <table class="lmcp-data-table">
                <thead>
                    <tr>
                        <th style="width: 180px;"><?php echo esc_html__('Feature', 'lm-certificate-publisher'); ?></th>
                        <th><?php echo esc_html__('Recommended Usage & Application', 'lm-certificate-publisher'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong><?php echo esc_html__('Categories', 'lm-certificate-publisher'); ?></strong></td>
                        <td><?php echo esc_html__('Group certificates by high-level course types or issuing faculties. In Pro, each category can render with a completely unique Elementor visual template.', 'lm-certificate-publisher'); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo esc_html__('Tags', 'lm-certificate-publisher'); ?></strong></td>
                        <td><?php echo esc_html__('Tag certificates with terms like graduation years ("2025", "2026") or instructor names for secondary filtering.', 'lm-certificate-publisher'); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo esc_html__('Shortcodes', 'lm-certificate-publisher'); ?></strong></td>
                        <td><?php echo esc_html__('Use shortcode [lmc_search_field] on any page with category and tag parameters to render tailored search forms.', 'lm-certificate-publisher'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
