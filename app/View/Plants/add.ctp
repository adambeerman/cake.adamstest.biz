ADD VIEW
<?php echo $this->Form->create('Plant',
    array(
        'default' => false,
        'type'=> 'post',
    ));

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