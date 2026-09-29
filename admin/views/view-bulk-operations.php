<?php
/**
 * View: Bulk Operations & CSV Import (Free Edition)
 * 
 * @package LM_Certificate_Publisher
 */

if (!defined('ABSPATH')) {
    exit;
}

$lmcp_admin_logo = get_option('lmcp_admin_logo', '');
$lmcp_pro_url = 'https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin';
$lmcp_demo_nonce = wp_create_nonce('lmcp_download_demo_csv_nonce');
$lmcp_demo_url = admin_url('admin.php?action=lmcp_download_demo_csv&_wpnonce=' . $lmcp_demo_nonce);
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
                    <?php echo lmcp_icon('box', 22); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__('LM Certificate Publisher', 'lm-certificate-publisher'); ?> &mdash; <?php echo esc_html__('Bulk Operations & CSV Import', 'lm-certificate-publisher'); ?></h1>
                <p class="lmcp-page-description"><?php echo esc_html__('Batch import hundreds of student certificates, generate template records, and export CSV files.', 'lm-certificate-publisher'); ?></p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <a href="<?php echo esc_url($lmcp_demo_url); ?>" class="lmcp-button lmcp-button-secondary">
                <?php echo lmcp_icon('download', 14); ?> <?php echo esc_html__('Download Demo CSV', 'lm-certificate-publisher'); ?>
            </a>
            <a href="<?php echo esc_url($lmcp_pro_url); ?>" target="_blank" class="lmcp-pro-upgrade-btn">
                <?php echo lmcp_icon('sparkles', 14); ?> <?php echo esc_html__('Upgrade to CertifyPress Pro', 'lm-certificate-publisher'); ?>
            </a>
        </div>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] === 'imported') : ?>
            <div class="lmcp-notice success">
                <?php 
                $count = isset($_GET['count']) ? intval($_GET['count']) : 0;
                printf(esc_html__('Successfully imported %d certificate records from CSV.', 'lm-certificate-publisher'), $count); 
                ?>
            </div>
        <?php elseif ($_GET['message'] === 'error_file') : ?>
            <div class="lmcp-notice error">
                <?php echo esc_html__('Error: Please upload a valid, well-formed CSV file.', 'lm-certificate-publisher'); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Import Card -->
    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2><?php echo lmcp_icon('box', 16); ?> <?php echo esc_html__('Import Certificates via CSV File', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="lmcp_import_csv">
                <?php wp_nonce_field('lmcp_csv_import_action', 'lmcp_csv_import_nonce'); ?>

                <table class="lmcp-form-table">
                    <tr>
                        <th><label for="csv_file"><?php echo esc_html__('Select CSV Data File', 'lm-certificate-publisher'); ?> <span style="color:#dc2626;">*</span></label></th>
                        <td>
                            <input type="file" name="csv_file" id="csv_file" accept=".csv" required style="padding:8px 0;">
                            <span class="description"><?php echo esc_html__('Upload a standard UTF-8 comma-separated CSV file containing certificate titles and custom field columns.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php echo esc_html__('Demo Sample Template', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <a href="<?php echo esc_url($lmcp_demo_url); ?>" class="lmcp-button lmcp-button-secondary" style="height:36px; padding:0 14px; font-size:13px;">
                                <?php echo lmcp_icon('download', 14); ?> <?php echo esc_html__('Download Sample Demo CSV', 'lm-certificate-publisher'); ?>
                            </a>
                            <span class="description"><?php echo esc_html__('Download a sample CSV file containing all currently configured custom fields and taxonomies as header columns.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                </table>

                <div class="lmcp-form-actions">
                    <button type="submit" class="lmcp-button lmcp-button-primary">
                        <?php echo lmcp_icon('box', 14); ?> <?php echo esc_html__('Start CSV Import Process', 'lm-certificate-publisher'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- CSV Format Guide Table -->
    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2><?php echo lmcp_icon('settings', 16); ?> <?php echo esc_html__('CSV Header Column Specifications', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body" style="padding: 0;">
            <table class="lmcp-data-table">
                <thead>
                    <tr>
                        <th style="width: 240px;"><?php echo esc_html__('Column Header', 'lm-certificate-publisher'); ?></th>
                        <th style="width: 140px;"><?php echo esc_html__('Required / Type', 'lm-certificate-publisher'); ?></th>
                        <th><?php echo esc_html__('Description & Expected Values', 'lm-certificate-publisher'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>certificate_title</code></td>
                        <td><span style="color:#dc2626; font-weight:700;"><?php echo esc_html__('Required', 'lm-certificate-publisher'); ?></span></td>
                        <td><?php echo esc_html__('Recipient name and main identifying certificate title.', 'lm-certificate-publisher'); ?></td>
                    </tr>
                    <?php 
                    $custom_fields = get_option('lmcp_custom_fields', array());
                    if (!empty($custom_fields)) :
                        foreach ($custom_fields as $f) : ?>
                            <tr>
                                <td><code><?php echo esc_html($f['slug']); ?></code></td>
                                <td><span style="color:#64748b; font-weight:600;"><?php echo esc_html__('Custom Field', 'lm-certificate-publisher'); ?></span></td>
                                <td><?php printf(esc_html__('Custom field "%s" (%s format).', 'lm-certificate-publisher'), esc_html($f['name']), esc_html($f['type'])); ?></td>
                            </tr>
                        <?php endforeach;
                    endif; ?>
                    <tr>
                        <td><code>category:{slug}</code></td>
                        <td><span style="color:#64748b; font-weight:600;"><?php echo esc_html__('Optional (Taxonomy)', 'lm-certificate-publisher'); ?></span></td>
                        <td><?php echo esc_html__('Set "1" to assign category or "0" to skip (e.g. category:diploma).', 'lm-certificate-publisher'); ?></td>
                    </tr>
                    <tr>
                        <td><code>tag:{slug}</code></td>
                        <td><span style="color:#64748b; font-weight:600;"><?php echo esc_html__('Optional (Taxonomy)', 'lm-certificate-publisher'); ?></span></td>
                        <td><?php echo esc_html__('Set "1" to assign tag or "0" to skip (e.g. tag:2026).', 'lm-certificate-publisher'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
