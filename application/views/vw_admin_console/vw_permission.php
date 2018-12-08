<div class="page-title">
    <div class="title-env">
        <h1 class="title">Menu List</h1>
        <p class="description">Menu Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1" >
            <li>
                <a href="dashboard-1.html"><i class="fa-cog"></i>Admin Console</a>
            </li>
            <li class="active">
                <a href="extra-gallery.html">Permission</a>
            </li>
        </ol>
    </div>
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
    <div class="panel-heading">

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
        <div class="action_panel">
            <a href="javascript:void(0)" class="btn btn-primary btn-icon icon-left"  onclick="jQuery('#add_perm_modal').modal('show', {backdrop: 'fade'});"><i class="fa fa-plus-circle"></i> Add New Permission</a>
        </div>
        <?php $this->load->view($alert_msg); ?>
    </div>
    <div class="panel-body">
        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Permission Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($perm_list as $perm): ?>
                <tr>
                    <td><?php echo $perm->name; ?></td>
                    <td><?php echo $perm->definition; ?></td>
                    <td><a href="javascript:;" onclick="jQuery('#edit_perm_modal_<?php echo $perm->id; ?>').modal('show');" class="btn btn-secondary btn-sm btn-icon icon-left">Edit</a>
                        <a href="<?php echo base_url().'auth/delete_perm/'.$perm->id; ?>" class="btn btn-danger btn-sm btn-icon icon-left" title="Delete" onclick="return perm_delete()">Delete</a></td>
                </tr>

                <div class="modal fade" id="edit_perm_modal_<?php echo $perm->id; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Update Permission</h4>
                            </div>

                            <form action="<?php echo base_url('auth/update_perm'); ?>" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="perm_id" id="perm_id" value="<?php if(isset($perm->id)) { echo $perm->id; } ?>">
                                    <div class="form-group">
                                        <label for="">Permission Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Ex: add_post" value="<?php if(isset($perm->name)){ echo $perm->name; } ?>" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="definition" id="definition" class="form-control" cols="" rows="3"><?php if(isset($perm->definition)){ echo $perm->definition; } ?></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-info" name="submit" id="submit" value="Update Permisssion">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="add_perm_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add New Permission</h4>
                </div>

                <form action="<?php echo base_url('auth/save_perm'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Permission Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ex: add_post" required="true">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="definition" id="definition" class="form-control" cols="" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-info" name="submit" id="submit" value="Save Permisssion">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function($) {
        $("#example-1").dataTable({
            aLengthMenu: [
                [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
            ]
        });
    });

    function perm_delete() {
        var check = confirm('Are You Sure To Delete Permission!!!');
        if (check) {
            return true;
        }
        else {
            return false;
        }
    }
</script>