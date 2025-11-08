<div class="wrap sc-admin-wrapper">
    <?php
    $editing = false;
    $certificate_id = 0;
    if ( isset($_GET['edit_certificate']) ) {
        $certificate_id = intval($_GET['edit_certificate']);
        $editing = true;
        $certificate = get_post($certificate_id);
    }
    ?>

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo $editing ? 'Edit Certificate' : 'Add New Certificate'; ?></h1>
            <p class="sc-page-description">
                <?php echo $editing ? 'Update certificate information and details' : 'Create a new certificate record with custom fields'; ?>
            </p>
        </div>
        <div class="sc-header-actions">
            <a href="<?php echo admin_url('admin.php?page=sc_all_certificates'); ?>" class="sc-button sc-button-secondary">Back to All Certificates</a>
        </div>
    </div>
    
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Certificate Information</h2>
        </div>
        <div class="sc-card-body">
            <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                <input type="hidden" name="action" value="sc_process_add_edit_certificate">
                <?php wp_nonce_field('sc_save_certificate', 'sc_certificate_nonce'); ?>
                
                <?php if($editing): ?>
                    <input type="hidden" name="certificate_id" value="<?php echo $certificate_id; ?>">
                <?php endif; ?>
                
                <table class="sc-form-table">
                    <!-- Title -->
                    <tr>
                        <th><label for="certificate_title">Certificate Title *</label></th>
                        <td>
                            <input type="text" name="certificate_title" id="certificate_title" value="<?php echo ( $editing ? esc_attr($certificate->post_title) : '' ); ?>" required>
                            <span class="description">Enter the main title for this certificate</span>
                        </td>
                    </tr>

                    <?php
                    $custom_fields = get_option('sc_custom_fields', array());
                    $all_categories = get_terms(array('taxonomy' => 'certificate_category', 'hide_empty' => false));
                    $all_tags = get_terms(array('taxonomy' => 'certificate_tag', 'hide_empty' => false));
                    
                    $meta_values = array();
                    $selected_categories = array();
                    $selected_tags = array();

                    if ($editing) {
                        foreach ( $custom_fields as $field ) {
                            $meta_values[$field['slug']] = get_post_meta($certificate_id, $field['slug'], true);
                        }
                        $cat_terms = wp_get_object_terms($certificate_id, 'certificate_category', array('fields' => 'ids'));
                        if ( ! is_wp_error($cat_terms) ) $selected_categories = $cat_terms;

                        $tag_terms = wp_get_object_terms($certificate_id, 'certificate_tag', array('fields' => 'ids'));
                        if ( ! is_wp_error($tag_terms) ) $selected_tags = $tag_terms;
                    }
                    ?>
                    
                    <!-- Custom Fields -->
                    <?php if ( ! empty($custom_fields) ) : foreach ( $custom_fields as $field ) : ?>
                        <?php
                            $slug  = $field['slug'];
                            $label = $field['name'];
                            $type  = $field['type'];
                            $value = isset($meta_values[$slug]) ? $meta_values[$slug] : '';
                        ?>
                        <tr>
                            <th><label for="<?php echo esc_attr($slug); ?>"><?php echo esc_html($label); ?></label></th>
                            <td>
                                <?php if ($type == 'image' || $type == 'file') : ?>
                                    <div class="sc-upload-group">
                                        <input type="text" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($value); ?>">
                                        <button type="button" class="sc-upload-button" data-target="<?php echo esc_attr($slug); ?>">Choose File</button>
                                    </div>
                                    <span class="description">Upload <?php echo $type == 'image' ? 'an image' : 'a file'; ?></span>
                                <?php else : ?>
                                    <input type="<?php echo esc_attr($type); ?>" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($value); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="2"><div class="sc-info-box"><p>No custom fields have been created yet. <a href="<?php echo admin_url('admin.php?page=sc_custom_fields'); ?>">Add custom fields</a> to collect additional certificate information.</p></div></td>
                        </tr>
                    <?php endif; ?>

                    <!-- Categories -->
                    <tr>
                        <th><label for="certificate_categories">Categories</label></th>
                        <td>
                            <select name="certificate_categories[]" id="certificate_categories" multiple="multiple">
                            <?php if ( ! empty($all_categories) && ! is_wp_error($all_categories) ) : foreach ( $all_categories as $cat ) : ?>
                                <option value="<?php echo intval($cat->term_id); ?>" <?php selected( in_array($cat->term_id, $selected_categories) ); ?>><?php echo esc_html($cat->name); ?></option>
                            <?php endforeach; else: ?>
                                <option value="" disabled>No categories available</option>
                            <?php endif; ?>
                            </select>
                            <span class="description">Hold Ctrl (Cmd) to select multiple categories</span>
                        </td>
                    </tr>

                    <!-- Tags -->
                    <tr>
                        <th><label for="certificate_tags">Tags</label></th>
                        <td>
                            <select name="certificate_tags[]" id="certificate_tags" multiple="multiple">
                            <?php if ( ! empty($all_tags) && ! is_wp_error($all_tags) ) : foreach ( $all_tags as $tag ) : ?>
                                <option value="<?php echo intval($tag->term_id); ?>" <?php selected( in_array($tag->term_id, $selected_tags) ); ?>><?php echo esc_html($tag->name); ?></option>
                            <?php endforeach; else: ?>
                                <option value="" disabled>No tags available</option>
                            <?php endif; ?>
                            </select>
                            <span class="description">Hold Ctrl (Cmd) to select multiple tags</span>
                        </td>
                    </tr>

                </table>
                
                <div class="sc-form-actions">
                    <button type="submit" name="publish" class="sc-button sc-button-primary"><?php echo $editing ? 'Update Certificate' : 'Publish Certificate'; ?></button>
                    <button type="submit" name="save_as_draft" class="sc-button sc-button-secondary">Save as Draft</button>
                    <a href="<?php echo admin_url('admin.php?page=sc_all_certificates'); ?>" class="sc-button-link">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>