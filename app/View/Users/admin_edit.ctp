<div class="users form">
<h2><?php echo __('Admin Edit User'); ?></h2>
<?php echo $this->Form->create('User'); ?>
<?php
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('label' => 'Full Name'));
	echo $this->Form->input('username');
	echo $this->Form->input('shift');
	echo $this->Form->input('admin');
	echo $this->Form->input('block_id');
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
