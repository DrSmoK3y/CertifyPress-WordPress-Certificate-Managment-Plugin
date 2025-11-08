<div class="wrap sc-admin-wrapper">
    
    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1>Search Settings</h1>
            <p class="sc-page-description">Select your field ID as the search field. You can add multiple fields by separating commas, and manage labels of the search form</p>
        </div>
    </div>

    <!-- Success Notice -->
    <?php if (isset($_GET['message']) && $_GET['message'] == 'saved') : ?>
        <div class="sc-notice success">Search settings have been saved successfully.</div>
    <?php endif; ?>
    
    <!-- Search Configuration Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Search Form Configuration</h2>
        </div>
        <div class="sc-card-body">
            <?php
            $current_search_fields  = get_option('sc_search_fields', '');
            $current_search_label   = get_option('sc_search_label', 'Search Certificate');
            $current_category_label = get_option('sc_category_label', 'Category');
            $current_tag_label      = get_option('sc_tag_label', 'Tag');
            ?>
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="action" value="sc_process_search_settings_form">
                <?php wp_nonce_field('sc_save_search_field', 'sc_search_field_nonce'); ?>
                
                <table class="sc-form-table">
                    <tr>
                        <th><label for="search_fields">Searchable Field Slugs</label></th>
                        <td>
                            <input type="text" name="search_fields" id="search_fields" value="<?php echo esc_attr($current_search_fields); ?>" placeholder="e.g. student_id, certificate_number">
                            <span class="description">Enter comma-separated field slugs that users can search by. Get slugs from the <a href="<?php echo admin_url('admin.php?page=sc_custom_fields'); ?>">Custom Fields</a> page.</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="search_label">Search Input Label</label></th>
                        <td>
                            <input type="text" name="search_label" id="search_label" value="<?php echo esc_attr($current_search_label); ?>">
                            <span class="description">Label text for the main search input field</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="category_label">Category Selector Label</label></th>
                        <td>
                            <input type="text" name="category_label" id="category_label" value="<?php echo esc_attr($current_category_label); ?>">
                            <span class="description">Label text for the category dropdown</span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tag_label">Tag Selector Label</label></th>
                        <td>
                            <input type="text" name="tag_label" id="tag_label" value="<?php echo esc_attr($current_tag_label); ?>">
                            <span class="description">Label text for the tag dropdown</span>
                        </td>
                    </tr>
                </table>
                
                <div class="sc-form-actions">
                    <button type="submit" class="sc-button sc-button-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Available Shortcodes Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Available Shortcodes</h2>
        </div>
        <div class="sc-card-body">
            <p class="description" style="margin-bottom: 16px;">Copy and paste these shortcodes into any page or post to display the search form. Upgrade to Pro for better design options with Elementor.</p>
            
            <div class="sc-shortcode-box">
                <ul>
                    <li>
                        <strong>Simple Search Form</strong>
                        <code>[certificate_search]</code>
                    </li>
                    <li>
                        <strong>Search with Categories</strong>
                        <code>[certificate_search_categories]</code>
                    </li>
                    <li>
                        <strong>Search with Tags & Categories</strong>
                        <code>[certificate_search_tags_categories]</code>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>