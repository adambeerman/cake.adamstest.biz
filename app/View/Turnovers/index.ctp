<div class="turnovers index">
	<h2><?php echo __('Turnovers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('turnover_group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($turnovers as $turnover): ?>
	<tr>
		<td><?php echo h($turnover['Turnover']['id']); ?>&nbsp;</td>
		<td><?php echo h($turnover['Turnover']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($turnover['TurnoverGroup']['name'], array('controller' => 'turnover_groups', 'action' => 'view', $turnover['TurnoverGroup']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($turnover['User']['username'], array('controller' => 'users', 'action' => 'view', $turnover['User']['id'])); ?>
		</td>
		<td><?php echo h($turnover['Turnover']['created']); ?>&nbsp;</td>
		<td><?php echo h($turnover['Turnover']['modified']); ?>&nbsp;</td>
		<td><?php echo h($turnover['Turnover']['content']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $turnover['Turnover']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $turnover['Turnover']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $turnover['Turnover']['id']), null, __('Are you sure you want to delete # %s?', $turnover['Turnover']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Turnover'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
