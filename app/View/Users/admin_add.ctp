<div class="users form">
<h2><?php echo __('Admin Add User'); ?></h2>
<?php echo $this->Form->create('User');
	echo $this->Form->input('name', array('label' => __('Full Name')));
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('password_confirmation',  array(
		'label' => __('Confirm password'),
		'type' => 'password'));
	echo $this->Form->input('shift', array(
		'options' => array(
					'empty' => __('Select an option'),
					'Tarde' => __('Morning'),
					'Noite' => __('Night')
				)));
	echo $this->Form->input('admin');
	echo $this->Form->input('block_id');
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
