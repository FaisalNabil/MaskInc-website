<?php if($this->session->flashdata('success')): ?>
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		
		<?php echo $this->session->flashdata('success'); ?>
	</div>
<?php elseif($this->session->flashdata('error')): ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		
		<?php echo $this->session->flashdata('error'); ?>
	</div>
<?php endif; ?>