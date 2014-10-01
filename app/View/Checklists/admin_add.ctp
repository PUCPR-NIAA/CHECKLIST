<div class="checklists form">
<h2><?php echo __('Add Checklist'); ?><h2>
<?php $user = $current_user['id'];?>
<?php echo $this->Form->create('Checklist'); ?>
<?php
	echo $this->Form->input('problem', array(
		'options' => array(
			'empty' => __('Select an option'),
			'CPU, Mouse e Teclado' => 'CPU, Mouse e Teclado',
			'Monitor' => 'Monitor',
			'Som' => 'Som',
			'Projetor' => 'Projetor',
			'Cabos' => 'Cabos',
			'Adaptadores' => 'Adaptadores',
			'Outros' => 'Outros')));
	echo $this->Form->input('status', array(
		'options' => array(
			'empty' => __('Select an option'),
			'OK' => 'OK',
			'PENDENTE' => 'PENDENTE',
			'NÃO VISTO' => 'NÃO VISTO')));
	echo $this->Form->input('observation', array('type' => 'textarea'));
	echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $user));
	echo $this->Form->input('classroom_id');
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>