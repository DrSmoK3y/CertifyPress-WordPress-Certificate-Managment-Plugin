<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wrap sc-admin-wrapper">

    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1><?php echo esc_html__('All Certificates', 'certifypress'); ?></h1>
            <p class="sc-page-description"><?php echo esc_html__('Manage and view all certificate records', 'certifypress'); ?></p>
        </div>
        <div class="sc-header-actions">
            <a href="<?php echo esc_url(admin_url('admin.php?page=sc_add_certificate')); ?>" class="sc-button sc-button-primary"><?php echo esc_html__('Add New Certificate', 'certifypress'); ?></a>
        </div>
    </div>

    <?php
    if (isset($_GET['message'])) {
        $message = sanitize_text_field(wp_unslash($_GET['message']));
        if ($message === 'deleted') {
            echo '<div class="sc-notice success">' . esc_html__('Certificate has been deleted successfully.', 'certifypress') . '</div>';
        } elseif ($message === 'bulk_deleted') {
            echo '<div class="sc-notice success">' . esc_html__('Selected certificates have been deleted successfully.', 'certifypress') . '</div>';
        } elseif ($message === 'saved') {
            echo '<div class="sc-notice success">' . esc_html__('Certificate has been saved successfully.', 'certifypress') . '</div>';
        }
    }
    ?>

    <div class="sc-card all-certificate">
        <form method="get">
            <input type="hidden" name="page" value="<?php echo esc_attr(isset($_REQUEST['page']) ? sanitize_text_field(wp_unslash($_REQUEST['page'])) : 'sc_all_certificates'); ?>" />
            <?php
            if( !class_exists('Certificates_List_Table') ){
                 require_once SC_PLUGIN_PATH . 'admin/classes/class-certificates-list-table.php';
            }
            $list_table = new Certificates_List_Table();
            $list_table->prepare_items();
            $list_table->search_box(esc_html__('Search Certificates', 'certifypress'), 'certificate-search-input');
            $list_table->views();
            $list_table->display();
            ?>
        </form>
    </div>

</div>
