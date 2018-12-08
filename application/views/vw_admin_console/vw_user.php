<div class="page-title">
    <div class="title-env">
        <h1 class="title">User List</h1>
        <p class="description">User Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1" >
            <li>
                <a href="dashboard-1.html"><i class="fa-cog"></i>Admin Console</a>
            </li>
            <li class="active">
                <a href="extra-gallery.html">User</a>
            </li>
        </ol>
    </div>
</div>
<?php $this->load->view($alert_msg); ?>
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

        <div class="action_buttons">
            <a href="<?php echo base_url('auth/add_user'); ?>" class="btn btn-primary">Add New User</a>
        </div>
    </div>
    <div class="panel-body">
        <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>User Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($user_list as $user): ?>
                <tr>
                    <td><?php echo $user->username; ?></td>
                    <td><?php if($user->banned == 1) { echo '<span class="label label-success">Active</span>'; } else { echo '<span class="label label-danger">Banned</span>';; } ?></td>
                    <td>
                        <a href="<?php echo base_url().'auth/edit_user/'.$user->id; ?>" class="btn btn-secondary btn-sm btn-icon icon-left">Edit</a>
                        <a href="<?php echo base_url().'auth/delete_user/'.$user->id; ?>" class="btn btn-danger btn-sm btn-icon icon-left" title="Delete" onclick="return group_delete()">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
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

    function group_delete() {
        var check = confirm('Are You Sure To Delete Group!!!');
        if (check) {
            return true;
        }
        else {
            return false;
        }
    }
</script>