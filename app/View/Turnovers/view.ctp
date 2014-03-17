<div class="turnovers view">
<h2><?php echo __('Turnover'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($turnover['Turnover']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($turnover['Turnover']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Turnover Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($turnover['TurnoverGroup']['name'], array('controller' => 'turnover_groups', 'action' => 'view', $turnover['TurnoverGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($turnover['User']['username'], array('controller' => 'users', 'action' => 'view', $turnover['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($turnover['Turnover']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($turnover['Turnover']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($turnover['Turnover']['content']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Turnover'), array('action' => 'edit', $turnover['Turnover']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Turnover'), array('action' => 'delete', $turnover['Turnover']['id']), null, __('Are you sure you want to delete # %s?', $turnover['Turnover']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Turnovers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
