<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wrap sc-admin-wrapper">

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo esc_html__('Tags & Categories', 'certifypress'); ?></h1>
            <p class="sc-page-description"><?php echo esc_html__('Organize your certificates using categories and tags', 'certifypress'); ?></p>
        </div>
    </div>

    <!-- Information Notice -->
    <div class="sc-notice info">
        <?php echo esc_html__('Categories and tags help you organize and filter certificates. Use the WordPress standard interface to manage them.', 'certifypress'); ?>
    </div>

    <!-- Certificate Categories Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Certificate Categories', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <p class="description"><?php echo esc_html__('Categories are hierarchical and help you group related certificates. Examples: "Diploma", "Completion Certificate", "Achievement Award"', 'certifypress'); ?></p>

            <div class="sc-action-links">
                <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=certificate_category&post_type=certificate')); ?>" class="sc-button sc-button-primary"><?php echo esc_html__('Manage Categories', 'certifypress'); ?></a>
            </div>
        </div>
    </div>

    <!-- Certificate Tags Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Certificate Tags', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <p class="description"><?php echo esc_html__('Tags are non-hierarchical and provide more specific labeling. Examples: "2024", "Online Course", "Advanced Level", "Professional Development"', 'certifypress'); ?></p>

            <div class="sc-action-links">
                <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=certificate_tag&post_type=certificate')); ?>" class="sc-button sc-button-primary"><?php echo esc_html__('Manage Tags', 'certifypress'); ?></a>
            </div>
        </div>
    </div>

    <!-- Usage Tips Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2><?php echo esc_html__('Best Practices', 'certifypress'); ?></h2>
        </div>
        <div class="sc-card-body">
            <table class="sc-form-table">
                <tr>
                    <th style="width: 160px;"><?php echo esc_html__('Categories', 'certifypress'); ?></th>
                    <td>
                        <p style="margin: 0;"><?php echo esc_html__('Use categories for broad groupings that represent the main types of certificates you issue. Keep your category structure simple and logical.', 'certifypress'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php echo esc_html__('Tags', 'certifypress'); ?></th>
                    <td>
                        <p style="margin: 0;"><?php echo esc_html__('Use tags for specific attributes like year, course name, skill level, or department. Tags are flexible and can be applied to multiple certificates.', 'certifypress'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php echo esc_html__('Search & Filter', 'certifypress'); ?></th>
                    <td>
                        <p style="margin: 0;"><?php echo esc_html__('Both categories and tags can be used in the front-end search form to help users find specific certificates quickly.', 'certifypress'); ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
