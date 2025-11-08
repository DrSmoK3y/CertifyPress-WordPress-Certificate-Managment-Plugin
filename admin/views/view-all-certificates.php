<div class="wrap sc-admin-wrapper">
    
    <!-- Page Header -->
    <div class="sc-page-header">
        <div>
            <h1>All Certificates</h1>
            <p class="sc-page-description">Manage and view all certificate records</p>
        </div>
        <div class="sc-header-actions">
            <a href="<?php echo admin_url('admin.php?page=sc_add_certificate'); ?>" class="sc-button sc-button-primary">Add New Certificate</a>
        </div>
    </div>

    <div class="sc-card">
        <form method="get">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <?php
            if( !class_exists('Certificates_List_Table') ){
                 require_once SC_PLUGIN_PATH . 'admin/classes/class-certificates-list-table.php';
            }
            $list_table = new Certificates_List_Table();
            $list_table->prepare_items();
            $list_table->search_box('Search Certificates', 'certificate-search-input');
            $list_table->display();
            ?>
        </form>
    </div>

</div>