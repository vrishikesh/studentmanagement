$(document).ready(function() {

    $('#selectall').on('ifChecked', function() {

        $('#unselectall').iCheck('uncheck')
        $('.module-list :checkbox').iCheck('check')

    })

    $('#unselectall').on('ifChecked', function() {

        $('#selectall').iCheck('uncheck')
        $('.module-list :checkbox').iCheck('uncheck')

    })

})

function editCallback( r ) {

    $('#role_name').val( r.NAME )
    $('#priority').val( r.PRIORITY )
    $('#role_desc').val( r.DESCRIPTION )
    const permissionList = r.PERMISSIONS.split(',')
    for (const module of document.querySelectorAll('[name^="module"]')) {
        
        const moduleId = $(module).data('id') + ""
        if( permissionList.indexOf( moduleId ) !== -1 ) {

            $(module).iCheck('check')

        } else {

            $(module).iCheck('uncheck')

        }

    }

}
function deleteCallback( r ) { }