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
                    // loadContent( location.href )
                    oTable.ajax.reload( null, false )
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