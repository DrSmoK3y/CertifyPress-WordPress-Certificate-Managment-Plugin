<?php
/**
 * View: All Certificates List & Grid View
 * 
 * @package LM_Certificate_Publisher
 */

if (!defined('ABSPATH')) {
    exit;
}

$lmcp_current_view = isset($_GET['view']) && $_GET['view'] === 'grid' ? 'grid' : 'list';
$lmcp_list_table = new LMCP_Certificates_List_Table();
$lmcp_list_table->prepare_items();
$lmcp_admin_logo = get_option('lmcp_admin_logo', '');
$lmcp_pro_url = 'https://lmdesigners.gumroad.com/l/certifypress-pro-wordpress-plugin';
?>

<div class="wrap lmcp-admin-wrapper">
    <div class="lmcp-page-header">
        <div class="lmcp-header-title-group">
            <?php if (!empty($lmcp_admin_logo)) : ?>
                <div class="lmcp-header-logo-box">
                    <img src="<?php echo esc_url($lmcp_admin_logo); ?>" alt="Logo" class="lmcp-header-logo-img">
                </div>
            <?php else : ?>
                <div class="lmcp-header-icon-box">
                    <?php echo lmcp_icon('cap', 22); ?>
                </div>
            <?php endif; ?>
            <div>
                <h1><?php echo esc_html__('LM Certificate Publisher', 'lm-certificate-publisher'); ?> &mdash; <?php echo esc_html__('Certificates Management', 'lm-certificate-publisher'); ?></h1>
                <p class="lmcp-page-description"><?php echo esc_html__('Publish, manage, search, and organize all issued certificates and credentials.', 'lm-certificate-publisher'); ?></p>
            </div>
        </div>
        <div class="lmcp-header-actions">
            <div class="lmcp-view-switcher" style="display: flex; background: #f1f5f9; padding: 3px; border-radius: 6px; gap: 2px;">
                <a href="<?php echo esc_url(add_query_arg('view', 'list')); ?>" class="lmcp-button <?php echo $lmcp_current_view === 'list' ? 'lmcp-button-primary' : 'lmcp-button-secondary'; ?>" style="height: 32px; padding: 0 12px; font-size: 12px; gap: 6px;">
                    <?php echo lmcp_icon('list', 14); ?> <?php echo esc_html__('List', 'lm-certificate-publisher'); ?>
                </a>
                <a href="<?php echo esc_url(add_query_arg('view', 'grid')); ?>" class="lmcp-button <?php echo $lmcp_current_view === 'grid' ? 'lmcp-button-primary' : 'lmcp-button-secondary'; ?>" style="height: 32px; padding: 0 12px; font-size: 12px; gap: 6px;">
                    <?php echo lmcp_icon('grid', 14); ?> <?php echo esc_html__('Grid', 'lm-certificate-publisher'); ?>
                </a>
            </div>
            <a href="<?php echo esc_url(admin_url('admin.php?page=lmcp_add_certificate')); ?>" class="lmcp-button lmcp-button-primary">
                <?php echo lmcp_icon('plus', 14); ?> <?php echo esc_html__('Add Certificate', 'lm-certificate-publisher'); ?>
            </a>
            <a href="<?php echo esc_url($lmcp_pro_url); ?>" target="_blank" class="lmcp-pro-upgrade-btn">
                <?php echo lmcp_icon('sparkles', 14); ?> <?php echo esc_html__('Upgrade to CertifyPress Pro', 'lm-certificate-publisher'); ?>
            </a>
        </div>
    </div>

    <?php if (isset($_GET['message']) && $_GET['message'] === 'deleted') : ?>
        <div class="lmcp-notice success">
            <?php echo esc_html__('Certificate successfully deleted.', 'lm-certificate-publisher'); ?>
        </div>
    <?php elseif (isset($_GET['message']) && $_GET['message'] === 'saved') : ?>
        <div class="lmcp-notice success">
            <?php echo esc_html__('Certificate successfully published / updated.', 'lm-certificate-publisher'); ?>
        </div>
    <?php endif; ?>

    <?php if ($lmcp_current_view === 'grid') : ?>
        <!-- Grid View Layout -->
        <div class="lmcp-certificates-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php if (!empty($lmcp_list_table->items)) : ?>
                <?php foreach ($lmcp_list_table->items as $cert) : ?>
                    <?php
                    $cert_id = $cert->ID;
                    $title = get_the_title($cert_id);
                    $status = get_post_status($cert_id);
                    $date = get_the_date('M j, Y', $cert_id);
                    $edit_url = admin_url('admin.php?page=lmcp_add_certificate&cert_id=' . $cert_id);
                    $delete_nonce = wp_create_nonce('lmcp_delete_cert_' . $cert_id);
                    $delete_url = admin_url('admin.php?page=lmcp_all_certificates&action=delete&cert_id=' . $cert_id . '&_wpnonce=' . $delete_nonce);
                    $categories = get_the_terms($cert_id, 'lmc_certificate_category');
                    ?>
                    <div class="lmcp-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between; border-radius: 8px;">
                        <div class="lmcp-card-body" style="padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                                <span style="font-size: 11px; font-weight: 700; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 4px;">#<?php echo esc_html($cert_id); ?></span>
                                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; padding: 2px 8px; border-radius: 12px; background: <?php echo $status === 'publish' ? '#dcfce7; color: #15803d;' : '#fef9c3; color: #a16207;'; ?>">
                                    <?php echo esc_html($status); ?>
                                </span>
                            </div>
                            <h3 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 700; color: #0f172a; line-height: 1.4;">
                                <a href="<?php echo esc_url($edit_url); ?>" style="text-decoration: none; color: inherit;"><?php echo esc_html($title ? $title : __('(No Title)', 'lm-certificate-publisher')); ?></a>
                            </h3>
                            <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
                                <div style="display: flex; flex-wrap: wrap; gap: 4px; margin-bottom: 12px;">
                                    <?php foreach ($categories as $cat) : ?>
                                        <span style="font-size: 11px; background: #f0fdfa; color: #0f766e; border: 1px solid #99f6e4; padding: 2px 8px; border-radius: 4px;"><?php echo esc_html($cat->name); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <div style="font-size: 12px; color: #64748b; margin-top: 10px;">
                                <span><?php echo esc_html__('Date: ', 'lm-certificate-publisher') . esc_html($date); ?></span>
                            </div>
                        </div>
                        <div class="lmcp-card-footer" style="padding: 12px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <a href="<?php echo esc_url($edit_url); ?>" class="lmcp-button lmcp-button-secondary" style="height: 28px; padding: 0 10px; font-size: 12px;">
                                <?php echo lmcp_icon('edit', 12); ?> <?php echo esc_html__('Edit', 'lm-certificate-publisher'); ?>
                            </a>
                            <a href="<?php echo esc_url($delete_url); ?>" class="lmcp-button lmcp-button-secondary" style="height: 28px; padding: 0 10px; font-size: 12px; color: #dc2626; border-color: #fecaca;" onclick="return confirm('<?php echo esc_js(__('Are you sure you want to delete this certificate?', 'lm-certificate-publisher')); ?>');">
                                <?php echo lmcp_icon('trash', 12); ?> <?php echo esc_html__('Delete', 'lm-certificate-publisher'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="lmcp-card" style="grid-column: 1 / -1;">
                    <div class="lmcp-empty-state" style="text-align: center; padding: 40px 20px;">
                        <h3 style="font-size: 18px; margin-bottom: 8px;"><?php echo esc_html__('No Certificates Found', 'lm-certificate-publisher'); ?></h3>
                        <p style="color: #64748b; margin-bottom: 20px;"><?php echo esc_html__('Get started by creating and publishing your first certificate record.', 'lm-certificate-publisher'); ?></p>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=lmcp_add_certificate')); ?>" class="lmcp-button lmcp-button-primary">
                            <?php echo lmcp_icon('plus', 14); ?> <?php echo esc_html__('Add Certificate', 'lm-certificate-publisher'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <!-- List View Layout -->
        <div class="lmcp-card">
            <div class="lmcp-card-body">
                <form method="post">
                    <?php
                    wp_nonce_field( 'bulk-' . $lmcp_list_table->_args['plural'] );
                    $lmcp_list_table->views();
                    $lmcp_list_table->display();
                    ?>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
