<!-- Cake PHP Template -->

<?php echo $this->Html->script('jquery', FALSE); ?>
<?php echo $this->Html->script('j_plants', FALSE); ?>

<h3>Plants</h3>

<?php foreach($plants as $plant): ?>

    <?php echo $this->Html->link($plant['Plant']['short_name'],
        array('controller' => 'plants', 'action' => 'profile',
            $plant['Plant']['id'])); ?>
    <br />

<?php endforeach; ?>
<br />

<div id = "new_plant_placeholder"></div>
<div id = "updating" style = "display: none">Adding Plant...</div>

<span id = "add_plant">Add Plant?</span>

<div id ="new_plant" class = "hidden">
    <?php echo $this->Form->create('Plant',
        array(
            'default' => false,
            'type'=> 'post',
        ));
    ?>

    <?php

    echo $this->Form->input('name');
    echo $this->Form->input('short_name');
    echo $this->Form->input('description');
    echo $this->Form->input('prefix');
    echo $this->Form->input('BusinessUnit');

    echo $this->Js->submit('Add Plant', array(
        'url' => array('controller' => 'plants', 'action' => 'add'),
        'before' => $this->Js->get('#updating')->effect('fadeIn'),
        'success' => $this->Js->get('#updating')->effect('fadeOut'),
        'update' => '#new_plant_placeholder',

    ));
    echo $this->Form->end();
    ?>
</div>

