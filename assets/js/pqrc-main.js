;(function ($) {
    $(document).ready(function () {
        var current_val = $("#pqrc_toggle").val();

        $('#toggle').minitoggle();

        if( current_val ) {
            $('#toggle .minitoggle').addClass('active');
        }
        $('#toggle').on("toggle", function(e){
            if (e.isActive)
              $("#pqrc_toggle").val(1)
            else
              $("#pqrc_toggle").val(0)
          });
    });
})(jQuery);