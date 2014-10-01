<?php
/**
*
* PHP 5
*
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link http://cakephp.org CakePHP(tm) Project
* @package Cake.View.Errors
* @since CakePHP(tm) v 0.10.0.1076
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/
?>
<h3><?php echo __('Fatal Error.'); ?></h3>
<?php
$server = $_SERVER['SERVER_NAME'];
$address = $_SERVER ['REQUEST_URI'];
$url = $server . $address;
$mailto = 'mailto:everton.e@pucpr.br';
$subject = __('Fatal error in the checklist system.');
$body = __('Error accessing the link:') . $url;
echo $this->Html->link(__('Click here to notify the administrator about this problem.'),
$mailto.'?subject='.$subject.'&body='.$body);
?>