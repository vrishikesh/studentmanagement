<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    User Roles
    <small>user role list</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Administration</a></li>
    <li class="active">User Roles</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Roles</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default" onclick="add_row()"><i class="fa fa-plus"></i> Add User Role</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-hover dataTable">
            <thead>
            <tr>
                <th>Role Name</th>
                <th>Description</th>
                <th>Color</th>
                <th>Permissions</th>
                <th>Is Admin</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            if ( ! empty( $user_roles ) ) {
                foreach ($user_roles as $user_role) { ?>
                <tr>
                    <td><?php echo $user_role->NAME ?></td>
                    <td><?php echo $user_role->DESCRIPTION ?></td>
                    <td><?php echo $user_role->BGCOLOR ?></td>
                    <td><?php echo $user_role->PERMISSIONS ?></td>
                    <td><?php echo $user_role->IS_ADMIN ?></td>
                    <td><?php echo $user_role->USER_ID ?></td>
                    <td>
                        <a href="#" onclick="edit_row(this, <?php echo $user_role->ID ?>, '<?php echo Url::Site . 'user/user_roles/edit/' . $user_role->ID ?>')"><i class="fa fa-edit"></i></a>
                        <a href="#" onclick="delete_row(this, <?php echo $user_role->ID ?>, '<?php echo Url::Site . 'user/user_roles/delete/' . $user_role->ID ?>')"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php }
            } else { ?>
                <tr><td colspan="6"></tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Role Name</th>
                <th>Description</th>
                <th>Color</th>
                <th>Permissions</th>
                <th>Is Admin</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content box">
                <form role="form" class="submitForm" action="<?php echo Url::Site . 'user/user_roles/save' ?>" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add User Role</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="role_name">Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="role_desc">Description</label>
                                <input type="text" class="form-control" id="role_desc" name="role_desc" placeholder="Enter Description">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="assigned_list">Module List</label>
                                <div class="form-control module-list">
                                    <?php echo $generated_module_list ?>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="assigned_list"></label>
                                <div class="">
                                    <div><input type="checkbox" class="minimal" id="selectall"><label for="selectall"><h5>&nbsp;&nbsp;Select All</h5></label></div>
                                    <div><input type="checkbox" class="minimal" id="unselectall"><label for="unselectall"><h5>&nbsp;&nbsp;Unselect All</h5></label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                <div class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
<!-- /.content -->
<script>
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
</script>