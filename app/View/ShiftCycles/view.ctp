<div class="shiftCycles view">
<h2><?php echo __('Shift Cycle'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num Shifts'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['num_shifts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Start 1'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['shift_start_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Start 2'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['shift_start_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Start 3'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['shift_start_3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shift Start 4'); ?></dt>
		<dd>
			<?php echo h($shiftCycle['ShiftCycle']['shift_start_4']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shift Cycle'), array('action' => 'edit', $shiftCycle['ShiftCycle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shift Cycle'), array('action' => 'delete', $shiftCycle['ShiftCycle']['id']), null, __('Are you sure you want to delete # %s?', $shiftCycle['ShiftCycle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shift Cycles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shift Cycle'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Turnover Groups'); ?></h3>
	<?php if (!empty($shiftCycle['TurnoverGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Business Unit Id'); ?></th>
		<th><?php echo __('Refinery Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Shift Cycle Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($shiftCycle['TurnoverGroup'] as $turnoverGroup): ?>
		<tr>
			<td><?php echo $turnoverGroup['id']; ?></td>
			<td><?php echo $turnoverGroup['business_unit_id']; ?></td>
			<td><?php echo $turnoverGroup['refinery_id']; ?></td>
			<td><?php echo $turnoverGroup['name']; ?></td>
			<td><?php echo $turnoverGroup['shift_cycle_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'turnover_groups', 'action' => 'view', $turnoverGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'turnover_groups', 'action' => 'edit', $turnoverGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'turnover_groups', 'action' => 'delete', $turnoverGroup['id']), null, __('Are you sure you want to delete # %s?', $turnoverGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
