<div class="checklists form">
<h2><?php echo __('Edit Checklist'); ?></h2>
<?php echo $this->Form->create('Checklist'); ?>
<?php
	echo $this->Form->input('id');
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
	echo $this->Form->input('observation');
	echo $this->Form->input('user_id', array('type' => 'hidden'));
	echo $this->Form->input('classroom_id', array('type' => 'hidden'));
?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>