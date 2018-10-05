base_url = jQuery('#base_url').val()
site_url = jQuery('#site_url').val()

jQuery(document).ajaxStart(function () {
    Pace.restart();
})

jQuery(document).ready(function () {
    
    jQuery(document).on('click', 'a:not([href="#"]):not(.not-ajax)', function(e) {

        var node = this
        e.preventDefault()
        jQuery.ajax({
            url: node.href,
            dataType: 'html',
            success: function ( r ) {
                if ( r.trim() ) {
                    jQuery('.content-wrapper').html( r )
                    // var ix = node.href.lastIndexOf('/')
                    // var page = node.href.substring(ix)
                    // history.pushState({}, page, node.href)

                    updateUIOnPage()
                } else {
                    console.log( r )
                }
            },
            error: function ( e ) {
                console.log( e )
            }
        })

    })

    jQuery(document).on('click', 'a[href="#"]', function(e) {

        e.preventDefault()

    })

    updateUIOnPage()

})

function updateUIOnPage(params) {
    
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    })

    $('.dataTable').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
    })

}