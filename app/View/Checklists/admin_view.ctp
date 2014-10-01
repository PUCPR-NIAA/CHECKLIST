<div class="checklists view">
<h2><?php echo __('Checklist'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Problem'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['problem']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observation'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['observation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo $this->Html->link($checklist['User']['name'], array(
			'admin' => true,
			'controller' => 'users',
			'action' => 'view',
			$checklist['Checklist']['user_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Classroom'); ?></dt>
		<dd>
			<?php echo $this->Html->link($checklist['Classroom']['name'], array(
			'admin' => true,
			'controller' => 'classrooms',
			'action' => 'view',
			$checklist['Checklist']['classroom_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($block['name'], array(
			'admin' => true,
			'controller' => 'blocks',
			'action' => 'view',
			$block['id']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($checklist['Checklist']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
