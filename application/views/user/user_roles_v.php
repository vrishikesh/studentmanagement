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
                <button type="button" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add User Role</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Role Name</th>
                <th>Description</th>
                <th>Color</th>
                <th>Permissions</th>
                <th>Is Admin</th>
                <th>User</th>
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
</section>
<!-- /.content -->