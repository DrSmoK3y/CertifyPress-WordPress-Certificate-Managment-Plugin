<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wrap sc-admin-wrapper">

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo esc_html__('Search Settings', 'certifypress'); ?></h1>
            <p class="sc-page-description"><?php echo esc_html__('Select your field ID as the search field. You can add multiple fields by separating commas, and manage labels of the search form', 'certifypress'); ?></p>
        </div>
    </div>

    <!-- Success Notice -->
    <?php
    $search_message = filter_input( INPUT_GET, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    if ( $search_message === 'saved' ) :
    ?>
        <div class="sc-notice success"><?php echo esc_html__( 'Search settings have been saved successfully.', 'certifypress' ); ?></div>
    <?php endif; ?>

    <!-- Search Configuration Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Search Form Configuration', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <?php
            $current_search_fields  = get_option('sc_search_fields', '');
            $current_search_label   = get_option('sc_search_label', 'Search Certificate');
            $current_category_label = get_option('sc_category_label', 'Category');
            $current_tag_label      = get_option('sc_tag_label', 'Tag');
            ?>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="sc_process_search_settings_form">
                <?php wp_nonce_field('sc_save_search_field', 'sc_search_field_nonce'); ?>

                <table class="sc-form-table">
                    <tr>
                        <th><label for="search_fields"><?php echo esc_html__('Searchable Field Slugs', 'certifypress'); ?></label></th>
                        <td>
                            <input type="text" name="search_fields" id="search_fields" value="<?php echo esc_attr($current_search_fields); ?>" placeholder="<?php echo esc_attr__('e.g. student_id, certificate_number', 'certifypress'); ?>">
                            <?php /* translators: %s: URL to custom fields admin page */ ?>
                            <span class="description"><?php echo wp_kses_post(sprintf(__('Enter comma-separated field slugs that users can search by. Get slugs from the <a href="%s">Custom Fields</a> page.', 'certifypress'), esc_url(admin_url('admin.php?page=sc_custom_fields')))); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="search_label"><?php echo esc_html__('Search Input Label', 'certifypress'); ?></label></th>
                        <td>
                            <input type="text" name="search_label" id="search_label" value="<?php echo esc_attr($current_search_label); ?>">
                            <span class="description"><?php echo esc_html__('Label text for the main search input field', 'certifypress'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="category_label"><?php echo esc_html__('Category Selector Label', 'certifypress'); ?></label></th>
                        <td>
                            <input type="text" name="category_label" id="category_label" value="<?php echo esc_attr($current_category_label); ?>">
                            <span class="description"><?php echo esc_html__('Label text for the category dropdown', 'certifypress'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="tag_label"><?php echo esc_html__('Tag Selector Label', 'certifypress'); ?></label></th>
                        <td>
                            <input type="text" name="tag_label" id="tag_label" value="<?php echo esc_attr($current_tag_label); ?>">
                            <span class="description"><?php echo esc_html__('Label text for the tag dropdown', 'certifypress'); ?></span>
                        </td>
                    </tr>
                </table>

                <div class="sc-form-actions">
                    <button type="submit" class="sc-button sc-button-primary"><?php echo esc_html__('Save Settings', 'certifypress'); ?></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Available Shortcodes Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Available Shortcodes', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <p class="description" style="margin-bottom: 16px;"><?php echo esc_html__('Copy and paste these shortcodes into any page or post to display the search form. Upgrade to Pro for better design options with Elementor.', 'certifypress'); ?></p>

            <div class="sc-shortcode-box">
    <ul>
        <li>
            <strong><?php echo esc_html__('Simple Search Form', 'certifypress'); ?></strong>

            <code class="sc-copy-shortcode" data-shortcode="[certificate_search]">
                [certificate_search]
            </code>
        </li>

        <li>
            <strong><?php echo esc_html__('Search with Categories', 'certifypress'); ?></strong>

            <code class="sc-copy-shortcode" data-shortcode="[certificate_search_categories]">
                [certificate_search_categories]
            </code>
        </li>

        <li>
            <strong><?php echo esc_html__('Search with Tags & Categories', 'certifypress'); ?></strong>

            <code class="sc-copy-shortcode" data-shortcode="[certificate_search_tags_categories]">
                [certificate_search_tags_categories]
            </code>
        </li>
    </ul>
</div>
        </div>
    </div>

</div>
