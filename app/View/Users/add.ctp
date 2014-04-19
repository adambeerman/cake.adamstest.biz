<?php echo  $this->Html->script('j_users_add'); ?>
<div class="users form">

<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('New User'); ?></legend>
	<?php
        debug($companies);
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email');

        //echo $this->Form->input('Company');

        // Maybe we need to make a hidden form entry for company, based on the e-mail address supplied?
        // Either way, will need to send a confirmation e-mail to the address
		echo $this->Form->input('username');
		echo $this->Form->input('password');


        // The next few need to come up only after we know which company the user belongs to.
        echo $this->Form->input('Company');
        echo $this->Form->input('Refinery');

        ///echo $this->Form->input('businessUnits');
        //echo $this->Form->input('Plant');
        //echo $this->Form->input('Refinery');
		//echo $this->Form->input('role');
	?>
	</fieldset>
    <div id = 'company_logo'></div>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
