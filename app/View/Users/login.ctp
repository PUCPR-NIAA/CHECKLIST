<div class="TelaLogin">
<?php 
	
	echo $this->Html->image('niaa.png', array('alt' => 'Checklist'));
	echo '<p>' . __('Welcome to the System Checklist') . '</p>';
	?>
	<?php
	echo $this->Form->create('User', array(
							'url' => array(
									'controller' => 'users',
									'action' => 'login')
									)
							);
    echo '<div class="caixa">';
    echo $this->Form->input('username', array(
    	'tabindex' => 1, 'label' => __('Username:')));
    echo $this->Form->input('password', array(
    	'tabindex' => 2, 'label' => __('Password:')));
    echo '</div>';
    echo $this->Form->input('lastlogin',array(
    	'type' => 'hidden'));
	echo $this->Form->end('Enter', array(
		'type' => 'submit', 'tabindex' => 3));
?>
</div>