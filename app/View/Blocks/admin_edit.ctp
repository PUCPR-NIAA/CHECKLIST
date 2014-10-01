<div class="blocks form">
<h2><?php echo __('Admin Edit Block'); ?></h2>
<?php echo $this->Form->create('Block'); ?>
<?php echo $this->Form->input('id'); ?>
<?php echo $this->Form->input('name'); ?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
