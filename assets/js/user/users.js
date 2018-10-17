function editCallback( r ) {

    $('#user_name').val( r.USERNAME )
    $('#email').val( r.EMAIL )
    $('#user_role').val( r.USER_ROLE_ID ).select2()

}
function deleteCallback( r ) { }