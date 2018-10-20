base_url = jQuery('#base_url').val()
site_url = jQuery('#site_url').val()

jQuery(document).ajaxStart(function () {
    Pace.restart();
})

jQuery(document).ready(function () {
    
    jQuery(document).on('click', 'a:not([target="_blank"]):not([href^="#"]):not(.not-ajax)', function(e) {

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
                    oTable.ajax.reload( null, false )
                    $('#modal-default').modal('hide')
                } else {
                    console.log( r )
                    $('.modal-body .alert')
                            .find('p').remove().end()
                            .append( r.msg ).closest('.row').show()
                }
            },
            error: function ( x, e ) {
                show_error( get_error( x, e ) )
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

    var pagelength = parseInt( localStorage.getItem('pagelength110456289') );
	pagelength = isNaN( pagelength ) ? 10 : pagelength;
    window.oTable = $('.dataTable').DataTable({
        'paging'        : true,
        'lengthChange'  : true,
        'searching'     : true,
        'ordering'      : false,
        'info'          : true,
        'autoWidth'     : true,
        'processing'    : true,
        'serverSide'    : true,
        'sServerMethod' : 'POST',
        'pageLength'    : pagelength,
        'ajax'          : {

            url : site_url + 'common/common/get_table_data',
            type: 'post',
            data: { 'serialized_table_data' : $('#serialized_table_data').val() },
            error: function( x, e ) {

                show_error( get_error( x, e ) )

            },
            complete: function() {
                // jQuery('.datatable').find('tbody tr').each(function(i, v) {
                //     jQuery(this).find('td:not(:first):not(:last)').css('cursor', 'pointer');
                //     jQuery(this).find('td:not(:first):not(:last)').click(function() {
                //         var $span = jQuery(this).parent().find("[title=Edit]");
                //         if( $span.length > 0 )
                //         {
                //             var href = $span.parent().attr('href');
                //             if( href )
                //                 location.href = href;
                //         }
                //     });
                // });
            }

        },
        'columnDefs': [{
            'targets'       : 0,
            'searchable'    : false,
            'orderable'     : false,
            'visible'       : false,
            'className'     : 'dt-body-center'
        }]
    })

    $('select[name="DataTables_Table_0_length"]').change(function() {

		localStorage.setItem('pagelength110456289', jQuery(this).val());
		
	});

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
                var controller = href.replace( site_url, '' )
                var js_url = site_url + 'assets/js/' + controller + '.js';
                cachedScript( js_url )
                var ix = href.lastIndexOf('/')
                var page = href.substring(ix)
                history.pushState({}, page, href)

                updateUIOnPage()
            } else {
                show_error( 'Content not found' )
            }
        },
        error: function ( x, e ) {
            show_error( get_error( x, e ) )
        }
    })

}

function add_row() {

    $('#id').val('')
    $('.modal-body .alert')
            .find('p').remove().end()
            .closest('.row').hide()

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
                $('.modal-body .alert')
                        .find('p').remove().end()
                        .closest('.row').hide()
                $('#modal-default').modal('show')
                $(node).closest('tr').removeClass('box').find('.overlay').remove()

            } else {
                show_error( r.msg )
            }
        },
        error: function ( x, e ) {
            show_error( get_error( x, e ) )
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
                show_error( r.msg )
            }
        },
        error: function ( x, e ) {
            show_error( get_error( x, e ) )
        }
    })

}

function get_error(x, e) {

    if ( x.status == 0 ) {

        return 'You are offline!!\n Please Check Your Network.'

    } else if( x.status == 404 ) {

        return 'Requested URL not found.'

    } else if( x.status == 500 ) {

        return 'Internel Server Error.'

    } else if( e == 'parsererror' ) {

        return 'Error.\nParsing JSON Request failed.'

    } else if( e == 'timeout' ) {

        return 'Request Time out.'

    } else {

        return x.responseText

    }

}

function show_error( msg = '' ) {

    if ( msg != '' ) {
        
        alertify.error( msg );

    }
    
}