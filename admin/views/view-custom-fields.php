<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wrap sc-admin-wrapper">

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo esc_html__('Custom Certificate Fields', 'certifypress'); ?></h1>
            <p class="sc-page-description"><?php echo esc_html__('Create and manage custom fields for your certificates', 'certifypress'); ?></p>
        </div>
    </div>

    <!-- Notices -->
    <?php 
    if (isset($_GET['message'])) {
        $message = sanitize_text_field(wp_unslash($_GET['message']));
        if ($message == 'added') echo '<div class="sc-notice success">' . esc_html__('Custom field has been added successfully.', 'certifypress') . '</div>';
        if ($message == 'deleted') echo '<div class="sc-notice success">' . esc_html__('Custom field has been deleted successfully.', 'certifypress') . '</div>';
        if ($message == 'order_saved') echo '<div class="sc-notice success">' . esc_html__('Field order has been saved successfully.', 'certifypress') . '</div>';
        if ($message == 'error_duplicate') echo '<div class="sc-notice error">' . esc_html__('A field with this slug already exists. Please use a unique slug.', 'certifypress') . '</div>';
    }
    ?>
    <div id="sc-copy-notice" class="sc-copy-notice" style="display: none;"><?php echo esc_html__('Slug copied to clipboard!', 'certifypress'); ?></div>


    <!-- Add New Field Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Add New Field', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="add_field">
                <?php wp_nonce_field('sc_save_field', 'sc_field_nonce'); ?>

                <table class="sc-form-table">
                    <tr>
                        <th><label for="field_name"><?php echo esc_html__('Field Name', 'certifypress'); ?> *</label></th>
                        <td>
                            <input type="text" name="field_name" id="field_name" placeholder="<?php echo esc_attr__('e.g. Student ID', 'certifypress'); ?>" required>
                            <span class="description"><?php echo esc_html__('Display name for this field', 'certifypress'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_slug"><?php echo esc_html__('Field Slug', 'certifypress'); ?> *</label></th>
                        <td>
                            <input type="text" name="field_slug" id="field_slug" placeholder="<?php echo esc_attr__('e.g. student_id', 'certifypress'); ?>" required>
                            <span class="description"><?php echo esc_html__('Unique identifier. Use only lowercase letters, numbers, and underscores.', 'certifypress'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_type"><?php echo esc_html__('Field Type', 'certifypress'); ?> *</label></th>
                        <td>
                            <select name="field_type" id="field_type" required>
                                <option value="text"><?php echo esc_html__('Text', 'certifypress'); ?></option>
                                <option value="number"><?php echo esc_html__('Number', 'certifypress'); ?></option>
                                <option value="url"><?php echo esc_html__('URL', 'certifypress'); ?></option>
                                <option value="date"><?php echo esc_html__('Date', 'certifypress'); ?></option>
                                <option value="image"><?php echo esc_html__('Image Upload', 'certifypress'); ?></option>
                                <option value="file"><?php echo esc_html__('File Upload', 'certifypress'); ?></option>
                            </select>
                            <span class="description"><?php echo esc_html__('Select the type of data this field will store', 'certifypress'); ?></span>
                        </td>
                    </tr>
                </table>

                <div class="sc-form-actions">
                    <button type="submit" class="sc-button sc-button-primary"><?php echo esc_html__('Add Field', 'certifypress'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Existing Fields Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Existing Custom Fields', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body" style="padding: 0;">
            <?php $custom_fields = get_option('sc_custom_fields', array()); ?>

            <form id="sc-field-order-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="save_field_order">
                <?php wp_nonce_field('sc_save_field', 'sc_field_nonce'); ?>

                <?php if (!empty($custom_fields)) : ?>
                    <table class="sc-data-table">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align:center;"><?php echo esc_html__('Move', 'certifypress'); ?></th>
                                <th><?php echo esc_html__('Field Name', 'certifypress'); ?></th>
                                <th style="width: 220px;"><?php echo esc_html__('Field Slug (Click to copy)', 'certifypress'); ?></th>
                                <th style="width: 120px;"><?php echo esc_html__('Type', 'certifypress'); ?></th>
                                <th style="width: 100px;"><?php echo esc_html__('Action', 'certifypress'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="sc-sortable-fields">
                        <?php foreach ($custom_fields as $index => $field) : ?>
                            <?php
                                $delete_nonce = wp_create_nonce( 'sc_delete_field_' . $field['slug'] );
                                $delete_url = admin_url('admin.php?page=sc_custom_fields&action=delete_field&field_slug=' . $field['slug'] . '&_wpnonce=' . $delete_nonce);
                            ?>
                            <tr data-slug="<?php echo esc_attr($field['slug']); ?>">
                                <td class="sc-sort-handle">&#x2630;</td>
                                <td>
                                    <strong><?php echo esc_html($field['name']); ?></strong>
                                    <input type="hidden" name="field_order[]" value="<?php echo esc_attr($field['slug']); ?>">
                                </td>
                                <td>
                                    <code class="sc-copy-slug" title="<?php echo esc_attr__('Click to copy', 'certifypress'); ?>"><?php echo esc_html($field['slug']); ?></code>
                                </td>
                                <td><?php echo esc_html(ucfirst($field['type'])); ?></td>
                                <td>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="sc-table-actions sc-delete" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this field? This action cannot be undone.', 'certifypress')); ?>');">
                                        <?php echo esc_html__('Delete', 'certifypress'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                     <div class="sc-card-body" style="border-top: 1px solid #f0f0f1;">
                        <button type="submit" class="sc-button sc-button-primary"><?php echo esc_html__('Save Fields Order', 'certifypress'); ?></button>
                    </div>
                <?php else : ?>
                    <div class="sc-empty-state">
                        <div class="sc-empty-state-icon">⚙️</div>
                        <h3><?php echo esc_html__('No Custom Fields Yet', 'certifypress'); ?></h3>
                        <p><?php echo esc_html__('Create your first custom field to start collecting additional certificate data', 'certifypress'); ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
