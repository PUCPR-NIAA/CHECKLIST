<?php
if (isset($logged_in) && ($logged_in == true))
{
	$name = $current_user['name'];
	$id = $current_user['id'];
	$space = "&nbsp;";
	$tam = 120;
	echo __('Welcome ') . $this->Html->link($name, array(
		'admin' => false,
		'controller' => 'users', 
		'action' => 'view', $id));
	echo '! - ';
	echo $this->Html->link(__('Log out'), array(
		'admin' => false,
		'controller' => 'users',
		'action' => 'logout'));
}
?>