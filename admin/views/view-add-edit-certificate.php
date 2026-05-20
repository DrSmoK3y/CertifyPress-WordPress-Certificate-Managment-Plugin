<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$editing = false;
$certificate_id = filter_input( INPUT_GET, 'edit_certificate', FILTER_VALIDATE_INT );
if ( $certificate_id && $certificate_id > 0 ) {
    $editing = true;
    $certificate = get_post( $certificate_id );
}
?>

<div class="wrap sc-admin-wrapper">
    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo $editing ? esc_html__('Edit Certificate', 'certifypress') : esc_html__('Add New Certificate', 'certifypress'); ?></h1>
            <p class="sc-page-description">
                <?php echo $editing ? esc_html__('Update certificate information and details', 'certifypress') : esc_html__('Create a new certificate record with custom fields', 'certifypress'); ?>
            </p>
        </div>
        <div class="sc-header-actions">
            <a href="<?php echo esc_url(admin_url('admin.php?page=sc_all_certificates')); ?>" class="sc-button sc-button-secondary"><?php echo esc_html__('Back to All Certificates', 'certifypress'); ?></a>
        </div>
    </div>

    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Certificate Information', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="sc_process_add_edit_certificate">
                <?php wp_nonce_field('sc_save_certificate', 'sc_certificate_nonce'); ?>

                <?php if($editing): ?>
                    <input type="hidden" name="certificate_id" value="<?php echo esc_attr($certificate_id); ?>">
                <?php endif; ?>

                <table class="sc-form-table">
                    <!-- Title -->
                    <tr>
                        <th><label for="certificate_title"><?php echo esc_html__('Certificate Title', 'certifypress'); ?> *</label></th>
                        <td>
                            <input type="text" name="certificate_title" id="certificate_title" value="<?php echo ( $editing && $certificate ? esc_attr($certificate->post_title) : '' ); ?>" required>
                            <span class="description"><?php echo esc_html__('Enter the main title for this certificate', 'certifypress'); ?></span>
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
                                        <button type="button" class="sc-upload-button" data-target="<?php echo esc_attr($slug); ?>"><?php echo esc_html__('Choose File', 'certifypress'); ?></button>
                                    </div>
                                    <?php /* translators: %s: media type (image or file) */ ?>
                            <span class="description"><?php printf(esc_html__('Upload %s', 'certifypress'), $type == 'image' ? esc_html__('an image', 'certifypress') : esc_html__('a file', 'certifypress')); ?></span>
                                <?php else : ?>
                                    <input type="<?php echo esc_attr($type); ?>" name="<?php echo esc_attr($slug); ?>" id="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($value); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <?php /* translators: %s: URL to custom fields admin page */ ?>
                        <td colspan="2"><div class="sc-info-box"><p><?php echo wp_kses_post(sprintf(__('No custom fields have been created yet. <a href="%s">Add custom fields</a> to collect additional certificate information.', 'certifypress'), esc_url(admin_url('admin.php?page=sc_custom_fields')))); ?></p></div></td>
                        </tr>
                    <?php endif; ?>

                    <!-- Categories -->
                    <tr>
                        <th><label for="certificate_categories"><?php echo esc_html__('Categories', 'certifypress'); ?></label></th>
                        <td>
                            <select name="certificate_categories[]" id="certificate_categories" multiple="multiple">
                            <?php if ( ! empty($all_categories) && ! is_wp_error($all_categories) ) : foreach ( $all_categories as $cat ) : ?>
                                <option value="<?php echo intval($cat->term_id); ?>" <?php selected( in_array($cat->term_id, $selected_categories) ); ?>><?php echo esc_html($cat->name); ?></option>
                            <?php endforeach; else: ?>
                                <option value="" disabled><?php echo esc_html__('No categories available', 'certifypress'); ?></option>
                            <?php endif; ?>
                            </select>
                            <span class="description"><?php echo esc_html__('Hold Ctrl (Cmd) to select multiple categories', 'certifypress'); ?></span>
                        </td>
                    </tr>

                    <!-- Tags -->
                    <tr>
                        <th><label for="certificate_tags"><?php echo esc_html__('Tags', 'certifypress'); ?></label></th>
                        <td>
                            <select name="certificate_tags[]" id="certificate_tags" multiple="multiple">
                            <?php if ( ! empty($all_tags) && ! is_wp_error($all_tags) ) : foreach ( $all_tags as $tag ) : ?>
                                <option value="<?php echo intval($tag->term_id); ?>" <?php selected( in_array($tag->term_id, $selected_tags) ); ?>><?php echo esc_html($tag->name); ?></option>
                            <?php endforeach; else: ?>
                                <option value="" disabled><?php echo esc_html__('No tags available', 'certifypress'); ?></option>
                            <?php endif; ?>
                            </select>
                            <span class="description"><?php echo esc_html__('Hold Ctrl (Cmd) to select multiple tags', 'certifypress'); ?></span>
                        </td>
                    </tr>

                </table>

                <div class="sc-form-actions">
                    <button type="submit" name="publish" class="sc-button sc-button-primary"><?php echo $editing ? esc_html__('Update Certificate', 'certifypress') : esc_html__('Publish Certificate', 'certifypress'); ?></button>
                    <button type="submit" name="save_as_draft" class="sc-button sc-button-secondary"><?php echo esc_html__('Save as Draft', 'certifypress'); ?></button>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sc_all_certificates')); ?>" class="sc-button-link"><?php echo esc_html__('Cancel', 'certifypress'); ?></a>
                </div>
            </form>
        </div>
    
    <!-- Pro Hint -->
    <div class="sc-card" style="border-left: 4px solid #00a32a; margin-top: 24px;">
        <div class="sc-card-body" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="margin: 0 0 6px 0; font-size: 15px;">🔢 <?php echo esc_html__('Auto Serial Numbers & Expiry', 'certifypress'); ?></h3>
                <p style="margin: 0; font-size: 13px; color: #646970;"><?php echo esc_html__('CertifyPress Pro automatically generates unique serial numbers and supports certificate expiration dates — perfect for professional credentialing.', 'certifypress'); ?></p>
            </div>
            <a href="<?php echo esc_url(admin_url('admin.php?page=sc_upgrade_to_pro')); ?>" class="sc-button sc-button-secondary"><?php echo esc_html__('View Pro Features', 'certifypress'); ?></a>
        </div>
    </div>

</div>
</div>
