<?php
/**
 * View: Custom Fields Management (Free Edition with Pro Locked Showcase)
 * 
 * @package LM_Certificate_Publisher
 */

if (!defined('ABSPATH')) {
    exit;
}

$lmcp_pro_purchase_url = 'https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin';
$lmcp_extensions_url   = 'https://certifypress.site/#extensions';
$lmcp_admin_logo       = get_option('lmcp_admin_logo', '');

if (!function_exists('lmcp_icon')) {
    function lmcp_icon($name, $size = 16) {
        $icons = array(
            'palette'    => '<path d="M12 3a9 9 0 1 0 0 18h1.5a2 2 0 0 0 2-2v-.3a1.7 1.7 0 0 1 1.7-1.7H18a3 3 0 0 0 3-3 9 9 0 0 0-9-11Z"/><circle cx="7.5" cy="12" r="1.1"/><circle cx="9.5" cy="8" r="1.1"/><circle cx="14.5" cy="8" r="1.1"/><circle cx="16.5" cy="12" r="1.1"/>',
            'hash'       => '<path d="M5 9h14M5 15h14M10 3 8 21M16 3l-2 18"/>',
            'qrcode'     => '<rect x="3.5" y="3.5" width="6.5" height="6.5" rx="1"/><rect x="14" y="3.5" width="6.5" height="6.5" rx="1"/><rect x="3.5" y="14" width="6.5" height="6.5" rx="1"/><path d="M14 14h3v3h-3zM20.5 14v3M14 20.5h3M20.5 20.5h.01"/>',
            'lock'       => '<rect x="4.5" y="10.5" width="15" height="10" rx="2"/><path d="M8 10.5V7a4 4 0 0 1 8 0v3.5"/>',
            'sparkles'   => '<path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3L12 3Z"/>',
            'edit'       => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>'
        );

        if (!isset($icons[$name])) {
            return '';
        }

        return sprintf(
            '<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%2$s</svg>',
            (int)$size,
            $icons[$name]
        );
    }
}
?>

