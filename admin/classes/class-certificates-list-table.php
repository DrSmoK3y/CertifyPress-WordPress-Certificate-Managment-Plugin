<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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
            'title'       => __('Title', 'certifypress'),
            'status'      => __('Status', 'certifypress'),
            'categories'  => __('Categories', 'certifypress'),
            'tags'        => __('Tags', 'certifypress'),
            'date'        => __('Date', 'certifypress')
        ];
    }

    protected function column_cb($item) {
        return sprintf('<input type="checkbox" name="certificate_ids[]" value="%s" />', $item->ID);
    }

    public function column_title($item) {
        $edit_link = admin_url('admin.php?page=sc_add_certificate&edit_certificate=' . $item->ID);
        $delete_link = wp_nonce_url(admin_url('admin.php?page=sc_all_certificates&action=delete&certificate_id=' . $item->ID), 'delete_certificate_' . $item->ID);

        $actions = [
            'edit' => sprintf('<a href="%s">%s</a>', esc_url($edit_link), esc_html__('Edit', 'certifypress')),
            'delete' => sprintf('<a href="%s" class="sc-delete" onclick="return confirm(\'%s\')">%s</a>', esc_url($delete_link), esc_js(__('Are you sure you want to delete this certificate?', 'certifypress')), esc_html__('Delete', 'certifypress'))
        ];

        return sprintf('<strong><a href="%s">%s</a></strong>%s', esc_url($edit_link), esc_html($item->post_title), $this->row_actions($actions));
    }

    public function column_status($item) {
        $status = get_post_status($item->ID);
        $status_obj = get_post_status_object($status);
        $status_label = $status_obj ? $status_obj->label : $status;
        return sprintf('<span class="sc-status-%s">%s</span>', esc_attr($status), esc_html($status_label));
    }

    public function column_categories($item) {
        $terms = get_the_terms($item->ID, 'certificate_category');
        if (is_array($terms) && !empty($terms)) {
            $names = wp_list_pluck($terms, 'name');
            return esc_html(implode(', ', $names));
        }
        return '—';
    }

    public function column_tags($item) {
        $terms = get_the_terms($item->ID, 'certificate_tag');
        if (is_array($terms) && !empty($terms)) {
            $names = wp_list_pluck($terms, 'name');
            return esc_html(implode(', ', $names));
        }
        return '—';
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'date':
                return esc_html(gmdate('F j, Y', strtotime($item->post_date)));
            default:
                return '';
        }
    }

    public function get_sortable_columns() {
        return [
            'title' => ['post_title', false],
            'date'  => ['post_date', true],
        ];
    }

    public function get_bulk_actions() {
        return [
            'bulk_delete' => __('Delete', 'certifypress')
        ];
    }

    public function process_bulk_action() {
        if ( 'bulk_delete' === $this->current_action() ) {
            $nonce = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
            if ( ! $nonce || ! wp_verify_nonce( $nonce, 'bulk-' . $this->_args['plural'] ) ) {
                wp_die( esc_html__( 'Security check failed. Please try again.', 'certifypress' ) );
            }

            $certificate_ids = filter_input( INPUT_POST, 'certificate_ids', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY );
            if ( ! empty( $certificate_ids ) && is_array( $certificate_ids ) ) {
                foreach ( $certificate_ids as $id ) {
                    wp_delete_post( intval( $id ), true );
                }
                wp_safe_redirect( admin_url( 'admin.php?page=sc_all_certificates&message=bulk_deleted' ) );
                exit;
            }
        }
    }

    protected function get_views() {
        $status_links = [];
        $current = filter_input( INPUT_GET, 'post_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $current ) {
            $current = 'all';
        }

        $counts = wp_count_posts('certificate');

        // All link
        $all_count = intval($counts->publish) + intval($counts->draft);
        $class = ($current === 'all' || empty($current)) ? 'current' : '';
        $all_url = remove_query_arg(['post_status', 'paged']);
        $status_links['all'] = sprintf('<a href="%s" class="%s">%s <span class="count">(%d)</span></a>', esc_url($all_url), esc_attr($class), esc_html__('All', 'certifypress'), $all_count);

        // Published link
        $class = ($current === 'publish') ? 'current' : '';
        $publish_url = add_query_arg('post_status', 'publish');
        $status_links['publish'] = sprintf('<a href="%s" class="%s">%s <span class="count">(%d)</span></a>', esc_url($publish_url), esc_attr($class), esc_html__('Published', 'certifypress'), intval($counts->publish));

        // Draft link
        $class = ($current === 'draft') ? 'current' : '';
        $draft_url = add_query_arg('post_status', 'draft');
        $status_links['draft'] = sprintf('<a href="%s" class="%s">%s <span class="count">(%d)</span></a>', esc_url($draft_url), esc_attr($class), esc_html__('Draft', 'certifypress'), intval($counts->draft));

        return $status_links;
    }

    protected function extra_tablenav($which) {
        if ($which === 'top') {
            $selected_cat = filter_input( INPUT_GET, 'certificate_category', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $selected_cat ) {
            $selected_cat = '';
        }
            $selected_tag = filter_input( INPUT_GET, 'certificate_tag', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( ! $selected_tag ) {
            $selected_tag = '';
        }

            echo '<div class="alignleft actions">';

            // Category filter
            $categories = get_terms(['taxonomy' => 'certificate_category', 'hide_empty' => false]);
            if (!empty($categories) && !is_wp_error($categories)) {
                echo '<select name="certificate_category">';
                echo '<option value="">' . esc_html__('All Categories', 'certifypress') . '</option>';
                foreach ($categories as $cat) {
                    printf('<option value="%s" %s>%s</option>', esc_attr($cat->slug), selected($selected_cat, $cat->slug, false), esc_html($cat->name));
                }
                echo '</select>';
            }

            // Tag filter
            $tags = get_terms(['taxonomy' => 'certificate_tag', 'hide_empty' => false]);
            if (!empty($tags) && !is_wp_error($tags)) {
                echo '<select name="certificate_tag">';
                echo '<option value="">' . esc_html__('All Tags', 'certifypress') . '</option>';
                foreach ($tags as $tag) {
                    printf('<option value="%s" %s>%s</option>', esc_attr($tag->slug), selected($selected_tag, $tag->slug, false), esc_html($tag->name));
                }
                echo '</select>';
            }

            submit_button(__('Filter', 'certifypress'), '', 'filter_action', false);
            echo '</div>';
        }
    }

    public function prepare_items() {
        $this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];
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
        $args = [
            'post_type' => 'certificate', 
            'post_status' => ['publish', 'draft'],
            'posts_per_page' => -1
        ];

        $post_status = filter_input( INPUT_GET, 'post_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $post_status ) {
            $args['post_status'] = $post_status;
        }

        $search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $search_term ) {
            $args['s'] = $search_term;
        }

        $tax_query = [];
        $filter_cat = filter_input( INPUT_GET, 'certificate_category', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $filter_cat ) {
            $tax_query[] = [
                'taxonomy' => 'certificate_category',
                'field'    => 'slug',
                'terms'    => $filter_cat
            ];
        }

        $filter_tag = filter_input( INPUT_GET, 'certificate_tag', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $filter_tag ) {
            $tax_query[] = [
                'taxonomy' => 'certificate_tag',
                'field'    => 'slug',
                'terms'    => $filter_tag
            ];
        }

        if (!empty($tax_query)) {
            $tax_query['relation'] = 'AND';
            // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Required for admin filtering
            $args['tax_query'] = $tax_query;
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

        $post_status = filter_input( INPUT_GET, 'post_status', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $post_status ) {
            $args['post_status'] = $post_status;
        }

        $search_term = filter_input( INPUT_GET, 's', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $search_term ) {
            $args['s'] = $search_term;
        }

        $tax_query = [];
        $filter_cat = filter_input( INPUT_GET, 'certificate_category', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $filter_cat ) {
            $tax_query[] = [
                'taxonomy' => 'certificate_category',
                'field'    => 'slug',
                'terms'    => $filter_cat
            ];
        }

        $filter_tag = filter_input( INPUT_GET, 'certificate_tag', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
        if ( $filter_tag ) {
            $tax_query[] = [
                'taxonomy' => 'certificate_tag',
                'field'    => 'slug',
                'terms'    => $filter_tag
            ];
        }

        if (!empty($tax_query)) {
            $tax_query['relation'] = 'AND';
            // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- Required for admin filtering
            $args['tax_query'] = $tax_query;
        }

        $query = new WP_Query($args);
        return $query->get_posts();
    }
}
