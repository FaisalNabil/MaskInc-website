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
            <li class="">
                <a href="extra-gallery.html">Menu</a>
            </li>
            <li class="active">
                <a href="extra-gallery.html">Edit Menu</a>
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
        <h3>Edit Menu</h3>
        <?php $this->load->view($alert_msg); ?>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url('auth/update_menu/'); ?>" method="POST">
            <input type="hidden" name="menu_id" id="menu_id" value="<?php echo $menu_data->ser_id; ?>">
            <div class="form-group">
                <label for="">Menu Label</label>
                <input type="text" name="menu_label" id="menu_label" class="form-control" placeholder="Ex: Add Member" value="<?php if(isset($menu_data->menu_label)) { echo $menu_data->menu_label; } ?>" required="true">
            </div>
            <div class="form-group">
                <label for="">Menu Url</label>
                <input type="text" name="menu_url" id="menu_url" class="form-control" value="<?php if(isset($menu_data->menu_url)) { echo $menu_data->menu_url; } ?>" placeholder="Ex: controller/function">
            </div>
            <div class="form-group">
                <label for="">Parent Menu</label>
                <select name="parent_menu" id="parent_menu" class="form-control">
                   <option value="-1">Select Parent Menu</option>
                    <?php foreach($menu_list as $menu): ?>
                        <option value="<?php echo $menu->ser_id; ?>" <?php if($menu->ser_id==$menu_data->parent_menu) { echo 'selected'; } ?> ><?php echo $menu->menu_label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Menu Icon</label>
                <input type="text" name="menu_icon" id="menu_icon" class="form-control" value="<?php if(isset($menu_data->menu_icon)) { echo $menu_data->menu_icon; } ?>" placeholder="Ex: fa-cog">
            </div>
            <div class="form-group">
                <label for="">Menu Order</label>
                <input type="number" name="menu_level" id="menu_level" class="form-control" value="<?php if(isset($menu_data->menu_level)) { echo $menu_data->menu_level; } ?>" placeholder="">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="" value="Update Menu" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">


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