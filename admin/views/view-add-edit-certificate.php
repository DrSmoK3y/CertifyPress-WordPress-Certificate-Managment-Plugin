<?php
/**
 * View: Add / Edit Certificate Record
 * 
 * @package LM_Certificate_Publisher
 */

if (!defined('ABSPATH')) {
    exit;
}

$lmcp_editing = false;
$lmcp_certificate_id = filter_input(INPUT_GET, 'cert_id', FILTER_VALIDATE_INT);
if (!$lmcp_certificate_id) {
    $lmcp_certificate_id = filter_input(INPUT_GET, 'edit_certificate', FILTER_VALIDATE_INT);
}

$lmcp_certificate = null;
if ($lmcp_certificate_id && $lmcp_certificate_id > 0) {
    $lmcp_certificate = get_post($lmcp_certificate_id);
    if ($lmcp_certificate && $lmcp_certificate->post_type === 'lmc_certificate') {
        $lmcp_editing = true;
    }
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
                    <?php echo lmcp_icon('cap', 22); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__('LM Certificate Publisher', 'lm-certificate-publisher'); ?> &mdash; <?php echo $lmcp_editing ? esc_html__('Edit Certificate Record', 'lm-certificate-publisher') : esc_html__('Add New Certificate Record', 'lm-certificate-publisher'); ?></h1>
                <p class="lmcp-page-description">
                    <?php echo $lmcp_editing ? esc_html__('Update certificate information, custom fields, and categories.', 'lm-certificate-publisher') : esc_html__('Publish a new certificate record with structured custom metadata.', 'lm-certificate-publisher'); ?>
                </p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <a href="<?php echo esc_url(admin_url('admin.php?page=lmcp_all_certificates')); ?>" class="lmcp-button lmcp-button-secondary">
                <?php echo lmcp_icon('arrow-left', 14); ?> <?php echo esc_html__('Back to All Certificates', 'lm-certificate-publisher'); ?>
            </a>
            <a href="<?php echo esc_url($lmcp_pro_url); ?>" target="_blank" class="lmcp-pro-upgrade-btn">
                <?php echo lmcp_icon('sparkles', 14); ?> <?php echo esc_html__('Upgrade to CertifyPress Pro', 'lm-certificate-publisher'); ?>
            </a>
        </div>
    </div>

    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2><?php echo esc_html__('Certificate Metadata & Information', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="lmcp_process_add_edit_certificate">
                <?php wp_nonce_field('lmcp_save_certificate', 'lmcp_certificate_nonce'); ?>

                <?php if ($lmcp_editing) : ?>
                    <input type="hidden" name="certificate_id" value="<?php echo esc_attr($lmcp_certificate_id); ?>">
                <?php endif; ?>

                <table class="lmcp-form-table">
                    <!-- Title -->
                    <tr>
                        <th><label for="certificate_title"><?php echo esc_html__('Certificate Title / Recipient', 'lm-certificate-publisher'); ?> <span style="color:#dc2626;">*</span></label></th>
                        <td>
                            <input type="text" name="certificate_title" id="certificate_title" value="<?php echo ($lmcp_editing && $lmcp_certificate ? esc_attr($lmcp_certificate->post_title) : ''); ?>" placeholder="<?php echo esc_attr__('e.g. John Doe - Full Stack Web Development', 'lm-certificate-publisher'); ?>" required>
                            <span class="description"><?php echo esc_html__('Main identifying title for this certificate record.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>

                    <?php
                    $lmcp_custom_fields = get_option('lmcp_custom_fields', array());
                    $lmcp_all_categories = get_terms(array('taxonomy' => 'lmc_certificate_category', 'hide_empty' => false));
                    $lmcp_all_tags = get_terms(array('taxonomy' => 'lmc_certificate_tag', 'hide_empty' => false));

                    $lmcp_meta_values = array();
                    $lmcp_selected_categories = array();
                    $lmcp_selected_tags = array();

                    if ($lmcp_editing) {
                        foreach ($lmcp_custom_fields as $lmcp_field) {
                            $lmcp_meta_values[$lmcp_field['slug']] = get_post_meta($lmcp_certificate_id, $lmcp_field['slug'], true);
                        }
                        $lmcp_cat_terms = wp_get_object_terms($lmcp_certificate_id, 'lmc_certificate_category', array('fields' => 'ids'));
                        if (!is_wp_error($lmcp_cat_terms)) $lmcp_selected_categories = $lmcp_cat_terms;

                        $lmcp_tag_terms = wp_get_object_terms($lmcp_certificate_id, 'lmc_certificate_tag', array('fields' => 'ids'));
                        if (!is_wp_error($lmcp_tag_terms)) $lmcp_selected_tags = $lmcp_tag_terms;
                    }
                    ?>

                    <!-- Custom Fields -->
                    <?php if (!empty($lmcp_custom_fields)) : foreach ($lmcp_custom_fields as $lmcp_field) : ?>
                        <?php
                        $lmcp_slug  = $lmcp_field['slug'];
                        $lmcp_label = $lmcp_field['name'];
                        $lmcp_type  = isset($lmcp_field['type']) ? $lmcp_field['type'] : 'text';
                        $lmcp_value = isset($lmcp_meta_values[$lmcp_slug]) ? $lmcp_meta_values[$lmcp_slug] : (isset($lmcp_field['default_value']) ? $lmcp_field['default_value'] : '');
                        ?>
                        <tr>
                            <th><label for="<?php echo esc_attr($lmcp_slug); ?>"><?php echo esc_html($lmcp_label); ?></label></th>
                            <td>
                                <?php if ($lmcp_type === 'image' || $lmcp_type === 'image_upload' || $lmcp_type === 'file' || $lmcp_type === 'file_upload') : ?>
                                    <div class="lmcp-upload-group" style="display: flex; gap: 8px; max-width: 520px;">
                                        <input type="text" name="<?php echo esc_attr($lmcp_slug); ?>" id="<?php echo esc_attr($lmcp_slug); ?>" value="<?php echo esc_attr($lmcp_value); ?>" style="flex: 1;" placeholder="https://example.com/asset.jpg">
                                        <button type="button" class="lmcp-upload-button lmcp-button lmcp-button-secondary" data-target="<?php echo esc_attr($lmcp_slug); ?>"><?php echo lmcp_icon('folder', 14); ?> <?php echo esc_html__('Select Asset', 'lm-certificate-publisher'); ?></button>
                                    </div>
                                    <span class="description"><?php echo esc_html__('Upload or select media asset from WordPress library.', 'lm-certificate-publisher'); ?></span>
                                <?php elseif ($lmcp_type === 'table') : ?>
                                    <?php
                                    $table_rows = isset($lmcp_field['default_rows']) ? intval($lmcp_field['default_rows']) : 3;
                                    $table_cols = isset($lmcp_field['default_columns']) ? intval($lmcp_field['default_columns']) : 3;
                                    $table_headers = isset($lmcp_field['column_headers']) && !empty($lmcp_field['column_headers']) ? explode(',', $lmcp_field['column_headers']) : array();
                                    $saved_table_data = is_array($lmcp_value) ? $lmcp_value : json_decode($lmcp_value, true);
                                    ?>
                                    <div style="overflow-x: auto; max-width: 650px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px;">
                                        <table style="width: 100%; border-collapse: collapse;">
                                            <thead>
                                                <tr>
                                                    <?php for ($c = 0; $c < $table_cols; $c++) : ?>
                                                        <th style="padding: 6px; text-align: left; font-size: 12px; color: #475569;">
                                                             <?php echo isset($table_headers[$c]) ? esc_html(trim($table_headers[$c])) : sprintf(esc_html__('Col %d', 'lm-certificate-publisher'), $c + 1); ?>
                                                        </th>
                                                    <?php endfor; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($r = 0; $r < $table_rows; $r++) : ?>
                                                    <tr>
                                                        <?php for ($c = 0; $c < $table_cols; $c++) : ?>
                                                            <?php $cell_val = isset($saved_table_data[$r][$c]) ? $saved_table_data[$r][$c] : ''; ?>
                                                            <td style="padding: 4px;">
                                                                <input type="text" name="<?php echo esc_attr($lmcp_slug); ?>[<?php echo $r; ?>][<?php echo $c; ?>]" value="<?php echo esc_attr($cell_val); ?>" style="width: 100%; height: 32px; font-size: 12.5px;">
                                                            </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <span class="description"><?php echo esc_html__('Fill table entries for marksheets / academic reports.', 'lm-certificate-publisher'); ?></span>
                                <?php elseif ($lmcp_type === 'key') : ?>
                                    <input type="text" name="<?php echo esc_attr($lmcp_slug); ?>" id="<?php echo esc_attr($lmcp_slug); ?>" value="<?php echo esc_attr($lmcp_value ? $lmcp_value : strtoupper(wp_generate_password(10, false))); ?>" readonly style="background: #f1f5f9; font-family: monospace;">
                                    <span class="description"><?php echo esc_html__('Auto-generated security token key.', 'lm-certificate-publisher'); ?></span>
                                <?php else : ?>
                                    <input type="<?php echo esc_attr($lmcp_type === 'date' ? 'date' : ($lmcp_type === 'number' ? 'number' : 'text')); ?>" name="<?php echo esc_attr($lmcp_slug); ?>" id="<?php echo esc_attr($lmcp_slug); ?>" value="<?php echo esc_attr($lmcp_value); ?>" placeholder="<?php echo esc_attr( sprintf( __( 'Enter %s...', 'lm-certificate-publisher' ), $lmcp_label ) ); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr>
                            <td colspan="2">
                                <div class="lmcp-notice info" style="margin: 0;">
                                    <?php echo sprintf(wp_kses_post(__('No custom fields configured yet. <a href="%s">Add custom fields</a> to capture student names, roll numbers, grades, or dates.', 'lm-certificate-publisher')), esc_url(admin_url('admin.php?page=lmcp_custom_fields'))); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Categories -->
                    <tr>
                        <th><label for="certificate_categories"><?php echo esc_html__('Certificate Categories', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <select name="certificate_categories[]" id="certificate_categories" multiple="multiple" style="height: 110px; width: 100%; max-width: 500px;" data-placeholder="<?php echo esc_attr__('Select categories...', 'lm-certificate-publisher'); ?>">
                            <option value="" disabled <?php echo empty($lmcp_selected_categories) ? 'selected' : ''; ?>><?php echo esc_html__('-- Select Category / Categories --', 'lm-certificate-publisher'); ?></option>
                            <?php if (!empty($lmcp_all_categories) && !is_wp_error($lmcp_all_categories)) : foreach ($lmcp_all_categories as $lmcp_cat) : ?>
                                <option value="<?php echo intval($lmcp_cat->term_id); ?>" <?php selected(in_array($lmcp_cat->term_id, $lmcp_selected_categories, true)); ?>><?php echo esc_html($lmcp_cat->name); ?></option>
                            <?php endforeach; else : ?>
                                <option value="" disabled><?php echo esc_html__('No categories created yet', 'lm-certificate-publisher'); ?></option>
                            <?php endif; ?>
                            </select>
                            <span class="description"><?php echo esc_html__('Select one or more categories for this certificate record (hold Ctrl/Cmd on Mac to select multiple).', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>

                    <!-- Tags -->
                    <tr>
                        <th><label for="certificate_tags"><?php echo esc_html__('Certificate Tags', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <select name="certificate_tags[]" id="certificate_tags" multiple="multiple" style="height: 110px; width: 100%; max-width: 500px;" data-placeholder="<?php echo esc_attr__('Select tags...', 'lm-certificate-publisher'); ?>">
                            <option value="" disabled <?php echo empty($lmcp_selected_tags) ? 'selected' : ''; ?>><?php echo esc_html__('-- Select Tag / Tags --', 'lm-certificate-publisher'); ?></option>
                            <?php if (!empty($lmcp_all_tags) && !is_wp_error($lmcp_all_tags)) : foreach ($lmcp_all_tags as $lmcp_tag) : ?>
                                <option value="<?php echo intval($lmcp_tag->term_id); ?>" <?php selected(in_array($lmcp_tag->term_id, $lmcp_selected_tags, true)); ?>><?php echo esc_html($lmcp_tag->name); ?></option>
                            <?php endforeach; else : ?>
                                <option value="" disabled><?php echo esc_html__('No tags created yet', 'lm-certificate-publisher'); ?></option>
                            <?php endif; ?>
                            </select>
                            <span class="description"><?php echo esc_html__('Select one or more tags for this certificate record (hold Ctrl/Cmd on Mac to select multiple).', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                </table>

                <div class="lmcp-form-actions">
                    <button type="submit" name="publish" class="lmcp-button lmcp-button-primary"><?php echo $lmcp_editing ? esc_html__('Update Certificate', 'lm-certificate-publisher') : esc_html__('Publish Certificate', 'lm-certificate-publisher'); ?></button>
                    <button type="submit" name="save_as_draft" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__('Save as Draft', 'lm-certificate-publisher'); ?></button>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=lmcp_all_certificates')); ?>" class="lmcp-button lmcp-button-secondary"><?php echo esc_html__('Cancel', 'lm-certificate-publisher'); ?></a>
                </div>
            </form>
        </div>
    </div>
</div>
