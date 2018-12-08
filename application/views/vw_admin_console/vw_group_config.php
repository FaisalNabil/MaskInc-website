<div class="page-title">
    <div class="title-env">
        <h1 class="title">Group User & permission</h1>
        <p class="description">Group User & permission Management</p>
    </div>

    <div class="breadcrumb-env">

        <ol class="breadcrumb bc-1" >
            <li>
                <a href="dashboard-1.html"><i class="fa-cog"></i>Admin Console</a>
            </li>
            <li class="">
                <a href="extra-gallery.html">Group</a>
            </li>
            <li class="active">
                <a href="extra-gallery.html">Config Group</a>
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
        <div class="action_panel">
            <h4>Group Info:</h4>
        </div>

    </div>
    <div class="panel-body">
        <div class="form-data">
            <form action="<?php echo base_url('auth/update_group/'.$group_id); ?>" method="POST">
                <div class="form-group">
                    <label for="">Group Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php if(isset($group_data->name)) { echo $group_data->name; } ?>" required="true">
                </div>
                <div class="form-group">
                    <label for="">Group Description</label>
                    <textarea name="definition" id="definition" cols="" rows="2" class="form-control"><?php if(isset($group_data->definition)) { echo $group_data->definition; } ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_form" id="save_group_form" value="Save Group Info" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

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
            <h4>Group Menu:</h4>
        </div>
    </div>
    <div class="panel-body">
        <div class="menu-data">
            <form role="form" class="form-horizontal" action="<?php echo base_url('auth/save_group_menu/'.$group_id); ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="tagsinput-1"></label>

                    <div class="col-sm-9">

                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#group_menu_list").multiSelect({
                                    afterInit: function()
                                    {
                                        // Add alternative scrollbar to list
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                    },
                                    dblClick: function()
                                    {
                                        // Update scrollbar size
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                    }
                                });
                            });
                        </script>
                        <select class="form-control" multiple="multiple" id="group_menu_list" name="group_menu_list[]">
                            <?php foreach($menu_list as $menu): ?>
                            <option value="<?php echo $menu->ser_id; ?>" <?php if($menu->selected==1) { echo 'selected'; } ?>><?php echo $menu->menu_label; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_menu" id="save_group_menu" value="Save Group Menu" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>



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
            <h4>Group Permission:</h4>
        </div>
    </div>
    <div class="panel-body">

        <div class="permission-data">
            <form role="form" class="form-horizontal" action="<?php echo base_url('auth/save_group_perms/'.$group_id); ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="tagsinput-1"></label>
                    <div class="col-sm-9">
                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#group_perm_list").multiSelect({
                                    afterInit: function()
                                    {
                                        // Add alternative scrollbar to list
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                    },
                                    dblClick: function()
                                    {
                                        // Update scrollbar size
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                    }
                                });
                            });
                        </script>
                        <select class="form-control" multiple="multiple" id="group_perm_list" name="group_perm_list[]">
                            <?php foreach($perm_list as $perm): ?>
                            <option value="<?php echo $perm->id; ?>" <?php if($perm->selected==1) { echo 'selected'; } ?>><?php echo $perm->name; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_perms" id="save_group_perms" value="Save Group Permissions" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>


<!--
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
            <h4>Group User:</h4>
        </div>
    </div>
    <div class="panel-body">
        <div class="user-data">
            <form role="form" class="form-horizontal" action="<?php echo base_url('auth/save_group_user/'.$group_id); ?>" method="POST">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="tagsinput-1"></label>

                    <div class="col-sm-9">

                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#group_user_list").multiSelect({
                                    afterInit: function()
                                    {
                                        // Add alternative scrollbar to list
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                    },
                                    dblClick: function()
                                    {
                                        // Update scrollbar size
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                    }
                                });
                            });
                        </script>
                        <select class="form-control" multiple="multiple" id="group_user_list" name="group_user_list[]">
                            <?php foreach($user_list as $user): ?>
                                <option value="<?php echo $user->id; ?>" <?php if($user->selected==1) { echo 'selected'; } ?>><?php echo $user->username; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_user" id="save_group_user" value="Save Group User" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>
-->

<script type="text/javascript">


</script>