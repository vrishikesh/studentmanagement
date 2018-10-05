<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo $title ?>
    <small><?php echo $short_desc ?></small>
    </h1>
    <?php if ( isset( $breadcrumb ) ) {
        echo '<ol class="breadcrumb">';
        foreach ($breadcrumb as $path) {
            echo "<li class='{$path['class']}'><a href='{$path['url']}'>{$path['name']}</a></li>";
        }
        echo '</ol>';
    } ?>
    
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $title ?></h3>
            <?php if ( isset( $listButtons ) ) { ?>
                <div class="box-tools pull-right">
                    <?php foreach ($listButtons as $listButton) {
                        echo "<{$listButton['type']} type='{$listButton['type']}' {$listButton['attr']}>{$listButton['text']}</{$listButton['type']}>";
                    } ?>
                </div>
            <?php } ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover dataTable">
            <thead>
            <tr>
                <th><?php echo implode('</th><th>', $thead) ?></th>
            </tr>
            </thead>
            <tbody>
            <?php 
            if ( ! empty( $tbody ) ) {
                foreach ($tbody as $row) { ?>
                <tr>
                    <td><?php echo implode('</td><td>', $row) ?></td>
                </tr>
            <?php }
            } else { ?>
                <tr><td colspan="<?php echo count($thead) ?>">No Records Found</td></tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th><?php echo implode('</th><th>', $thead) ?></th>
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</section>
<!-- /.content -->