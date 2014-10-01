<div class="checklists index">
	<h2><?php echo __('Checklists'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo __('Username'); ?></th>
			<th><?php echo __('Shift'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Classroom'); ?></th>
			<th><?php echo __('Problem'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Observation'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($checklists as $checklist):
	if (($checklist['Checklist']['status'] == 'PENDENTE') || 
		($checklist['Checklist']['status'] == 'NÃO VISTO'))
	{
		echo '<tr class="PNV">';
	}
	else
	{
		echo '<tr>';
	}?>
		<td>
			<?php echo $checklist['User']['username']; ?>
		</td>
		<td>
			<?php echo $checklist['User']['shift']; ?>
		</td>
		<td><?php echo h($checklist['Checklist']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $checklist['Classroom']['name']; ?>
		</td>
		<td><?php echo h($checklist['Checklist']['problem']); ?>&nbsp;</td>
		<td><?php echo h($checklist['Checklist']['status']); ?>&nbsp;</td>
		<td><?php echo h($checklist['Checklist']['observation']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	</div>
</div>