<div class="wrap lmcp-admin-wrapper">
    <!-- Header -->
    <div class="lmcp-page-header">
        <div class="lmcp-header-title-group">
            <?php if (!empty($lmcp_admin_logo)) : ?>
                <div class="lmcp-header-logo-box">
                    <img src="<?php echo esc_url($lmcp_admin_logo); ?>" alt="Logo" class="lmcp-header-logo-img">
                </div>
            <?php else : ?>
                <div class="lmcp-header-icon-box">
                    <?php echo lmcp_icon('edit', 22); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__('LM Certificate Publisher', 'lm-certificate-publisher'); ?> &mdash; <?php echo esc_html__('Custom Certificate Fields', 'lm-certificate-publisher'); ?></h1>
                <p class="lmcp-page-description"><?php echo esc_html__('Define dynamic metadata fields (Student Name, Roll Number, Passing Year, Marksheet Tables, Token Keys) for certificate records.', 'lm-certificate-publisher'); ?></p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-pro-upgrade-btn">
                <?php echo lmcp_icon('sparkles', 14); ?> <?php echo esc_html__('Upgrade to CertifyPress Pro', 'lm-certificate-publisher'); ?>
            </a>
        </div>
    </div>

    <?php if (isset($_GET['message'])) : ?>
        <?php if ($_GET['message'] === 'field_added') : ?>
            <div class="lmcp-notice success"><?php echo esc_html__('Custom field created successfully.', 'lm-certificate-publisher'); ?></div>
        <?php elseif ($_GET['message'] === 'field_deleted') : ?>
            <div class="lmcp-notice success"><?php echo esc_html__('Custom field removed successfully.', 'lm-certificate-publisher'); ?></div>
        <?php elseif ($_GET['message'] === 'order_saved') : ?>
            <div class="lmcp-notice success"><?php echo esc_html__('Fields display order updated successfully.', 'lm-certificate-publisher'); ?></div>
        <?php elseif ($_GET['message'] === 'field_exists') : ?>
            <div class="lmcp-notice error"><?php echo esc_html__('A field with this slug already exists. Please choose a unique field name or slug.', 'lm-certificate-publisher'); ?></div>
        <?php elseif ($_GET['message'] === 'invalid_nonce' || $_GET['message'] === 'empty_name') : ?>
            <div class="lmcp-notice error"><?php echo esc_html__('Error: Please fill in a valid field name.', 'lm-certificate-publisher'); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Card 1: Add New Field -->
    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2><?php echo esc_html__('Add New Certificate Field', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="lmcp_add_custom_field">
                <?php wp_nonce_field('lmcp_add_field_nonce', 'lmcp_field_nonce'); ?>

                <table class="lmcp-form-table">
                    <tr>
                        <th><label for="field_name"><?php echo esc_html__('Field Label / Name', 'lm-certificate-publisher'); ?> <span style="color:#dc2626;">*</span></label></th>
                        <td>
                            <input type="text" name="field_name" id="field_name" placeholder="<?php echo esc_attr__('e.g. Student Full Name, Passing Grade, Course Title', 'lm-certificate-publisher'); ?>" required>
                            <span class="description"><?php echo esc_html__('Human-readable name displayed on admin forms and search result tables.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_slug"><?php echo esc_html__('Field Slug (Optional)', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <input type="text" name="field_slug" id="field_slug" placeholder="<?php echo esc_attr__('e.g. student_name, course_title', 'lm-certificate-publisher'); ?>">
                            <span class="description"><?php echo esc_html__('Unique identifier. Leave blank to automatically generate from the field name.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_type"><?php echo esc_html__('Field Input Type', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <select name="field_type" id="field_type">
                                <option value="text"><?php echo esc_html__('Text (Single line)', 'lm-certificate-publisher'); ?></option>
                                <option value="number"><?php echo esc_html__('Number (Numeric values, roll no, marks)', 'lm-certificate-publisher'); ?></option>
                                <option value="url"><?php echo esc_html__('URL (External web link)', 'lm-certificate-publisher'); ?></option>
                                <option value="date"><?php echo esc_html__('Date (Calendar picker)', 'lm-certificate-publisher'); ?></option>
                                <option value="image_upload"><?php echo esc_html__('Image Upload (Student photo, badge, seal)', 'lm-certificate-publisher'); ?></option>
                                <option value="file_upload"><?php echo esc_html__('File Upload (Attachment, transcript document)', 'lm-certificate-publisher'); ?></option>
                                <option value="table"><?php echo esc_html__('Dynamic Table (Multi-row marksheet / grades list)', 'lm-certificate-publisher'); ?></option>
                                <option value="key"><?php echo esc_html__('KEY (Auto-generated unique token)', 'lm-certificate-publisher'); ?></option>
                            </select>
                            <span class="description"><?php echo esc_html__('Select the format of data this field will store.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr id="lmcp-default-value-row">
                        <th><label for="field_default_value"><?php echo esc_html__('Default Pre-filled Value', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <input type="text" name="field_default_value" id="field_default_value" placeholder="<?php echo esc_attr__('e.g. Completed, Grade A, Computer Science', 'lm-certificate-publisher'); ?>">
                            <span class="description"><?php echo esc_html__('Optional pre-filled value when creating new certificates.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr id="lmcp-table-config-row" style="display:none;">
                        <th><label for="field_default_rows"><?php echo esc_html__('Default Rows', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <input type="number" name="field_default_rows" id="field_default_rows" value="3" min="1" max="50">
                            <span class="description"><?php echo esc_html__('Default number of data rows for marksheets.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr id="lmcp-table-config-col" style="display:none;">
                        <th><label for="field_default_columns"><?php echo esc_html__('Default Columns', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <input type="number" name="field_default_columns" id="field_default_columns" value="3" min="1" max="20">
                            <span class="description"><?php echo esc_html__('Number of columns for the table.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                    <tr id="lmcp-table-config-headers" style="display:none;">
                        <th><label for="field_column_headers"><?php echo esc_html__('Column Headers', 'lm-certificate-publisher'); ?></label></th>
                        <td>
                            <input type="text" name="field_column_headers" id="field_column_headers" placeholder="<?php echo esc_attr__('e.g. Subject, Marks, Grade', 'lm-certificate-publisher'); ?>">
                            <span class="description"><?php echo esc_html__('Comma-separated headers. Leave blank for generic Column 1, Column 2, etc.', 'lm-certificate-publisher'); ?></span>
                        </td>
                    </tr>
                </table>

                <div class="lmcp-form-actions">
                    <button type="submit" class="lmcp-button lmcp-button-primary"><?php echo esc_html__('Add Custom Field', 'lm-certificate-publisher'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card 2: Existing Active Fields -->
    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2><?php echo esc_html__('Active Certificate Fields', 'lm-certificate-publisher'); ?></h2>
        </div>
        <div class="lmcp-card-body" style="padding: 0;">
            <?php $lmcp_custom_fields = get_option('lmcp_custom_fields', array()); ?>
            <form id="lmcp-field-order-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="lmcp_save_field_order">
                <?php wp_nonce_field('lmcp_save_field', 'lmcp_field_nonce'); ?>
                
                <?php if (!empty($lmcp_custom_fields)) : ?>
                    <table class="lmcp-data-table">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align:center;"><?php echo esc_html__('Move', 'lm-certificate-publisher'); ?></th>
                                <th><?php echo esc_html__('Field Name', 'lm-certificate-publisher'); ?></th>
                                <th style="width: 220px;"><?php echo esc_html__('Field Slug (Click to copy)', 'lm-certificate-publisher'); ?></th>
                                <th style="width: 140px;"><?php echo esc_html__('Type', 'lm-certificate-publisher'); ?></th>
                                <th style="width: 100px; text-align: right;"><?php echo esc_html__('Action', 'lm-certificate-publisher'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="lmcp-sortable-fields">
                        <?php foreach ($lmcp_custom_fields as $lmcp_field) : ?>
                            <?php
                            $lmcp_delete_nonce = wp_create_nonce('lmcp_delete_field_' . $lmcp_field['slug']);
                            $lmcp_delete_url = admin_url('admin.php?page=lmcp_custom_fields&action=delete_field&field_slug=' . $lmcp_field['slug'] . '&_wpnonce=' . $lmcp_delete_nonce);
                            ?>
                            <tr data-slug="<?php echo esc_attr($lmcp_field['slug']); ?>">
                                <td class="lmcp-sort-handle">&#x2630;</td>
                                <td>
                                    <strong><?php echo esc_html($lmcp_field['name']); ?></strong>
                                    <?php if (!empty($lmcp_field['default_value'])) : ?>
                                        <div style="font-size: 11.5px; margin-top: 3px; color: #64748b;">
                                            <span><?php echo esc_html__('Default:', 'lm-certificate-publisher'); ?></span> 
                                            <code><?php echo esc_html($lmcp_field['default_value']); ?></code>
                                        </div>
                                    <?php endif; ?>
                                    <input type="hidden" name="field_order[]" value="<?php echo esc_attr($lmcp_field['slug']); ?>">
                                </td>
                                <td>
                                    <code class="lmcp-copy-slug" title="<?php echo esc_attr__('Click to copy slug', 'lm-certificate-publisher'); ?>"><?php echo esc_html($lmcp_field['slug']); ?></code>
                                </td>
                                <td>
                                    <?php 
                                    if ($lmcp_field['type'] === 'table') {
                                        $rows = isset($lmcp_field['default_rows']) ? intval($lmcp_field['default_rows']) : 3;
                                        $cols = isset($lmcp_field['default_columns']) ? intval($lmcp_field['default_columns']) : 3;
                                        echo esc_html(sprintf(__('Table (%dx%d)', 'lm-certificate-publisher'), $cols, $rows));
                                    } else {
                                        echo esc_html(ucfirst($lmcp_field['type']));
                                    }
                                    ?>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?php echo esc_url($lmcp_delete_url); ?>" style="color: #dc2626; text-decoration: none; font-weight: 600;" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this custom field? Existing certificate values for this field will be preserved.', 'lm-certificate-publisher')); ?>');">
                                        <?php echo esc_html__('Delete', 'lm-certificate-publisher'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
                        <button type="submit" class="lmcp-button lmcp-button-primary"><?php echo esc_html__('Save Fields Order', 'lm-certificate-publisher'); ?></button>
                    </div>
                <?php else : ?>
                    <div class="lmcp-empty-state" style="text-align:center; padding:30px;">
                        <h3><?php echo esc_html__('No Custom Fields Yet', 'lm-certificate-publisher'); ?></h3>
                        <p style="color:#64748b;"><?php echo esc_html__('Create your first field above to start collecting structured certificate data.', 'lm-certificate-publisher'); ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Card 3: PRO Custom Fields Engine (Locked Static Showcase) -->
    <div class="lmcp-card">
        <div class="lmcp-card-header">
            <h2>
                <?php echo lmcp_icon('sparkles', 16); ?> 
                <?php echo esc_html__('PRO Advanced Field Engines (Locked Features)', 'lm-certificate-publisher'); ?>
            </h2>
            <span class="lmcp-pro-pill-badge">PRO ONLY</span>
        </div>
        <div class="lmcp-card-body" style="padding: 0;">
            <table class="lmcp-data-table">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Pro Feature / Field Engine', 'lm-certificate-publisher'); ?></th>
                        <th><?php echo esc_html__('Description & Capabilities', 'lm-certificate-publisher'); ?></th>
                        <th style="width: 140px; text-align: center;"><?php echo esc_html__('Engine Status', 'lm-certificate-publisher'); ?></th>
                        <th style="width: 160px; text-align: right;"><?php echo esc_html__('Action', 'lm-certificate-publisher'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="lmcp-pro-locked-row" style="background:#fff;">
                        <td>
                            <strong>Elementor Dynamic Tags Integration</strong>
                            <span class="lmcp-pro-tag">PRO</span>
                        </td>
                        <td style="color:#64748b; font-size:13px; line-height:1.5;">
                            Exposes all certificate custom fields directly inside Elementor as dynamic tags, allowing drag-and-drop on-canvas certificate generation.
                        </td>
                        <td style="text-align:center;">
                            <span style="display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; color:#64748b; background:#f1f5f9; padding:3px 8px; border-radius:4px;">
                                <?php echo lmcp_icon('lock', 12); ?> LOCKED
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-button lmcp-button-primary" style="height:32px; padding:0 12px; font-size:12px;">
                                Upgrade to Pro
                            </a>
                        </td>
                    </tr>
                    <tr class="lmcp-pro-locked-row" style="background:#fff;">
                        <td>
                            <strong>Dynamic QR Code & Barcode Generator</strong>
                            <span class="lmcp-pro-tag">PRO</span>
                        </td>
                        <td style="color:#64748b; font-size:13px; line-height:1.5;">
                            Auto-generates high-resolution verification QR codes and barcodes embedding student verify URL directly inside the certificate.
                        </td>
                        <td style="text-align:center;">
                            <span style="display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; color:#64748b; background:#f1f5f9; padding:3px 8px; border-radius:4px;">
                                <?php echo lmcp_icon('lock', 12); ?> LOCKED
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-button lmcp-button-primary" style="height:32px; padding:0 12px; font-size:12px;">
                                Upgrade to Pro
                            </a>
                        </td>
                    </tr>
                    <tr class="lmcp-pro-locked-row" style="background:#fff;">
                        <td>
                            <strong>Digital Signature Pad & Canvas</strong>
                            <span class="lmcp-pro-tag">PRO</span>
                        </td>
                        <td style="color:#64748b; font-size:13px; line-height:1.5;">
                            Interactive touchscreen and mouse handwriting signature capture pad for teachers, deans, and certifiers.
                        </td>
                        <td style="text-align:center;">
                            <span style="display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; color:#64748b; background:#f1f5f9; padding:3px 8px; border-radius:4px;">
                                <?php echo lmcp_icon('lock', 12); ?> LOCKED
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-button lmcp-button-primary" style="height:32px; padding:0 12px; font-size:12px;">
                                Upgrade to Pro
                            </a>
                        </td>
                    </tr>
                    <tr class="lmcp-pro-locked-row" style="background:#fff;">
                        <td>
                            <strong>Conditional Field Visibility Rules</strong>
                            <span class="lmcp-pro-tag">PRO</span>
                        </td>
                        <td style="color:#64748b; font-size:13px; line-height:1.5;">
                            Dynamically display or hide custom fields based on certificate category, course type, or issuing department.
                        </td>
                        <td style="text-align:center;">
                            <span style="display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; color:#64748b; background:#f1f5f9; padding:3px 8px; border-radius:4px;">
                                <?php echo lmcp_icon('lock', 12); ?> LOCKED
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-button lmcp-button-primary" style="height:32px; padding:0 12px; font-size:12px;">
                                Upgrade to Pro
                            </a>
                        </td>
                    </tr>
                    <tr class="lmcp-pro-locked-row" style="background:#fff;">
                        <td>
                            <strong>Sequential Auto-Serial Generator Token</strong>
                            <span class="lmcp-pro-tag">PRO</span>
                        </td>
                        <td style="color:#64748b; font-size:13px; line-height:1.5;">
                            Auto-assigns tamper-proof sequential certificate numbers (e.g. CERT-2026-00045) on certificate publication.
                        </td>
                        <td style="text-align:center;">
                            <span style="display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:700; color:#64748b; background:#f1f5f9; padding:3px 8px; border-radius:4px;">
                                <?php echo lmcp_icon('lock', 12); ?> LOCKED
                            </span>
                        </td>
                        <td style="text-align:right;">
                            <a href="<?php echo esc_url($lmcp_pro_purchase_url); ?>" target="_blank" class="lmcp-button lmcp-button-primary" style="height:32px; padding:0 12px; font-size:12px;">
                                Upgrade to Pro
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
