<div class="wrap sc-admin-wrapper">
    
    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1>Custom Certificate Fields</h1>
            <p class="sc-page-description">Create and manage custom fields for your certificates</p>
        </div>
    </div>

    <!-- Notices -->
    <?php 
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        if ($message == 'added') echo '<div class="sc-notice success">Custom field has been added successfully.</div>';
        if ($message == 'deleted') echo '<div class="sc-notice success">Custom field has been deleted successfully.</div>';
        if ($message == 'order_saved') echo '<div class="sc-notice success">Field order has been saved successfully.</div>';
        if ($message == 'error_duplicate') echo '<div class="sc-notice error">A field with this slug already exists. Please use a unique slug.</div>';
    }
    ?>
    <div id="sc-copy-notice" class="sc-copy-notice" style="display: none;">Slug copied to clipboard!</div>


    <!-- Add New Field Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Add New Field</h2>
        </div>
        <div class="sc-card-body">
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="action" value="add_field">
                <?php wp_nonce_field('sc_save_field', 'sc_field_nonce'); ?>
                
                <table class="sc-form-table">
                    <tr>
                        <th><label for="field_name">Field Name *</label></th>
                        <td>
                            <input type="text" name="field_name" id="field_name" placeholder="e.g. Student ID" required>
                            <span class="description">Display name for this field</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_slug">Field Slug *</label></th>
                        <td>
                            <input type="text" name="field_slug" id="field_slug" placeholder="e.g. student_id" required>
                            <span class="description">Unique identifier. Use only lowercase letters, numbers, and underscores.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="field_type">Field Type *</label></th>
                        <td>
                            <select name="field_type" id="field_type" required>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="url">URL</option>
                                <option value="date">Date</option>
                                <option value="image">Image Upload</option>
                                <option value="file">File Upload</option>
                            </select>
                            <span class="description">Select the type of data this field will store</span>
                        </td>
                    </tr>
                </table>
                
                <div class="sc-form-actions">
                    <button type="submit" class="sc-button sc-button-primary">Add Field</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Existing Fields Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Existing Custom Fields</h2>
        </div>
        <div class="sc-card-body" style="padding: 0;">
            <?php $custom_fields = get_option('sc_custom_fields', array()); ?>
            
            <form id="sc-field-order-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="action" value="save_field_order">
                <?php wp_nonce_field('sc_save_field', 'sc_field_nonce'); ?>

                <?php if (!empty($custom_fields)) : ?>
                    <table class="sc-data-table">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align:center;">Move</th>
                                <th>Field Name</th>
                                <th style="width: 220px;">Field Slug (Click to copy)</th>
                                <th style="width: 120px;">Type</th>
                                <th style="width: 100px;">Action</th>
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
                                    <code class="sc-copy-slug" title="Click to copy"><?php echo esc_html($field['slug']); ?></code>
                                </td>
                                <td><?php echo esc_html(ucfirst($field['type'])); ?></td>
                                <td>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="sc-table-actions sc-delete" onclick="return confirm('Are you sure you want to delete this field? This action cannot be undone.');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                     <div class="sc-card-body" style="border-top: 1px solid #f0f0f1;">
                        <button type="submit" class="sc-button sc-button-primary">Save Fields Order</button>
                    </div>
                <?php else : ?>
                    <div class="sc-empty-state">
                        <div class="sc-empty-state-icon">⚙️</div>
                        <h3>No Custom Fields Yet</h3>
                        <p>Create your first custom field to start collecting additional certificate data</p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>