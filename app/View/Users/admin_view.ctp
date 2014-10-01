<div class="users view">
<h2><?php echo __('User') . ' ' . $user['User']['username']; ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php  echo $this->Html->link(__('Change Password'), array(
			'action' => 'changePassword',
			'admin' => 'true',
			$user['User']['id']));?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($user['User']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin'); ?></dt>
		<dd>
			<?php 
			if($user['User']['admin'] == 0)
			{
				echo __('No');
			}
			else
			{
				echo __('Yes');
			} ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Block'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Block']['name'], array(
				'controller' => 'blocks', 
				'action' => 'view', 
				'admin' => true,
				$user['Block']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h2><?php echo __('Related Checklists'); ?></h2>
	<?php 
	if (!empty($related[0]['Checklist']))
	{ ?>
		<table cellpadding = "0" cellspacing = "0">
			<tr>
				<th><?php echo __('Classroom Name'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Problem'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Observation'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
			<?php
			foreach ($related as $key => $value) 
			{
				//Tag TR
				if (($value['Checklist']['status'] == 'PENDENTE') || 
					($value['Checklist']['status'] == 'NÃO VISTO'))
				{
					echo '<tr class="PNV">';
				}
				else
				{
					echo '<tr>';
				}?>
					<td id="link">
						<?php echo $this->Html->link($value['Classroom']['name'], array(
						'controller' => 'classrooms',
						'action' => 'view',
						'admin' => true,
						$value['Classroom']['id'])); ?>
					</td>
					<td><?php echo $value['Checklist']['created']; ?></td>
					<td><?php echo $value['Checklist']['problem']; ?></td>
					<td><?php echo $value['Checklist']['status']; ?></td>
					<td><?php echo $value['Checklist']['observation']; ?></td>
					<td class="actions">
						<?php echo $this->Html->link(__('View'), array(
							'controller' => 'checklists', 
							'action' => 'view', 
							'admin' => true,
							$value['Checklist']['id'])); ?>
						<?php echo $this->Html->link(__('Edit'), array(
							'controller' => 'checklists', 
							'action' => 'edit', 
							'admin' => true,
							$value['Checklist']['id'])); ?>
						<?php echo $this->Form->postLink(__('Delete'), array(
							'controller' => 'checklists', 
							'action' => 'delete', 
							'admin' => true,
							$value['Checklist']['id']), array(), __('Are you sure you want to delete # %s?', $value['Checklist']['id'])); ?>
					</td>
				</tr>
			<?php } ?>
		</table>
	<?php }
	else
	{
		echo __('There isn\'t checklist related to this user.');
	} ?>
</div>
