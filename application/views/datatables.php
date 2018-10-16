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
</section>
<!-- /.content -->