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
            <h3>Add New User</h3>
        </div>
    </div>
    <div class="panel-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Ex: abc" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ex: example@example.com">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="******" required>
            </div>
            <div class="form-group">
                <input type="submit" name="add_user" id="add_user" class="btn btn-primary" value="Save User">
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function($) {

    });
</script>