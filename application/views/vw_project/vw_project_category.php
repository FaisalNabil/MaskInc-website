<div class="page-title">
    <div class="title-env">
        <h1 class="title">Project Category</h1>
        <p class="description">Project Category Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="<?php echo base_url()?>home"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="<?= site_url('admin/project/category') ?>"><i class="fa-user"></i>Project Category</a>
            </li>
            <li class="active">
                <strong>Manage Project Category</strong>
            </li>
        </ol>
    </div>
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
    <div class="panel-heading">
        <?php $this->load->view($alert_msg); ?>
    </div>
    <div class="action_panel">
        <a href="javascript:void(0)" class="btn btn-primary btn-icon icon-left"  onclick="jQuery('#add_group_modal').modal('show', {backdrop: 'fade'});"><i class="fa fa-plus-circle"></i> Add New Category</a>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="project_category" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#Sl</th>
                        <th>Category Name</th>
                        <th>Created By</th>
                        <th>Created On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add_group_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Category</h4>
            </div>

            <form  method="POST" class="validate">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" data-validate="required" id="category_name" class="form-control" placeholder="Enter Category Name" required="true">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="status" name="status" data-validate="required">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" onclick=" return add_category('add')" name="submit" id="submit" value="Save Menu">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_project_cat">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Categroy</h4>
            </div>

            <form  method="POST" class="validate">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name_edit" data-validate="required" id="category_name_edit" class="form-control" placeholder="Enter Category Name" required="true">
                        <input type="hidden" name="category_id_edit" id="category_id_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="status_edit" name="status_edit" data-validate="required">

                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-info" onclick=" return add_category('update')" name="submit" id="submit" value="Save Menu">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ($) {
        $("#project_category").dataTable({
            "ajax": {
                "url": '<?= base_url('admin/project/add_new_category'); ?>',
                "type": 'GET'
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                title: ''
            },{
                extend: 'excel',
                title: 'Stock Position'
            }
            ],
            "bPaginate": true,
        });
    });

    function add_category(type=null){


        event.preventDefault();
        if(type == 'add'){
            var cat_name = $("#category_name").val();
            var status = $("#status").val();

            if(cat_name != ""){
                $("#add_group_modal").modal('hide');
            }
        }else{
            var cat_name = $("#category_name_edit").val();
            var status = $("#status_edit").val();
            var category_id_edit = $("#category_id_edit").val();

            if(cat_name != null){
                $("#edit_project_cat").modal('hide');
            }

        }


        var table = $('#project_category').DataTable();
        table.destroy();
        $("#project_category").dataTable({
            "ajax": {
                "url": '<?= base_url('admin/project/add_new_category'); ?>',
                "type": 'POST',
                "data": {cat_name:cat_name,status:status,type:type,category_id:category_id_edit}
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                title: ''
            },{
                extend: 'excel',
                title: 'Stock Position'
            }
            ],
            "bPaginate": true,
        });
    }
    
    function edit_category(id) {
        $.ajax({
            type:'POST',
            data:{id:id},
            url:"<?php echo site_url('admin/project/individual_project_cat')?>",
            dataType:'json',
            success:function (result) {
                $("#category_name_edit").val(result[1]);
                $("#category_id_edit").val(result[0]);
                $("#status_edit").html(result[2]);
                $("#edit_project_cat").modal('show');
            },
            error:function (result) {

            }
        })
    }
    function delete_category(id) {
        if (confirm('Are you sure to delete the category?')){
            $.ajax({
                type:'POST',
                data:{id:id},
                url:"<?php echo site_url('admin/project/delete_category')?>",
                success:function (result) {
                    location.reload();
                },
                error:function (result) {

                }
            })
        }else{
            return false;
        }
    }


</script>