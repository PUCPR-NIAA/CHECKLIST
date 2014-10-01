<nav>
	<ul class="menu">
		<li><?php echo __('Checklists');?>
			<ul>
				<li><?php echo $this->Html->link(__('List Checklists'), array(
				'admin' => false,
				'controller' => 'checklists',
				'action' => 'index'));
				?>
				</li>
				<li><?php echo $this->Html->link(__('My Checklists'), array(
				'admin' => false,
				'controller' => 'checklists',
				'action' => 'myindex'));
				?>
				</li>
				<li><?php echo $this->Html->link(__('Report Checklists'), array(
				'admin' => false,
				'controller' => 'checklists',
				'action' => 'report'));
				?>
				</li>
			</ul>
		</li>
		<?php 
		if ($current_user['admin'] == true)
		{ ?>
		<li><?php echo __('Users');?>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Add Users'), array(
					'admin' => true,
					'controller' => 'users',
					'action' => 'add'));
					?>
				</li>
				<li>
					<?php echo $this->Html->link(__('List Users'), array(
					'admin' => true,
					'controller' => 'users',
					'action' => 'index'));
					?>
				</li>
			</ul>
		</li>
		<li><?php echo __('Block');?>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Add Block'), array(
					'admin' => true,
					'controller' => 'blocks',
					'action' => 'add'));
					?>
				</li>
				<li>
					<?php echo $this->Html->link(__('List Block'), array(
					'admin' => true,
					'controller' => 'blocks',
					'action' => 'index'));
					?>
				</li>
			</ul>
		</li>
		<li><?php echo __('Classrooms');?>
			<ul>
				<li>
					<?php echo $this->Html->link(__('Add Classrooms'), array(
					'admin' => true,
					'controller' => 'classrooms',
					'action' => 'add'));
					?>
				</li>
				<li>
					<?php echo $this->Html->link(__('List Classrooms'), array(
					'admin' => true,
					'controller' => 'classrooms',
					'action' => 'index'));
					?>
				</li>
			</ul>
		</li>
		<?php
		}
		else
		{?>
		<li><?php echo __('Block');?>
			<ul>
				<li>
					<?php echo $this->Html->link(__('List Block'), array(
					'admin' => false,
					'controller' => 'blocks',
					'action' => 'index'));
					?>
				</li>
			</ul>
		</li>
		<?php } ?>
	</ul>
</nav>