/* ========================================================================
   Frontend JS For LM Certificate Publisher
   ======================================================================== */
jQuery(document).ready(function($){
    $('#lmcp-search-btn').on('click', function(e){
        e.preventDefault();

        var searchQuery = $('#lmcp-search-query').val().trim();
        var categorySelector = $('#lmcp-category-selector');
        var tagSelector = $('#lmcp-tag-selector');
        var resultsDiv = $('#lmcp-search-results');

        if (searchQuery.length < 3) {
            resultsDiv.html('<p style="color: red;">Please enter at least 3 characters to search.</p>');
            return; 
        }

        var categoryVal = (categorySelector.length > 0) ? (categorySelector.val() || '') : '';
        var tagVal      = (tagSelector.length > 0) ? (tagSelector.val() || '') : '';

        var searchingText = (typeof lmcp_ajax_obj !== 'undefined' && lmcp_ajax_obj.labels && lmcp_ajax_obj.labels.searching) ? lmcp_ajax_obj.labels.searching : 'Searching...';
        var noResultsText = (typeof lmcp_ajax_obj !== 'undefined' && lmcp_ajax_obj.labels && lmcp_ajax_obj.labels.no_results) ? lmcp_ajax_obj.labels.no_results : 'No results found.';

        resultsDiv.html('<p>' + searchingText + '</p>');

        $.ajax({
            url: lmcp_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'lmcp_ajax_search',
                nonce: lmcp_ajax_obj.nonce,
                search_query: searchQuery,
                category: categoryVal,
                tag: tagVal
            },
            success: function(response) {
                if(response.success) {
                    resultsDiv.empty();
                    if(response.data.length > 0) {
                        $.each(response.data, function(index, certificateHtml){
                           resultsDiv.append(certificateHtml);
                        });
                    } else {
                        resultsDiv.html('<p>' + noResultsText + '</p>');
                    }
                } else {
                     resultsDiv.html('<p>An error occurred.</p>');
                }
            },
            error: function() {
                 resultsDiv.html('<p>An error occurred while searching.</p>');
            }
        });
    });

    // 1-Click Copy Verification Link Handler
    $(document).on('click', '.lmcp-copy-link-btn', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var url = $btn.data('url') || window.location.href;
        var originalText = $btn.find('.lmcp-copy-btn-text').text();
        var copiedText = (typeof lmcp_ajax_obj !== 'undefined' && lmcp_ajax_obj.labels && lmcp_ajax_obj.labels.copied) ? lmcp_ajax_obj.labels.copied : 'Copied to clipboard!';

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url).then(function() {
                $btn.find('.lmcp-copy-btn-text').text(copiedText);
                setTimeout(function() {
                    $btn.find('.lmcp-copy-btn-text').text(originalText);
                }, 2000);
            }).catch(function() {
                fallbackCopy(url, $btn, originalText, copiedText);
            });
        } else {
            fallbackCopy(url, $btn, originalText, copiedText);
        }
    });

    function fallbackCopy(url, $btn, originalText, copiedText) {
        var $temp = $('<input style="position:fixed; opacity:0;">');
        $('body').append($temp);
        $temp.val(url).select();
        document.execCommand('copy');
        $temp.remove();
        $btn.find('.lmcp-copy-btn-text').text(copiedText);
        setTimeout(function() {
            $btn.find('.lmcp-copy-btn-text').text(originalText);
        }, 2000);
    }

    $('#lmcp-print-btn').on('click', function(){
        var $results = $('#lmcp-search-results');
        if (!$results.find('.lmcp-cert-table, .lmcp-cert-vertical-template').length) {
            alert('Please search and find a certificate before printing.');
            return;
        }

        // Clone to remove social share bar from print
        var $clone = $results.clone();
        $clone.find('.lmcp-social-share-wrap').remove();
        var printContent = $clone.html();

        var printWindow = window.open('', '', 'height=800,width=1000');
        printWindow.document.write('<!DOCTYPE html><html><head><title>Print Certificate</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('* { box-sizing: border-box; }');
        printWindow.document.write('body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;line-height:1.5;color:#0f172a;padding:24px;background:#ffffff;}');
        printWindow.document.write('.lmcp-cert-table{width:100%;border-collapse:collapse;margin-bottom:24px;border:1px solid #cbd5e1;}');
        printWindow.document.write('.lmcp-cert-table th,.lmcp-cert-table td{border:1px solid #cbd5e1;padding:12px 16px;text-align:left;}');
        printWindow.document.write('.lmcp-cert-table th{background-color:#f8fafc;font-weight:700;font-size:16px;}');
        printWindow.document.write('.lmcp-cert-vertical-template{border:1px solid #cbd5e1;border-radius:6px;margin-bottom:24px;overflow:hidden;}');
        printWindow.document.write('.lmcp-cert-vertical-header{background:#f8fafc;border-bottom:1px solid #cbd5e1;padding:16px 20px;}');
        printWindow.document.write('.lmcp-cert-vertical-badge{display:inline-block;font-size:10px;font-weight:700;text-transform:uppercase;background:#0f172a;color:#ffffff;padding:2px 8px;border-radius:3px;margin-bottom:6px;}');
        printWindow.document.write('.lmcp-cert-vertical-title{margin:0;font-size:18px;font-weight:700;color:#0f172a;}');
        printWindow.document.write('.lmcp-cert-vertical-body{padding:16px 20px;}');
        printWindow.document.write('.lmcp-cert-field-vertical{border-bottom:1px solid #f1f5f9;padding:10px 0;}');
        printWindow.document.write('.lmcp-cert-field-vertical:last-child{border-bottom:none;}');
        printWindow.document.write('.lmcp-cert-label-vertical{font-size:11px;font-weight:700;text-transform:uppercase;color:#64748b;margin-bottom:3px;}');
        printWindow.document.write('.lmcp-cert-value-vertical{font-size:14px;color:#0f172a;}');
        printWindow.document.write('.lmcp-sub-table{width:100%;border-collapse:collapse;margin-top:6px;border:1px solid #e2e8f0;}');
        printWindow.document.write('.lmcp-sub-table th,.lmcp-sub-table td{border:1px solid #e2e8f0;padding:6px 10px;font-size:12px;text-align:left;}');
        printWindow.document.write('.lmcp-sub-table th{background:#f8fafc;font-weight:700;}');
        printWindow.document.write('img{max-width:160px;height:auto;border-radius:4px;}');
        printWindow.document.write('a{color:#0284c7;text-decoration:none;}');
        printWindow.document.write('@media print { body { padding: 0; } .lmcp-cert-vertical-template, .lmcp-cert-table { page-break-inside: avoid; } }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        setTimeout(function(){
            printWindow.print();
        }, 500);
    });
});
