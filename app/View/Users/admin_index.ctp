<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name', 'Full Name'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('shift'); ?></th>
			<th><?php echo $this->Paginator->sort('admin'); ?></th>
			<th><?php echo $this->Paginator->sort('block_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['shift']); ?>&nbsp;</td>
		<td><?php 
			if($user['User']['admin'] == 1)
			{
				echo __('Yes');
			}
			else
			{
				echo __('No');
			}
		?>&nbsp;</td>
		<td id="link">
			<?php echo $this->Html->link($user['Block']['name'], array(
				'controller' => 'blocks',
				'action' => 'view',
				$user['Block']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view',
				$user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit',
				'admin' => true,
				$user['User']['id'])); ?>
			<!-- Rever erro de alteração de senha-->
			<?php echo $this->Html->link(__('Change Password'), array(
				'action' => 'changePassword',
				'admin' => true,
				$user['User']['id']));?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete the user %s?', $user['User']['username'])); ?>
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
	</div>
</div>
