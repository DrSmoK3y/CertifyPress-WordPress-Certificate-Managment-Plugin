/* ========================================================================
   Frontend JS For CertifyPress Pro
   ======================================================================== */
   jQuery(document).ready(function($){
    $('#sc-search-btn').on('click', function(e){
        e.preventDefault();

        var searchQuery = $('#sc-search-query').val().trim();
        var categorySelector = $('#sc-category-selector');
        var tagSelector = $('#sc-tag-selector');
        var resultsDiv = $('#sc-search-results');

        if (searchQuery.length < 3) {
            resultsDiv.html('<p style="color: red;">Please enter at least 3 characters to search.</p>');
            return; 
        }

        if (categorySelector.length > 0) {
            var category = categorySelector.val();
            if (category === '') {
                resultsDiv.html('<p style="color: red;">Please select a category to search.</p>');
                return; 
            }
        }

        if (tagSelector.length > 0) {
            var tag = tagSelector.val();
            if (tag === '') {
                resultsDiv.html('<p style="color: red;">Please select a tag to search.</p>');
                return; 
            }
        }


        var categoryVal = categorySelector.val() || '';
        var tagVal      = tagSelector.val() || '';

        resultsDiv.html('<p>Searching...</p>');

        $.ajax({
            url: sc_ajax_obj.ajax_url,
            type: 'POST',
            data: {
                action: 'sc_ajax_search',
                nonce: sc_ajax_obj.nonce,
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
                        resultsDiv.html('<p>No results found.</p>');
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

    $('#sc-print-btn').on('click', function(){
        var printContent = document.getElementById('sc-search-results').innerHTML;
        if(printContent === "" || printContent.includes('<p>')) {
            alert('Nothing to print.');
            return;
        }
        var originalContent = document.body.innerHTML;
        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Certificate</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        setTimeout(function(){
            printWindow.print();
        }, 500);
    });
});
