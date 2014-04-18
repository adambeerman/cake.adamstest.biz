<!-- Cake PHP Template -->

<?php echo $this->Html->script('jquery', FALSE); ?>
<?php echo $this->Html->script('j_plants', FALSE); ?>



<h3>Plants</h3>

<?php foreach($businessUnitsPlants as $businessUnit): ?>

    <?php echo $businessUnit['BusinessUnit']['short_name']; ?>
    <ul>
        <?php foreach($businessUnit['Plant'] as $plant): ?>
        <li>
            <?php echo $this->Html->link($plant['short_name'],
                    array('controller' => 'plants',
                    'action' => 'profile',
                    $plant['id']));
            echo "<span class='faded'> | ";
            echo $this->Form->postLink(
                'Delete',
                array('controller' => 'plants',
                    'action' => 'delete',
                    $plant['id']),
                array('confirm'=> 'Are you sure?'));
            echo "</span>";
            ?>
        </li>
        <?php endforeach; ?>
    </ul>

<?php endforeach; ?>



<div id = "new_plant_placeholder"></div>
<div id = "updating" style = "display: none">Adding Plant...</div>

<br />

<div id = "add_plant">Add Plant?</div>

<div id ="new_plant" class = "hidden_form">
    <span id = "hide" class = "faded">hide this form</span>
    <?php echo $this->Form->create('Plant',
        array(
            'default' => false,
            'type'=> 'post',
        ));

    echo $this->Form->input('name', array('placeholder' => 'e.g. Jet Hydrotreater'));
    echo $this->Form->input('short_name', array('placeholder' => 'e.g. JHT'));
    echo $this->Form->input('description', array('placeholder' => 'e.g. Hydrotreater 1 & 2 Sidecuts'));
    echo $this->Form->input('prefix', array('placeholder'=>'e.g. 36'));
    echo $this->Form->input('business_unit_id');

    echo $this->Js->submit('Add Plant', array(
        'url' => array('controller' => 'plants', 'action' => 'add'),
        'before' => $this->Js->get('#updating')->effect('fadeIn'),
        'success' => $this->Js->get('#updating')->effect('fadeOut'),
        'update' => '#new_plant_placeholder',

    ));
    echo $this->Form->end();
    ?>
</div>



