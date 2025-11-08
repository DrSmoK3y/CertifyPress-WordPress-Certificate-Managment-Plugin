<div class="wrap sc-admin-wrapper">
    
    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1>Tags & Categories</h1>
            <p class="sc-page-description">Organize your certificates using categories and tags</p>
        </div>
    </div>

    <!-- Information Notice -->
    <div class="sc-notice info">
        Categories and tags help you organize and filter certificates. Use the WordPress standard interface to manage them.
    </div>
    
    <!-- Certificate Categories Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Certificate Categories</h2>
        </div>
        <div class="sc-card-body">
            <p class="description">Categories are hierarchical and help you group related certificates. Examples: "Diploma", "Completion Certificate", "Achievement Award"</p>
            
            <div class="sc-action-links">
                <a href="<?php echo admin_url('edit-tags.php?taxonomy=certificate_category&post_type=certificate'); ?>" class="sc-button sc-button-primary">Manage Categories</a>
            </div>
        </div>
    </div>

    <!-- Certificate Tags Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Certificate Tags</h2>
        </div>
        <div class="sc-card-body">
            <p class="description">Tags are non-hierarchical and provide more specific labeling. Examples: "2024", "Online Course", "Advanced Level", "Professional Development"</p>
            
            <div class="sc-action-links">
                <a href="<?php echo admin_url('edit-tags.php?taxonomy=certificate_tag&post_type=certificate'); ?>" class="sc-button sc-button-primary">Manage Tags</a>
            </div>
        </div>
    </div>

    <!-- Usage Tips Card -->
    <div class="sc-card">
        <div class="sc-card-header">
            <h2>Best Practices</h2>
        </div>
        <div class="sc-card-body">
            <table class="sc-form-table">
                <tr>
                    <th style="width: 160px;">Categories</th>
                    <td>
                        <p style="margin: 0;">Use categories for broad groupings that represent the main types of certificates you issue. Keep your category structure simple and logical.</p>
                    </td>
                </tr>
                <tr>
                    <th>Tags</th>
                    <td>
                        <p style="margin: 0;">Use tags for specific attributes like year, course name, skill level, or department. Tags are flexible and can be applied to multiple certificates.</p>
                    </td>
                </tr>
                <tr>
                    <th>Search & Filter</th>
                    <td>
                        <p style="margin: 0;">Both categories and tags can be used in the front-end search form to help users find specific certificates quickly.</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>