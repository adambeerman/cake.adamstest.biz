<!-- Cake PHP Template -->


<h2>Welcome,
    <?php echo AuthComponent::user('first_name'); ?>
</h2>

<h3><?php echo $this->Html->link('> edit Plants', array('controller'=>'plants', 'action' => 'index'));?></h3>
<h3><?php echo $this->Html->link('> edit Business Units', array('controller'=>'business_units', 'action' => 'index'));?></h3>


<div class = "pfd">
    <h3>My PFDs</h3>
    <?php foreach($userPFDs as $PFD) {
        echo $this->Html->link($PFD['Pfd']['name'],
            array('controller' => 'pfds', 'action' => 'view', $PFD['Pfd']['id']));

        echo "<span class='faded'>";
        echo " | ";
        echo $this->Html->link('edit',
            array('controller' => 'pfds', 'action' => 'build', $PFD['Pfd']['id']));
        echo " | ";
        echo $this->Form->postLink(
            'delete',
            array('controller' => 'pfds', 'action' => 'delete', $PFD['Pfd']['id']),
            array('confirm'=> 'Are you sure?')
        );
        echo "</span>";
        echo "<br>";
    }?>

    <br />
    <span class = "faded">
        <?php echo $this->Html->link(
            'New PFD',
            array('controller' => 'pfds', 'action' => 'add')
        );
        ?>
    </span>


    <br/>
    <br/>
</div>

<div class = 'plant'>
    <h3>My Plants: </h3>


    <!-- If user has Plant data, display it,
    Otherwise, allow them to add a new plant-->

    <?php foreach($data['Plant'] as $datum): ?>

        <?php //echo $datum['short_name']; ?>
        <?php echo $this->Html->link($datum['short_name'],
            array('controller' => 'plants', 'action' => 'profile',
                $datum['id'])); ?>
        <br>
    <?php endforeach; ?>

    <!-- allow user to modify their plants -->

    <?php $this->Html->link('Edit Plants', array('controller'=> 'users', 'action' => 'plant_edit', AuthComponent::user('id'))); ?>

    <br>
    <div class = "modify">
        <?php echo $this->Html->link(
            'modify',
            array('action' => 'plant_edit', $data['User']['id'])); ?>

    </div>




    <!-- This will be to test Ajax!
    <p id = "modify_plants">Click here to test AJAX - plant modification</p>

    -->

    <?php
    //on button click sends request to controller and displays response data in chosen field
    $this->Js->get('#modify_plants')->event(
        'click', $this->Js->request(
            array('controller' => 'users', 'action' => 'profile', AuthComponent::user('id')), array(
                'update' => '#new_plants',
                'async' => true,
            )
        )
    );

    ?>


    <div id = "new_plants"></div>
</div>
<br>

<div>
    <h3>My Turnovers</h3>
    <?php foreach($userTOs as $turnover) {
        echo $this->Time->format($turnover['Turnover']['created'], '%m/%d')." - ".
        $this->Html->link($turnover['Turnover']['name'],
            array('controller' => 'turnover_groups', 'action' => 'view',
                $turnover['Turnover']['turnover_group_id'],$turnover['Turnover']['turnover_idx']));
    echo "<br>";
    }
    ?>

</div>
<br>

<div class = 'turnover_group'>
    <h3>Turnovers in my Business Unit</h3>
    <?php foreach($userTOGroups as $TOGroup) {
        echo $this->Html->link($TOGroup['TurnoverGroup']['name'],array(
            'controller' => 'turnover_groups', 'action' => 'view',
            $TOGroup['TurnoverGroup']['id'])
        );
        echo "<br>";
    }

    ?>
</div>