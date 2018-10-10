base_url = jQuery('#base_url').val()
site_url = jQuery('#site_url').val()

jQuery(document).ajaxStart(function () {
    Pace.restart();
})

jQuery(document).ready(function () {
    
    jQuery(document).on('click', 'a:not([href="#"]):not(.not-ajax)', function(e) {

        var node = this
        e.preventDefault()
        loadContent( node.href )

    })

    jQuery(document).on('click', 'a[href="#"]', function(e) {

        e.preventDefault()

    })

    $('.content-wrapper').on('submit', '.submitForm', function(e) {

        var form = this
        e.preventDefault()

        var formData = {}
        if ( form.method.toLowerCase() == 'post' ) {
            formData = new FormData(form)
        }

        jQuery.ajax({
            url: form.action,
            dataType: 'json',
            type: form.method,
            data: formData,
            processData: false,
            contentType: false, 
            beforeSend: function() {
                $(form).siblings('.overlay').show()
            },
            success: function ( r ) {
                if ( r.status == true ) {
                    loadContent( location.href )
                    $('#modal-default').modal('hide')
                } else {
                    console.error( r )
                }
            },
            error: function ( e ) {
                console.error( e )
            },
            complete: function() {
                $(form).siblings('.overlay').hide()
            }
        })
    
    })

    updateUIOnPage()

})

function updateUIOnPage(params) {
    
    $('input[type="checkbox"]:not(.minimal), input[type="radio"]:not(.minimal)').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    })

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })

    $('.dataTable').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
    })

    $('.select2').select2()

}

function loadContent( href ) {

    jQuery.ajax({
        url: href,
        dataType: 'html',
        type: 'get',
        success: function ( r ) {
            if ( r.trim() ) {
                jQuery('.content-wrapper').html( r )
                var ix = href.lastIndexOf('/')
                var page = href.substring(ix)
                history.pushState({}, page, href)

                updateUIOnPage()
            } else {
                console.error( r )
            }
        },
        error: function ( e ) {
            console.error( e )
        }
    })

}

function add_row() {

    $('#id').val('')

}

function edit_row( node, id, url, editCallback ) {

    jQuery.ajax({
        url: url,
        dataType: 'json',
        type: 'get',
        beforeSend: function() {
            $(node).closest('tr').addClass('box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>')
        },
        success: function ( r ) {
            
            if ( r.status == true ) {
                
                $('#id').val( id )
                if ( typeof editCallback === 'function' ) {
                    
                    editCallback( r )

                }
                $('#modal-default').modal('show')
                $(node).closest('tr').removeClass('box').find('.overlay').remove()

            } else {
                console.error( r )
            }
        },
        error: function ( e ) {
            console.error( e )
        }
    })

}

function delete_row( node, id, url, deleteCallback ) {
    
    jQuery.ajax({
        url: url,
        dataType: 'json',
        type: 'get',
        beforeSend: function() {
            $(node).closest('tr').addClass('box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>')
        },
        success: function ( r ) {
            if ( r.status == true ) {

                if ( typeof deleteCallback === 'function' ) {
                    
                    deleteCallback( r )

                }
                $(node).closest('tr').slideUp('slow', function() {

                    $(node).closest('tr').remove()

                })

            } else {
                console.error( r )
            }
        },
        error: function ( e ) {
            console.error( e )
        }
    })

}