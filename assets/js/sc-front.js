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
        var printWindow = window.open('', '', 'height=800,width=1000');
        printWindow.document.write('<html><head><title>Print Certificate</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,sans-serif;line-height:1.5;color:#2c3338;padding:20px;}');
        printWindow.document.write('table{width:100%;border-collapse:collapse;margin-bottom:20px;}');
        printWindow.document.write('th,td{border:1px solid #ddd;padding:12px;text-align:left;}');
        printWindow.document.write('th{background-color:#f1f1f1;font-weight:600;}');
        printWindow.document.write('img{max-width:150px;height:auto;}');
        printWindow.document.write('a{color:#2271b1;text-decoration:none;}');
        printWindow.document.write('a.sc-download-btn{display:inline-block;padding:8px 16px;background:#2271b1;color:#fff;border-radius:3px;text-decoration:none;}');
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
