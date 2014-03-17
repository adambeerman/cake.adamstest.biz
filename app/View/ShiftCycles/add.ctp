<div class="shiftCycles form">
<?php echo $this->Form->create('ShiftCycle'); ?>
	<fieldset>
		<legend><?php echo __('Add Shift Cycle'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('num_shifts');
		echo $this->Form->input('shift_start_1');
		echo $this->Form->input('shift_start_2');
		echo $this->Form->input('shift_start_3');
		echo $this->Form->input('shift_start_4');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Shift Cycles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
