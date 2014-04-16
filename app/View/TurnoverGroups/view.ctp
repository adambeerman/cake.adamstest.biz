<pre>
    Current: <?php print_r($currentTime); ?>
    Start times: <?php print_r($startTimes); ?>
</pre>


<?php

// Use FALSE so that this loads in the head rather than the body
echo $this->Html->script('jquery', FALSE);
echo $this->Html->script('j_turnovers_add', FALSE);

?>

<h2>
    <?php echo $this->Html->link($turnoverGroup['TurnoverGroup']['name'], array(
        'controller' => 'turnover_groups', 'action' => 'view', $turnoverGroup['TurnoverGroup']['id'])
    );?>
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

<div class = "turnover_container">
    <?php foreach($turnovers as $turnover): ?>

        <?php // Call the turnover element, and pass in the turnover data ?>
        <?php echo $this->element('turnover', array('turnover' => $turnover) ); ?>


    <?php endforeach; ?>

    <div id = "turnover_placeholder">

    </div>

    <div id="updating" style="display: none;">
        Adding Turnover...
    </div>



    <div class="add_turnover turnover">
        [+] New Turnover
    </div>

    <div class="new_turnover turnover hidden">
        <?php echo $this->Form->create('Turnover',
            array(
                'default' => false,
                'type'=> 'post',
            ));
        ?>

        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('content', array('rows' => '3'));
        echo $this->Js->submit('Add Turnover', array(
            'url' => array('controller' => 'turnovers', 'action' => 'add', $turnoverGroup['TurnoverGroup']['id']),

            'before' => $this->Js->get('#updating')->effect('fadeIn'),
            'success' => $this->Js->get('#updating')->effect('fadeOut'),
            'update' => '#turnover_placeholder',
            //'div' => false,
            //'type' => 'json',
            //'async' => false,

        ));
        echo $this->Form->end();
        ?>
    </div>

</div>

