
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
			<?php echo $this->Html->link(__('Change My Password'), array(
			'admin' => false,
			'action' => 'changePassword',
			$current_user['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift'); ?></dt>
		<dd>
			<?php echo h($user['User']['shift']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Admin'); ?></dt>
		<dd>
			<?php if($user['User']['admin'] == 0)
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
			<?php echo h($user['Block']['name']); ?>
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
				<th><?php echo __('Block'); ?></th>
				<th><?php echo __('Classroom Name'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Problem'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Observation'); ?></th>
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
					<td><?php echo $user['Block']['name'];?></td>
					<td><?php echo $value['Classroom']['name'];?></td>
					<td><?php echo $value['Checklist']['created']; ?></td>
					<td><?php echo $value['Checklist']['problem']; ?></td>
					<td><?php echo $value['Checklist']['status']; ?></td>
					<td><?php echo $value['Checklist']['observation']; ?></td>
				</tr>
			<?php } ?>
		</table>
	<?php }
	else
	{
		echo __('There isn\'t checklist related to this user.');
	} ?>
</div>