<div class="classrooms form">
<h2><?php echo __('Edit Classroom'); ?></h2>
<?php echo $this->Form->create('Classroom'); ?>
<?php
	echo $this->Form->input('id');
	echo $this->Form->input('name', array('label' => __('Classroom Name')));
	echo $this->Form->input('block_id');
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>