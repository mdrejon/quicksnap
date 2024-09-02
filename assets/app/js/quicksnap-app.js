/**
 *  Quicksnap App JS
 * 
 * @since 1.0
 */
          
(function($) {	
    $(document).ready(function(){
        // input fiend on change
        $('input[name="wtdqs-search-field"]').on('keyup', function() { 

            $this = $(this);
            let searchValue = $this.val(),
                thisParent =  $this.closest('.wtdqs-quicksnap'),
                postId = thisParent.data('id'),
                // svg preloader
                preloader = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="none" stroke-opacity="1" stroke="#000000" stroke-width=".5" cx="100" cy="100" r="0"><animate attributeName="r" calcMode="spline" dur="2" values="1;80" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate><animate attributeName="stroke-width" calcMode="spline" dur="2" values="0;25" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate><animate attributeName="stroke-opacity" calcMode="spline" dur="2" values="1;0" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate></circle></svg>';

            // if search value string is 3 or more
            if(searchValue.length >= 3) { 
                // Your code here
                // add class to show active
                thisParent.find('.wtdqs-search-result').addClass('active');
                thisParent.find('.wtdqs-search-result').html('<div class="wtdqs-quicksnap-loading">'+preloader+'</div>');
                // ajax call
                $.ajax({
                    url: wtdqs_ajax.wtdqs_ajax_url,
                    type: 'post',
                    data: {
                        action: 'wtdqs_quicksnap_shortcode_ajax',
                        searchValue: searchValue,
                        postId: postId,
                        quicksnapNonce: wtdqs_ajax.wtdqs_nonce
                    },
                    success: function(response) { 
                        console.log(response);
                        if(response == '') {
                            response = '<div class="wtdqs-quicksnap-no-result">No result found</div>';
                        }
                        // Your code here
                        thisParent.find('.wtdqs-search-result').html('');
                        thisParent.find('.wtdqs-search-result').html(response);
                    }
                });
            }else{
                // remove class to hide active
                thisParent.find('.wtdqs-search-result').removeClass('active');
            }
        
            // Your code here
        });
    });
})(jQuery);