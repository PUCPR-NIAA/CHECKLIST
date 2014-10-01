<div class="classrooms index">
	<h2><?php echo __('Classrooms'); ?></h2>
	<?php if (!empty($classroom)): ?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('block_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($classrooms as $classroom): ?>
	<tr>
		<td><?php echo h($classroom['Classroom']['id']); ?>&nbsp;</td>
		<td><?php echo h($classroom['Classroom']['name']); ?>&nbsp;</td>
		<td id="link">
			<?php echo $this->Html->link($classroom['Block']['name'], array('controller' => 'blocks', 'action' => 'view', $classroom['Block']['id'])); ?>
		</td>
		<td><?php echo h($classroom['Classroom']['created']); ?>&nbsp;</td>
		<td><?php echo h($classroom['Classroom']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $classroom['Classroom']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $classroom['Classroom']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $classroom['Classroom']['id']), array(), __('Are you sure you want to delete # %s?', $classroom['Classroom']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	<?php else : echo __('There isn\'t checklist related.'); endif; ?>
	</div>
</div>