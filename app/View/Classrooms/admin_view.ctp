<div class="classrooms view">
<h2><?php echo __('Classroom') . ' ' . $classroom[0]['Classroom']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($classroom[0]['Classroom']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($classroom[0]['Classroom']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($classroom[0]['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $classroom[0]['Block']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($classroom[0]['Classroom']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($classroom[0]['Classroom']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h2><?php echo __('Related Checklists'); ?></h2>
	<?php if (!empty($classroom[0]['Checklist'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Problem'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Observation'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($classroom as $key => $value) 
	{ 
		if (($value['Checklist']['status'] == 'PENDENTE') || 
			($value['Checklist']['status'] == 'NÃO VISTO'))
		{
			echo '<tr class="PNV">';
		}
		else
		{
			echo '<tr>';
		}?>
		<td><?php echo $value['Checklist']['problem']; ?></td>
		<td><?php echo $value['Checklist']['status']; ?></td>
		<td><?php echo $value['Checklist']['observation']; ?></td>
		<td id="link">
		<?php 
			echo $this->Html->link($value['User']['username'], array(
				'admin' => true,
				'controller' => 'users',
				'action' => 'view',
				$classroom[$key]['Checklist']['user_id'])); 
		?>
		</td>
		<td><?php echo $value['Checklist']['created']; ?></td>
		<td><?php echo $value['Checklist']['modified']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('controller' => 'checklists', 'action' => 'view', $value['Checklist']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('controller' => 'checklists', 'action' => 'edit', $value['Checklist']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'checklists', 'action' => 'delete', $value['Checklist']['id']), array(), __('Are you sure you want to delete # %s?', $value['Checklist']['id'])); ?>
		</td>
	</tr>
	<?php
	}?>
	</table>
	<?php else : echo __('There isn\'t checklist related.'); endif; ?>
</div>