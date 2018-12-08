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
            <h1 class="title">Add New Project</h1>
            <p class="description">New Project</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1">
                <li>
                    <a href="<?php echo base_url()?>home"><i class="fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="<?= site_url('admin/project/add_new_project') ?>"><i class="fa-user"></i>Project</a>
                </li>
                <li class="active">
                    <strong>Add New Project</strong>
                </li>
            </ol>

        </div>

    </div>

    <div>

    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php $this->load->view($alert_msg); ?>
                </div>

                <div class="panel-body">
                    <form method="post" action="<?= site_url('admin/project/upload_project') ?>" class="validate" onsubmit="return check_data()">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Project Title<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="project_title" id="project_title" data-validate="required" placeholder="Enter Project Title" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><b>Start Date</b><span style="color: red">*</span></label>
                                        <input type="text" name="start_date" class="form-control datepicker" data-validate="required" placeholder="Enter Project Start Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date</label>
                                        <div class="form-group">
                                            <input type="text" name="end_date" class="form-control datepicker" placeholder="Enter Project End Date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Gallery<span style="color: red">*</span></label>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <label>
                                                        <input type="radio" name="gallery" class="cbr cbr-primary" checked value="1">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="col-md-1">
                                                    <label>
                                                        <input type="radio" name="gallery" class="cbr cbr-secondary" value="0">
                                                        No
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
                                        <label class="control-label">Project Status<span style="color: red">*</span></label>
                                        <div class="form-group">

                                            <select class="form-control" id="status" name="status" data-validate="required">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="submit_button" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">

</script>
