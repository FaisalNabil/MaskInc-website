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
            <h1 class="title">Add New User</h1>
            <p class="description">New User</p>
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
                    <strong>Add User</strong>
                </li>
            </ol>

        </div>

    </div>

    <div>

    </div>
<?php $this->load->view($alert_msg); ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php $this->load->view($alert_msg); ?>
                </div>

                <div class="panel-body">
                    <form method="post" action="<?= site_url('user_add_post') ?>" class="validate" onsubmit="return check_data()">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">User ID<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" onkeyup="check_user_id()" name="user_id" id="user_id" data-validate="required" placeholder="Enter ID" />
                                            <span id="id_error" class="validate-has-error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">User Name<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="user_name" id="user_name" data-validate="required" placeholder="Enter Name" />
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
                                                        <input type="radio" name="gender" class="cbr cbr-primary" checked value="1">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>
                                                        <input type="radio" name="gender" class="cbr cbr-secondary" value="0">
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
                                            <input type="text" class="form-control" name="email" id="email" data-validate="required,email" placeholder="Enter Email Address" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="phone_number" id="phone_number" data-validate="required,number,minlength[7],maxlength[14]" placeholder="Enter Phone Number" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Designation<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="designation" id="designation" data-validate="required" placeholder="Enter Designation" />
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
                                            <select class="form-control" id="group_id" name="group_id" data-validate="required">
                                                <option></option>
                                                <?php if($groups): ?>
                                                <?php foreach ($groups as $row): ?>
                                                <option value="<?= $row->id ?>"><?= $row->name ?></option>
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
                                            <textarea class="form-control autogrow" cols="5" id="address" name="address" data-validate="required" placeholder="Enter Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    function check_user_id(){
        var user_id = $('#user_id').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('check_user_id') ?>',
            data: {
                user_id: user_id
            }, success: function (data) {
                //console.log(res);
                //alert(data);
                if (data == 1) {
                    var x = document.getElementById('id_error');
                    x.style.color = "red";
                    x.style.display = "block";
                    x.style.paddingTop = "5px";
                    x.style.fontSize = "12px";
                    x.innerHTML = "ID Already Exists!<br>";
                    $('#submit_button').prop('disabled', true);
                }else{
                    var x = document.getElementById('id_error');
                    x.style.color = "";
                    x.style.display = "";
                    x.style.paddingTop = "";
                    x.style.fontSize = "";
                    x.innerHTML = "";
                    $('#submit_button').prop('disabled', false);
                }
            }
        });
    }
    function check_data(){
        var id = $('#user_id').val();
        var name = $('#user_name').val();
        var gender = document.querySelector('input[name=gender]:checked').value;
        var email = $('#email').val();
        var phone_number = $('#phone_number').val();
        var designation = $('#designation').val();
        var address = $('#address').val();
        var group_id = $('#group_id').val();
        if(id.trim() == "" || name.trim() == "" || email.trim() == "" || phone_number.trim() == "" || designation.trim() == "" || address.trim() == "" || gender == "" || group_id == ""){
            $('#error_modal').modal('show');
            return false;
        }else{
            return true;
        }
    }
</script>
