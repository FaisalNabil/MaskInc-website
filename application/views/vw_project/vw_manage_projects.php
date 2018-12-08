<div class="page-title">
    <div class="title-env">
        <h1 class="title">Project List</h1>
        <p class="description">Project Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="<?php echo base_url()?>home"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="<?= site_url('admin/project/manage_project') ?>"><i class="fa-user"></i>Project</a>
            </li>
            <li class="active">
                <strong>Manage Projects</strong>
            </li>
        </ol>
    </div>
</div>

<!-- Basic Setup -->
<div class="panel panel-default">
    <div class="panel-heading">
        <?php $this->load->view($alert_msg); ?>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="project_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Designation</th>
                        <th>User Type</th>
                        <th>Address</th>
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

<script type="text/javascript">
    $(document).ready(function ($) {
        $("#project_list").dataTable({});
    });
</script>