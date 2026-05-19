/* ========================================================================
   Admin JS For CertifyPress Pro
   ======================================================================== */
jQuery(document).ready(function($){

    // === START: Code for Field Sorting (Improved) ===
    if ($('#sc-sortable-fields').length > 0) {
        $('#sc-sortable-fields').sortable({
            placeholder: "sc-sortable-placeholder",
            handle: ".sc-sort-handle",
            update: function(event, ui) {
            }
        }).disableSelection();
    }
    // === END: Code for Field Sorting ===

    // === START: Code for copying slug to clipboard (New) ===
    $('body').on('click', '.sc-copy-slug', function(e){
        e.preventDefault();
        var slugText = $(this).text();
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(slugText).select();
        document.execCommand('copy');
        tempInput.remove();

        var notice = $('#sc-copy-notice');
        if(notice.length === 0) {
            alert('Slug copied to clipboard!');
        } else {
            notice.fadeIn();
            setTimeout(function(){
                notice.fadeOut();
            }, 2000);
        }
    });
    // === END: Code for copying slug ===


    // === START: Code for Media Uploader ===
    var media_frame;
    $('body').on('click', '.sc-upload-button', function(e) {
        e.preventDefault();

        var target_input_id = $(this).data('target');
        var target_input = $('#' + target_input_id);

        if (media_frame) {
            media_frame.open();
            return;
        }

        media_frame = wp.media({
            title: 'Choose File',
            button: {
                text: 'Select File'
            },
            multiple: false
        });

        media_frame.on('select', function(){
            var attachment = media_frame.state().get('selection').first().toJSON();
            target_input.val(attachment.url);
        });

        media_frame.open();
    });
    // === END: Code for Media Uploader ===

    // === START: Existing Search and Print Code ===
    $('#sc-search-btn').on('click', function(e){
        e.preventDefault();

        var searchQuery = $('#sc-search-query').val().trim();
        var categorySelector = $('#sc-category-selector');
        var tagSelector = $('#sc-tag-selector');
        var resultsDiv = $('#sc-search-results');

        resultsDiv.html(''); 

        if (searchQuery.length < 3) {
            resultsDiv.html('<p style="color: red;">Please enter at least 3 characters to search.</p>');
            return; 
        }
        if (categorySelector.length > 0 && categorySelector.val() === '') {
            resultsDiv.html('<p style="color: red;">Please select a category to search.</p>');
            return;
        }
        if (tagSelector.length > 0 && tagSelector.val() === '') {
            resultsDiv.html('<p style="color: red;">Please select a tag to search.</p>');
            return;
        }

        var categoryVal = categorySelector.val() || '';
        var tagVal      = tagSelector.val() || '';

        var isSimpleSearch = (categorySelector.length === 0 && tagSelector.length === 0);

        resultsDiv.html('<p>Searching...</p>');

        $.ajax({
            url: sc_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'sc_ajax_search',
                nonce: sc_ajax_obj.nonce,
                search_query: searchQuery,
                category: categoryVal,
                tag: tagVal,
                is_simple_search: isSimpleSearch 
            },
            success: function(response) {
                if(response.success) {
                    resultsDiv.empty();
                    if(response.data.length > 0) {
                        $.each(response.data, function(index, certificateHtml){
                           resultsDiv.append(certificateHtml);
                        });
                    } else {
                        resultsDiv.html('<p>No results found.</p>');
                    }
                } else {
                     resultsDiv.html('<p>An error occurred. Please try again.</p>');
                }
            },
            error: function() {
                 resultsDiv.html('<p>An error occurred while searching. Please try again.</p>');
            }
        });
    });

    $('#sc-print-btn').on('click', function(){
        var printContent = document.getElementById('sc-search-results').innerHTML;
        if(printContent === "" || printContent.includes('<p>')) {
            alert('Nothing to print.');
            return;
        }
        var printWindow = window.open('', '', 'height=800,width=800');
        printWindow.document.write('<html><head><title>Print Certificate</title></head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        setTimeout(function(){
            printWindow.print();
        }, 500);
    });
    // === END: Existing Search and Print Code ===

});
