<div class="blocks view">
<h2><?php echo $block['Block']['name']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($block['Block']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block Name'); ?></dt>
		<dd>
			<?php echo h($block['Block']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($block['Block']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($block['Block']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h2><?php echo __('Related Classrooms'); ?></h2>
	<?php if (!empty($block['Classroom'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Classroom Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($block['Classroom'] as $classroom): ?>
		<tr>
			<td><?php echo $classroom['name']; ?></td>
			<td><?php echo $classroom['created']; ?></td>
			<td><?php echo $classroom['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'classrooms', 'action' => 'view', $classroom['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'classrooms', 'action' => 'edit', $classroom['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'classrooms', 'action' => 'delete', $classroom['id']), array(), __('Are you sure you want to delete # %s?', $classroom['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else : echo 'Não existe salas de aulas relacionadas'; endif; ?>
</div>
<div class="related">
	<h2><?php echo __('Related Users'); ?></h2>
	<?php if (!empty($block['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Full Name'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Shift'); ?></th>
		<th><?php echo __('Admin'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($block['User'] as $user): ?>
		<tr>
			<td><?php echo $user['name']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['shift']; ?></td>
			<td><?php 
			if ($user['admin'] == 0)
			{
				echo __('No');
			}
			else
			{
				echo __('Yes');
			} ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), array(), __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php else : echo __('There isn\'t related users.'); endif; ?>
</div>
