<?php
/**
 *
 *
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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
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

        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		echo $this->Html->css(array(/*'cake.generic',*/ 'bootstrap', 'main'));
        //echo $this->Html->css('main');



		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

        echo $this->Html->script('jquery');

        // This tells where to put any javascript generated
        echo $this->Js->writeBuffer();
	?>
</head>
<body>
	<div id="container">

        <div id="header">
            <?php echo $this->Html->link(APP_NAME, '/users/profile'); ?>
            <?php if($this->Session->read('Auth.User')): ?>
                <ul>
                    <li>
                        <?php echo $this->Html->link('Logout','/users/logout'); ?>
                    </li>
                    <li>
                        <span class = "faded"><?php echo AuthComponent::user('id'); ?></span>
                    </li>
                </ul>
            <?php else: ?>
                <ul>
                    <li>
                        <?php echo $this->Html->link('Sign Up','/users/add'); ?>
                    </li>
                    <li>
                        <?php echo $this->Html->link('Sign In', '/users/login'); ?>
                    </li>
                </ul>
            <?php endif ?>
        </div>

		<div id="content">

			<?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
    <?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
