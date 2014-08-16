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

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>planetarium</title>
	<?php
		// css
		echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.css', null, array('media' => 'all'));
		echo $this->Html->css('plametarium', null, array('media' => 'all'));
		//meta
		echo $this->Html->meta('viewport', 'width=device-width');
		// js
		echo $this->Html->script('//code.jquery.com/jquery-2.1.1.min.js');
	
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
