<?php
/**
 * Created by PhpStorm.
 * User: Sudipta
 * Date: 10/1/2017
 * Time: 2:15 AM
 */
/*echo '<pre>';
print_r($_SESSION);
exit();*/
?>

    <!-- User Info, Notifications and Menu Bar -->
    <div class="page-title">

        <div class="title-env">
            <h1 class="title">Edit User</h1>
            <p class="description">Edit Users Info</p>
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
                    <strong>Edit User</strong>
                </li>
            </ol>

        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php $this->load->view($alert_msg); ?>
                </div>

                <div class="panel-body">
                    <form method="post" action="<?= site_url('user_edit_post') ?>" class="validate" onsubmit="return check_data()">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">User Name<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_name" id="user_name" data-validate="required" placeholder="Enter Name"
                                            value="<?= $user_info->user_name ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Gender<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="gender" class="cbr cbr-primary" <?php if($user_info->gender == 1){echo 'checked';} ?> value="1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="gender" class="cbr cbr-secondary" <?php if($user_info->gender == 0){echo 'checked';} ?> value="0">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Email<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="email" id="email" data-validate="required,email" placeholder="Enter Email Address"
                                            value="<?= $user_info->email ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="phone_number" id="phone_number" data-validate="required,number,minlength[7],maxlength[14]" placeholder="Enter Phone Number"
                                                   value="<?= $user_info->phone_number ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Designation<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="designation" id="designation" data-validate="required" placeholder="Enter Designation"
                                                   value="<?= $user_info->designation ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">User Group<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <script type="text/javascript">
                                                jQuery(document).ready(function($)
                                                {
                                                    $("#group_id").select2({
                                                        placeholder: 'Select User Group...',
                                                        allowClear: true
                                                    }).on('select2-open', function()
                                                    {
                                                        // Adding Custom Scrollbar
                                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                    });

                                                });
                                            </script>
                                            <select class="form-control" id="group_id" name="group_id">
                                                <option></option>
                                                <?php if($groups): ?>
                                                    <?php foreach ($groups as $row): ?>
                                                        <option value="<?= $row->id ?>" <?php if($row->id == $user_info->group_id){echo 'selected';} ?>><?= $row->name ?></option>
                                                    <?php endforeach;endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Address<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <textarea class="form-control autogrow" cols="5" id="address" name="address" data-validate="required" placeholder="Enter Address"><?php if($user_info->address){echo $user_info->address;}  ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="<?= $user_info->user_id ?>">
                        <div class="form-group">
                            <button type="submit" id="submit_button" class="btn btn-success">Save</button>
                        </div>
                        <div class="modal fade" id="error_modal" data-backdrop="static">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h4 class="modal-title" style="text-align: center">Error</h4>
                                    </div>

                                    <div class="modal-body" style="text-align: center">

                                        Please fill all the fields!

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function check_data(){
        var name = $('#user_name').val();
        var gender = document.querySelector('input[name=gender]:checked').value;
        var email = $('#email').val();
        var phone_number = $('#phone_number').val();
        var designation = $('#designation').val();
        var address = $('#address').val();
        var group_id = $('#group_id').val();
        if(name.trim() == "" || email.trim() == "" || phone_number.trim() == "" || designation.trim() == "" || address.trim() == "" || gender == "" || group_id == ""){
            $('#error_modal').modal('show');
            return false;
        }else{
            return true;
        }
    }
</script>
