base_url = jQuery('#base_url').val()
site_url = jQuery('#site_url').val()

jQuery(document).ajaxStart(function () {
    Pace.restart();
})

jQuery(document).ready(function () {
    
    jQuery(document).on('click', 'a:not([href="#"]):not(.not-ajax)', function(e) {

        e.preventDefault()
        jQuery.ajax({
            url: this.href,
            dataType: 'html',
            success: function ( r ) {
                if ( r.trim() ) {
                    jQuery('.content-wrapper').html( r )
                } else {
                    console.log( r )
                }
            },
            error: function ( e ) {
                console.log( e )
            }
        })

    })

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });

})