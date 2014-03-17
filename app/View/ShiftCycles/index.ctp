<div class="shiftCycles index">
	<h2><?php echo __('Shift Cycles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('num_shifts'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_start_1'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_start_2'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_start_3'); ?></th>
			<th><?php echo $this->Paginator->sort('shift_start_4'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shiftCycles as $shiftCycle): ?>
	<tr>
		<td><?php echo h($shiftCycle['ShiftCycle']['id']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['name']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['num_shifts']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['shift_start_1']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['shift_start_2']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['shift_start_3']); ?>&nbsp;</td>
		<td><?php echo h($shiftCycle['ShiftCycle']['shift_start_4']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $shiftCycle['ShiftCycle']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $shiftCycle['ShiftCycle']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $shiftCycle['ShiftCycle']['id']), null, __('Are you sure you want to delete # %s?', $shiftCycle['ShiftCycle']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Shift Cycle'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
