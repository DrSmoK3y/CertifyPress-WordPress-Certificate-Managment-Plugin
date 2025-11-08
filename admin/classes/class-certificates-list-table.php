<?php
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Certificates_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct([
            'singular' => 'Certificate',
            'plural'   => 'Certificates',
            'ajax'     => false
        ]);
    }

    public function get_columns() {
        return [
            'cb'          => '<input type="checkbox" />',
            'title'       => 'Title',
            'status'      => 'Status',
            'categories'  => 'Categories',
            'tags'        => 'Tags',
            'date'        => 'Date'
        ];
    }
    
    protected function column_cb($item) {
        return sprintf('<input type="checkbox" name="certificate_ids[]" value="%s" />', $item->ID);
    }

    public function column_title($item) {
        $edit_link = admin_url('admin.php?page=sc_add_certificate&edit_certificate=' . $item->ID);
        $delete_link = wp_nonce_url(admin_url('admin.php?page=sc_all_certificates&action=delete&certificate_id=' . $item->ID), 'delete_certificate_' . $item->ID);
        
        $actions = [
            'edit' => sprintf('<a href="%s">Edit</a>', $edit_link),
            'delete' => sprintf('<a href="%s" class="sc-delete" onclick="return confirm(\'Are you sure?\')">Delete</a>', $delete_link)
        ];
        
        return sprintf('<strong><a href="%s">%s</a></strong>%s', $edit_link, $item->post_title, $this->row_actions($actions));
    }

    public function column_status($item) {
        $status = get_post_status($item->ID);
        $status_label = get_post_status_object($status)->label;
        return sprintf('<span class="sc-status-%s">%s</span>', esc_attr($status), esc_html($status_label));
    }


    public function column_categories($item) {
        $terms = get_the_terms($item->ID, 'certificate_category');
        if (is_array($terms)) {
            $names = wp_list_pluck($terms, 'name');
            return implode(', ', $names);
        }
        return '—';
    }

    public function column_tags($item) {
        $terms = get_the_terms($item->ID, 'certificate_tag');
        if (is_array($terms)) {
            $names = wp_list_pluck($terms, 'name');
            return implode(', ', $names);
        }
        return '—';
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'date':
                return date('F j, Y', strtotime($item->post_date));
            default:
                return print_r($item, true);
        }
    }

    public function get_bulk_actions() {
        return [
            'bulk_delete' => 'Delete'
        ];
    }
    
    public function process_bulk_action() {
        if ('bulk_delete' === $this->current_action()) {
            $nonce = esc_attr($_REQUEST['_wpnonce']);
            if (!wp_verify_nonce($nonce, 'bulk-certificates')) {
                die('Go get a life script kiddies');
            } else {
                $cert_ids = esc_sql($_REQUEST['certificate_ids']);
                foreach ($cert_ids as $id) {
                    wp_delete_post($id, true);
                }
                 wp_redirect(admin_url('admin.php?page=sc_all_certificates&message=bulk_deleted'));
                 exit;
            }
        }
    }
    
    public function prepare_items() {
        $this->_column_headers = [$this->get_columns(), [], []];
        $this->process_bulk_action();

        $per_page = 20;
        $current_page = $this->get_pagenum();
        $total_items = $this->get_certificate_count();

        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page
        ]);
        
        $this->items = $this->get_certificates($per_page, $current_page);
    }
    
    private function get_certificate_count() {
        $args = ['post_type' => 'certificate', 'post_status' => ['publish', 'draft']];
        if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
             $args['s'] = sanitize_text_field($_REQUEST['s']);
        }
        $query = new WP_Query($args);
        return $query->found_posts;
    }
    
    private function get_certificates($per_page, $current_page) {
        $args = [
            'post_type'      => 'certificate',
            'post_status'    => ['publish', 'draft'],
            'posts_per_page' => $per_page,
            'paged'          => $current_page,
            'orderby'        => 'date',
            'order'          => 'DESC'
        ];

        if(isset($_REQUEST['s']) && !empty($_REQUEST['s'])){
            $args['s'] = sanitize_text_field($_REQUEST['s']);
        }
        
        $query = new WP_Query($args);
        return $query->get_posts();
    }
}