<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $module_name ?>
    <!-- <small>user role list</small> -->
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $home ?></a></li>
    <li><a href="#"><?php echo $module_name ?></a></li>
    <li class="active"><?php echo $page_title ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $page_title ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default" onclick="add_row()"><i class="fa fa-plus"></i> <?php echo $add_form_button ?></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <input type="hidden" id="serialized_table_data" value="<?php echo $serialized_table_data ?>">
            <table class="table table-bordered table-hover dataTable">
            <thead>
            <tr>
                <th><?php echo implode('</th><th>', $table_columns) ?></th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th><?php echo implode('</th><th>', $table_columns) ?></th>
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

    <?php echo $generated_form ?>
    <!-- <div class="modal fade" id="modal-default">
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
                                    <?php // echo $generated_module_list ?>
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
            <!-- /.modal-content ->
        </div>
        <!-- /.modal-dialog ->
    </div> -->
</section>
<!-- /.content -->