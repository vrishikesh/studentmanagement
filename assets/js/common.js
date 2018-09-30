base_url = jQuery('#base_url').val()
site_url = jQuery('#site_url').val()

jQuery(document).ajaxStart(function () {
    jQuery('#overlay').css('display', 'block');
})

jQuery(document).ajaxComplete(function () {
    jQuery('#overlay').css('display', '');
})

jQuery(document).ready(function () {
    
    jQuery(document).on('click', 'a:not([href="#"])', function(e) {

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

})