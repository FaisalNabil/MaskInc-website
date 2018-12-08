<div class="page-title">
    <div class="title-env">
        <h1 class="title">Users List</h1>
        <p class="description">User Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1">
            <li>
                <a href="<?php echo base_url()?>home"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="<?= site_url('manage_users') ?>"><i class="fa-user"></i>User</a>
            </li>
            <li class="active">
                <strong>Manage Users</strong>
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
            <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                    <tr>
                        <?php if ($users): ?>
                        <?php foreach ($users as $row): ?>
                        <td><?= $row->user_id ?></td>
                        <td><?= $row->user_name ?></td>
                        <td><?php if($row->gender == 1): ?>
                            <div class="label label-primary">Male</div>
                            <?php elseif ($row->gender == 0): ?>
                            <div class="label label-secondary">Female</div>
                            <?php else: ?>
                            <div class="label label-danger">Not Specified</div>
                            <?php endif; ?>
                        </td>
                        <td><?= $row->phone_number ?></td>
                        <td><?= $row->email ?></td>
                        <td><?php if ($row->designation) {
                                echo $row->designation;
                            } else {
                                echo 'N/A';
                            } ?>
                        </td>
                        <td><?= $row->name ?></td>
                        <td><?php if ($row->address) {
                                echo $row->address;
                            } else {
                                echo 'N/A';
                            } ?>
                        </td>
                        <td>
                            <?php if($row->status == 1){ ?>
                                <span class="label label-success">Active</span>
                            <?php }else{ ?>
                                <span class="label label-warning">Deactive</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($row->status == 1) { ?>
                                <a title="Block Project" href="javascript:void(0)" data-toggle="modal"
                                   data-target="#status_modal_<?= $row->user_id ?>"><span class="fa fa-2x fa-thumbs-o-down"></span></a>
                            <?php } else { ?>
                                <a title="Active Project" href="javascript:void(0)" data-toggle="modal"
                                   data-target="#status_modal_<?= $row->user_id ?>" ><span class="fa fa-2x fa-thumbs-o-up"></span></a>
                            <?php } ?>
                            <a href="<?= site_url('edit_user/').$row->user_id ?>" >
                                <i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a>

                            <!--<div class="btn-group">
                                <?php /*if($row->status == 1): */?>
                                    <button type="button" class="btn btn-blue dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                <?php /*else: */?>
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                <?php /*endif; */?>
                                <ul class="dropdown-menu dropdown-blue" role="menu">
                                    <li>
                                        <a href="<?/*= site_url('edit_user/').$row->user_id */?>">Edit</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#status_modal_<?/*= $row->user_id */?>">
                                            <?php /*if($row->status == 1):echo 'Deactivate?';elseif ($row->status == 0):echo 'Activate?';endif;*/?>
                                        </a>
                                    </li>
                                </ul>
                            </div>-->
                        </td>
                        <div class="modal fade" id="status_modal_<?= $row->user_id ?>" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?= site_url('user_status_post') ?>" method="post">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="text-align: center">Change Status
                                            for <?= $row->user_name ?></h4>
                                        </div>

                                        <div class="modal-body" style="text-align: center">
                                            <?php if ($row->status == 1): echo 'User will be deactivated. Are You sure?';
                                            elseif ($row->status == 0): echo 'User will be activated. Are you sure?';
                                            endif; ?>
                                        </div>
                                        <input type="hidden" id="user_id" name="user_id"
                                           value="<?= $row->user_id ?>">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php endforeach;
                endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ($) {
        $("#example-1").dataTable({
            aLengthMenu: [
                [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
            ]
        });
    });
</script>