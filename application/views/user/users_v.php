<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Users
    <small>user list</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Administration</a></li>
    <li class="active">Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <h3 class="box-title">Users</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Role</th>
                <th>Last Login</th>
                <th>Is Online</th>
                <th>Brand</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            if ( ! empty( $users ) ) {
                foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user->USERNAME ?></td>
                    <td><?php echo $user->EMAIL ?></td>
                    <td><?php echo $user->USER_ROLE ?></td>
                    <td><?php echo $user->LAST_LOGIN ?></td>
                    <td><?php echo $user->ACTIVE ?></td>
                    <td><?php echo $user->OA_BRAND_ID ?></td>
                </tr>
            <?php }
            } else { ?>
                <tr><td colspan="6"></tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>User Role</th>
                <th>Last Login</th>
                <th>Is Online</th>
                <th>Brand</th>
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