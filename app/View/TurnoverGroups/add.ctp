<div class="turnoverGroups form">
    <?php echo $this->Form->create('TurnoverGroup'); ?>
    <fieldset>
        <legend><?php echo __('Add Turnover Group'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('business_unit_id');
        echo $this->Form->input('refinery_id');
        echo $this->Form->input('shift_cycle_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Turnovers'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Turnover Groups'), array('controller' => 'turnover_groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Turnover Group'), array('controller' => 'turnover_groups', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
    </ul>
</div>
