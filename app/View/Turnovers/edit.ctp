<div class="turnovers form">
<?php echo $this->Form->create('Turnover'); ?>
	<fieldset>
		<legend><?php echo __('Edit Turnover'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('turnover_group_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Turnover.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Turnover.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Turnovers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
