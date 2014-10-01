<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$dev = __('Development');
$cakeDescription = __d(null, 'Checklist - ' . $dev);
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('estilo');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php 
		if (isset($logged_in) && ($logged_in == true))
		{
			echo '<header>';
			echo $this->Element('painel');
			echo $this->Element('menu');
			echo '</header>';
		} ?>
	<div id="container">
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<footer>
		<p>Desenvolvido por Everton Luis Esteves - Todos os Direitos Reservados</p>
		<p>NIAA - N&uacute;cleo de Inform&aacute;tica para Atividades Acad&ecirc;micas - PUCPR <br />Vers&atilde;o 2.0</p>
	</footer>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
