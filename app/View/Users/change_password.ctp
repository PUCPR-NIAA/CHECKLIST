<div class="users form">
<h2><?php echo __('Change My Password'); ?></h2>
<?php echo $this->Form->create('User'); ?>
<?php
	echo $this->Form->input('password');
	echo $this->Form->input('password_confirmation',  array(
		'label' => __('Confirm password'),
		'type' => 'password'));
?>
<?php echo $this->Form->end(__('Change')); ?>
</div>