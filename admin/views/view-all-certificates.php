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
    $message = filter_input( INPUT_GET, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
    if ( $message === 'deleted' ) {
        echo '<div class="sc-notice success">' . esc_html__( 'Certificate has been deleted successfully.', 'certifypress' ) . '</div>';
    } elseif ( $message === 'bulk_deleted' ) {
        echo '<div class="sc-notice success">' . esc_html__( 'Selected certificates have been deleted successfully.', 'certifypress' ) . '</div>';
    } elseif ( $message === 'saved' ) {
        echo '<div class="sc-notice success">' . esc_html__( 'Certificate has been saved successfully.', 'certifypress' ) . '</div>';
    }
    ?>

    <div class="">
        <form method="get">
            <?php $current_page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS ); ?>
            <input type="hidden" name="page" value="<?php echo esc_attr( $current_page ? $current_page : 'sc_all_certificates' ); ?>" />
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


    <!-- Pro Hint -->
    <div class="sc-card" style="border-left: 4px solid #ffb900;">
        <div class="sc-card-body" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h3 style="margin: 0 0 6px 0; font-size: 15px;">⚡ <?php echo esc_html__('Unlock Pro Features', 'certifypress'); ?></h3>
                <p style="margin: 0; font-size: 13px; color: #646970;"><?php echo esc_html__('Generate PDFs, add QR codes for verification, send certificates via email, and import hundreds of records via CSV with CertifyPress Pro.', 'certifypress'); ?></p>
            </div>
            <a href="<?php echo esc_url(admin_url('admin.php?page=sc_upgrade_to_pro')); ?>" class="sc-button sc-button-primary" style="background: #ffb900; color: #1d2327; border-color: #ffb900;"><?php echo esc_html__('Explore Pro', 'certifypress'); ?></a>
        </div>
    </div>

</div>
