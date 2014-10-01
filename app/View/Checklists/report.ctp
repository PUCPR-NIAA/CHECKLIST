<div class="checklists report">
	<?php $user = $current_user['id'];?>
	<h2><?php echo __('Report Checklists'); ?></h2>
	<?php
	if (!empty($classrooms))
	{
		echo $this->Form->create('Checklist'); ?>
		<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><?php echo __('Classroom'); ?></th>
				<th><?php echo __('Problem'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Observation'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i = 1;
		$j = 0;		
		foreach ($classrooms as $classroom => $key)
		{?>
			<tr>
				<?php echo $this->Form->input('Classroom.' . $j . '.user_id', array(
					'type' => 'hidden', 
					'value' => $user));
				echo $this->Form->input('Classroom.' . $j . '.classroom_id', array(
					'type' => 'hidden',
					'value' => $classroom));
				?>
				<td><?php echo $key;?></td>
				<td>
					<?php 
					echo $this->Form->input('Classroom.' . $j . '.problem', array(
						'label' => '',
						'tabindex' => $i,
						'options' => array(
							'empty' => __('Select an option'),
							'CPU, Mouse e Teclado' => 'CPU, Mouse e Teclado',
							'Monitor' => 'Monitor',
							'Som' => 'Som',
							'Projetor' => 'Projetor',
							'Cabos' => 'Cabos',
							'Adaptadores' => 'Adaptadores',
							'Outros' => 'Outros')));
					$i++;
					?>
				</td>
				<td>
					<?php
					echo $this->Form->input('Classroom.' . $j . '.status', array(
						'label' => '',
						'tabindex' => $i,
						'options' => array(
							'empty' => __('Select an option'),
							'OK' => 'OK',
							'PENDENTE' => 'PENDENTE',
							'NÃO VISTO' => 'NÃO VISTO')));
					$i++;
					?>
				</td>
				<td>
					<?php 
					echo $this->Form->input('Classroom.' . $j . '.observation', array(
						'type' => 'textarea', 
						'label' => '',
						'rows' => 1,
						'cols' => 30,
						'tabindex' => $i,
						'maxlength' => 200));
					$i++;
					?>
				</td>
			</tr>
			<?php
			$j++;
		}?>
		</tbody>
		</table>
		<?php 
		echo $this->Form->end(__('Report'), array('tabindex' => $i)); 
	}
	else { echo __('No classrooms to report.'); }
	?>
</div>