<?php echo $this->Html->script('jquery', FALSE); ?>
<?php echo $this->Html->script('j_plants', FALSE); ?>

<h3>Business Units</h3>

<?php foreach($business_units as $business_unit): ?>

    <?php

    echo $this->Html->link($business_unit['BusinessUnit']['short_name'],
        array('controller' => 'business_units',
            'action' => 'profile',
            $business_unit['BusinessUnit']['id']));

    echo "<span class='faded'> | ";
    echo $this->Form->postLink(
        'Delete',
        array('controller' => 'business_units',
            'action' => 'delete',
            $business_unit['BusinessUnit']['id']),
        array('confirm'=> 'Are you sure?'));
    echo "</span>";
    ?>

    <br />
<?php endforeach; ?>

<div id = "new_business_unit_placeholder"></div>
<div id = "updating" style = "display: none">Adding Business Unit...</div>

<br />

<div id = "add_plant">Add Business Unit?</div>

<div id ="new_business_unit" class = "hidden_form">
    <span id = "hide" class = "faded">hide this form</span>
    <?php echo $this->Form->create('BusinessUnit',
        array(
            'default' => false,
            'type'=> 'post',
        ));

    echo $this->Form->input('name', array('placeholder' => 'e.g. Distillation & Reforming'));
    echo $this->Form->input('short_name', array('placeholder' => 'e.g. D&R'));
    echo $this->Form->input('description', array('placeholder' => 'e.g. Generic Description'));
    echo $this->Form->input('refinery_id');

    echo $this->Js->submit('Add Business Unit', array(
        'url' => array('controller' => 'business_units', 'action' => 'add'),
        'before' => $this->Js->get('#updating')->effect('fadeIn'),
        'success' => $this->Js->get('#updating')->effect('fadeOut'),
        'update' => '#new_business_unit_placeholder',

    ));
    echo $this->Form->end();
    ?>
</div>