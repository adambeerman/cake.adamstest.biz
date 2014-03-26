<pre>
    Current: <?php print_r($currentTime); ?>
    Start times: <?php print_r($startTimes); ?>
</pre>

<h2>
    <?php echo $turnoverGroup['TurnoverGroup']['name'];?>
</h2>

<div id = "turnover_prev">
    <?php echo $this->Html->link('<< Previous', array('controller'=>'turnover_groups',
    'action' => 'view',$turnoverGroup['TurnoverGroup']['id'],$idx-1 )); ?>
</div>

<div id = "turnover_cur">
    <?php echo $shift; ?>
</div>

<div id = "turnover_next">
    <?php echo $this->Html->link('Next >>', array('controller'=>'turnover_groups',
        'action' => 'view',$turnoverGroup['TurnoverGroup']['id'],$idx+1 )); ?>
</div>

<br>

<?php foreach($turnovers as $turnover): ?>

    <div class = "turnover">
        <?php // I want the user to be able to edit the turnover if they created it ?>

        <h4><?php echo $turnover['Turnover']['name']; ?></h4>

        <?php if($turnover['Turnover']['user_id']==AuthComponent::user('id')) {
            //If user owns this turnover, give them a link to modify it
            echo $this->Html->link(
                $turnover['Turnover']['content'],
                array('controller' => 'turnovers','action'=>'edit', $turnover['Turnover']['id'])
            );
        }
        else {
            // Otherwise, just echo the content
            echo $turnover['Turnover']['content'];
        }

        ?>
    </div>

    <br>

<?php endforeach; ?>

<div class = "turnover">
    <?php echo $this->Html->link(__('New Turnover'), array('controller' => 'turnovers', 'action' => 'add')); ?>
</div>
