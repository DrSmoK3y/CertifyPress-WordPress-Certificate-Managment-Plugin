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
        var printWindow = window.open('', '', 'height=800,width=1000');
        printWindow.document.write('<html><head><title>Print Certificate</title></head><body>');
        printWindow.document.write('<style>');
        printWindow.document.write('body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,sans-serif;line-height:1.5;color:#2c3338;padding:20px;}');
        printWindow.document.write('table{width:100%;border-collapse:collapse;margin-bottom:20px;}');
        printWindow.document.write('th,td{border:1px solid #ddd;padding:12px;text-align:left;}');
        printWindow.document.write('th{background-color:#f1f1f1;font-weight:600;}');
        printWindow.document.write('img{max-width:150px;height:auto;}');
        printWindow.document.write('a{color:#2271b1;text-decoration:none;}');
        printWindow.document.write('a.sc-download-btn{display:inline-block;padding:8px 16px;background:#2271b1;color:#fff;border-radius:3px;text-decoration:none;}');
        printWindow.document.write('</style>');
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



document.addEventListener('DOMContentLoaded', function () {

    const shortcodes = document.querySelectorAll('.sc-copy-shortcode');

    shortcodes.forEach(function(item){

        item.addEventListener('click', async function(){

            const shortcode = this.getAttribute('data-shortcode');

            try {

                await navigator.clipboard.writeText(shortcode);

                const originalText = this.textContent;

                this.textContent = 'Copied!';

                this.classList.add('copied');

                setTimeout(() => {
                    this.textContent = shortcode;
                    this.classList.remove('copied');
                }, 1500);

            } catch (err) {

                console.error('Copy failed', err);

            }

        });

    });

});

