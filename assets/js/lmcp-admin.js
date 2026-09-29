/* ========================================================================
   Admin JS For LM Certificate Publisher (Free Edition)
   ======================================================================== */

jQuery(document).ready(function($) {
    'use strict';

    // 0. Whitelabel Logo & Color Injection
    if (typeof lmcpWhitelabel !== 'undefined') {
        if (lmcpWhitelabel.logoUrl && lmcpWhitelabel.logoUrl.trim() !== '') {
            var $logoBoxes = $('.lmcp-header-icon-box, .lmcp-header-logo-box');
            if ($logoBoxes.length) {
                $logoBoxes.each(function() {
                    $(this).replaceWith('<div class="lmcp-header-logo-box"><img src="' + encodeURI(lmcpWhitelabel.logoUrl) + '" alt="Brand Logo" class="lmcp-header-logo-img"></div>');
                });
            }
        }

        if (lmcpWhitelabel.primaryColor && lmcpWhitelabel.primaryColor.trim() !== '') {
            document.documentElement.style.setProperty('--lmcp-primary-color', lmcpWhitelabel.primaryColor);
            document.documentElement.style.setProperty('--lmcp-primary-hover', lmcpWhitelabel.primaryColor);
        }

        if (lmcpWhitelabel.removeCredits) {
            $('.lmcp-admin-footer-credits').hide();
        }
    }

    // 1. Settings Tab Navigation
    $('.lmcp-tab-btn').on('click', function(e) {
        e.preventDefault();
        var tabId = $(this).data('tab');
        if (!tabId) return;

        $('.lmcp-tab-btn').removeClass('active-tab');
        $(this).addClass('active-tab');

        $('.lmcp-tab-content').removeClass('active-content').hide();
        $('#' + tabId).addClass('active-content').show();

        $('#lmcp_active_tab').val(tabId);

        if (typeof(Storage) !== 'undefined') {
            sessionStorage.setItem('lmcp_active_tab', tabId);
        }
    });

    // Restore active tab (URL param takes precedence, then session storage, then first active)
    var urlParams = new URLSearchParams(window.location.search);
    var urlTab = urlParams.get('tab');
    if (urlTab && $('#' + urlTab).length) {
        $('.lmcp-tab-btn[data-tab="' + urlTab + '"]').trigger('click');
    } else if (typeof(Storage) !== 'undefined') {
        var savedTab = sessionStorage.getItem('lmcp_active_tab');
        if (savedTab && $('#' + savedTab).length) {
            $('.lmcp-tab-btn[data-tab="' + savedTab + '"]').trigger('click');
        } else {
            $('.lmcp-tab-btn.active-tab').first().trigger('click');
        }
    }

    // Template card switcher interaction
    $('input[name="lmcp_certificate_template"]').on('change', function() {
        $('.lmcp-template-card').css({
            'border-color': '#e2e8f0',
            'background': '#ffffff'
        });
        $(this).closest('.lmcp-template-card').css({
            'border-color': 'var(--lmcp-primary-color, #14bda9)',
            'background': '#f0fdfa'
        });
    });

    // 2. Custom Field Type Row Dynamic Toggling
    $('#field_type').on('change', function() {
        var type = $(this).val();
        if (type === 'table') {
            $('#lmcp-table-config-row, #lmcp-table-config-col, #lmcp-table-config-headers').show();
            $('#lmcp-default-value-row').hide();
        } else {
            $('#lmcp-table-config-row, #lmcp-table-config-col, #lmcp-table-config-headers').hide();
            $('#lmcp-default-value-row').show();
        }
    }).trigger('change');

    // 3. Sortable Custom Fields
    if ($('#lmcp-sortable-fields').length && typeof $.fn.sortable !== 'undefined') {
        $('#lmcp-sortable-fields').sortable({
            handle: '.lmcp-sort-handle',
            axis: 'y',
            placeholder: 'lmcp-sortable-placeholder',
            cursor: 'move'
        });
    }

    // 4. Copy Slug to Clipboard
    $(document).on('click', '.lmcp-copy-slug', function() {
        var slug = $(this).text().trim();
        if (!slug) return;

        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(slug).select();
        document.execCommand('copy');
        tempInput.remove();

        var notice = $('#lmcp-copy-notice');
        if (!notice.length) {
            notice = $('<div id="lmcp-copy-notice" class="lmcp-copy-notice">Slug copied to clipboard!</div>');
            $('body').append(notice);
        }
        notice.stop(true, true).fadeIn(200).delay(1500).fadeOut(300);
    });

    // 5. Copy Shortcode to Clipboard
    $(document).on('click', '.lmcp-copy-shortcode', function() {
        var $el = $(this);
        var shortcode = $el.data('shortcode') || $el.text().trim();

        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(shortcode).select();
        document.execCommand('copy');
        tempInput.remove();

        var notice = $('#lmcp-copy-notice');
        if (!notice.length) {
            notice = $('<div id="lmcp-copy-notice" class="lmcp-copy-notice">Shortcode copied to clipboard!</div>');
            $('body').append(notice);
        }
        notice.text('Shortcode copied!').stop(true, true).fadeIn(200).delay(1500).fadeOut(300);

        var originalColor = $el.css('color');
        $el.css('color', '#10b981');
        setTimeout(function() {
            $el.css('color', originalColor);
        }, 1500);
    });

    // 6. Media Library Uploader
    $(document).on('click', '.lmcp-upload-button', function(e) {
        e.preventDefault();
        var button = $(this);
        var targetId = button.data('target');
        var inputField = targetId ? $('#' + targetId) : button.siblings('input[type="text"]');

        var mediaUploader = wp.media({
            title: 'Select or Upload Asset',
            button: { text: 'Use Asset' },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            inputField.val(attachment.url);
        });

        mediaUploader.open();
    });

    // 7. Table Field Editor in Add/Edit Certificate
    function lmcpSerializeTable($editor) {
        var tableData = [];
        var $table = $editor.find('.lmcp-editable-table');

        var headerRow = [];
        $table.find('thead tr th input').each(function() {
            headerRow.push($(this).val());
        });
        tableData.push(headerRow);

        $table.find('tbody tr').each(function() {
            var row = [];
            $(this).find('td input').each(function() {
                row.push($(this).val());
            });
            tableData.push(row);
        });

        $editor.find('.lmcp-table-json').val(JSON.stringify(tableData));
    }

    $('body').on('input', '.lmcp-table-header-input, .lmcp-table-cell-input', function() {
        var $editor = $(this).closest('.lmcp-table-editor');
        lmcpSerializeTable($editor);
    });

    $('body').on('click', '.lmcp-table-add-row', function(e) {
        e.preventDefault();
        var $editor = $(this).closest('.lmcp-table-editor');
        var $tbody = $editor.find('tbody');
        var colCount = $editor.find('thead th').length;
        var $tr = $('<tr>');
        for (var i = 0; i < colCount; i++) {
            $tr.append('<td><input type="text" class="lmcp-table-cell-input" value=""></td>');
        }
        $tbody.append($tr);
        lmcpSerializeTable($editor);
    });

    $('body').on('click', '.lmcp-table-add-col', function(e) {
        e.preventDefault();
        var $editor = $(this).closest('.lmcp-table-editor');
        var $theadTr = $editor.find('thead tr');
        var colIndex = $theadTr.find('th').length + 1;
        $theadTr.append('<th><input type="text" class="lmcp-table-header-input" value="" placeholder="Header ' + colIndex + '"></th>');
        $editor.find('tbody tr').each(function() {
            $(this).append('<td><input type="text" class="lmcp-table-cell-input" value=""></td>');
        });
        lmcpSerializeTable($editor);
    });

    $('body').on('click', '.lmcp-table-del-row', function(e) {
        e.preventDefault();
        var $editor = $(this).closest('.lmcp-table-editor');
        var $tbody = $editor.find('tbody');
        if ($tbody.find('tr').length > 1) {
            $tbody.find('tr:last').remove();
            lmcpSerializeTable($editor);
        }
    });

    $('body').on('click', '.lmcp-table-del-col', function(e) {
        e.preventDefault();
        var $editor = $(this).closest('.lmcp-table-editor');
        var $theadTr = $editor.find('thead tr');
        if ($theadTr.find('th').length > 1) {
            $theadTr.find('th:last').remove();
            $editor.find('tbody tr').each(function() {
                $(this).find('td:last').remove();
            });
            lmcpSerializeTable($editor);
        }
    });
});
