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
			<a href="extra-gallery.html">Menu</a>
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
			<a href="javascript:void(0)" class="btn btn-primary btn-icon icon-left"  onclick="jQuery('#add_group_modal').modal('show', {backdrop: 'fade'});"><i class="fa fa-plus-circle"></i> Add New Menu</a>
		</div>
		<?php $this->load->view($alert_msg); ?>
	</div>
	<div class="panel-body">		
		<table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Menu Label</th>
					<th>Menu Url</th>
					<th>Parent Menu</th>
					<th>Action</th>
				</tr>
			</thead>		
			<tbody>
				<?php foreach($menu_list as $menu): ?>
				<tr>
					<td><?php echo $menu->menu_label; ?></td>
					<td><?php echo $menu->menu_url; ?></td>
					<td><?php echo $menu->parent_menu_label; ?></td>
					<td><a href="<?php echo base_url('admin/auth/edit_menu/'.$menu->ser_id); ?>" class="btn btn-secondary btn-sm btn-icon icon-left">Edit</a>
					<a href="<?php echo base_url().'admin/auth/delete_menu/'.$menu->ser_id; ?>" class="btn btn-danger btn-sm btn-icon icon-left" title="Delete" onclick="return menu_delete()">Delete</a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="add_group_modal">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add New Menu</h4>
				</div>
				
				<form action="<?php echo base_url('admin/auth/save_menu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Menu Label</label>
						<input type="text" name="menu_label" id="menu_label" class="form-control" placeholder="Ex: Add Member" required="true">
					</div>
					<div class="form-group">
						<label for="">Menu Url</label>
						<input type="text" name="menu_url" id="menu_url" class="form-control" placeholder="Ex: controller/function">
					</div>
					<div class="form-group">
						<label for="">Parent Menu</label>
						<select name="parent_menu" id="parent_menu" class="form-control">
							<option value="-1">Select Parent Menu</option>
							<?php foreach($menu_list as $menu): ?>
								<option value="<?php echo $menu->ser_id; ?>"><?php echo $menu->menu_label; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Menu Icon</label>
						<input type="text" name="menu_icon" id="menu_icon" class="form-control" placeholder="Ex: fa-cog">
					</div>
					<div class="form-group">
						<label for="">Menu Order</label>
						<input type="number" name="menu_level" id="menu_level" class="form-control" placeholder="">
					</div>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-info" name="submit" id="submit" value="Save Menu">
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

function menu_delete() {
	var check = confirm('Are You Sure To Delete Menu!!!');
    if (check) {
        return true;
    }
    else {
        return false;
    }
}
</script>