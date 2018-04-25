
(function($){
    // Retain count concept: http://stackoverflow.com/a/2420247/260665
    // Callers should make sure that for every invocation of loadingSpinner method there has to be an equivalent invocation of removeLoadingSpinner
    var retainCount = 0;

    // http://stackoverflow.com/a/13992290/260665 difference between $.fn.extend and $.extend
    $.extend({
        loadingSpinner: function() {
            // add the overlay with loading image to the page
            var over = '<div id="custom-loading-overlay">' +
                '<i id="custom-loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="font-size:48px; color: #470A68;"></i>'+
                '</div>';
            if (0===retainCount) {
                $(over).appendTo('body');
            }
            retainCount++;
        },
        removeLoadingSpinner: function() {
            retainCount--;
            if (retainCount<=0) {
                $('#custom-loading-overlay').remove();
                retainCount = 0;
            }
        }
    });
}(jQuery)); 