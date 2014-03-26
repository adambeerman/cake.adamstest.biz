<!-- Cake PHP Template -->

<!-- Turnover Group Profile -->

<h2>Turnovers</h2>

<!-- Create a toggle to change between Refinery / Business Unit / Plant Turnovers -->

<!-- Create a link to filter by My turnovers -->

<!-- These will be get request -->


<!-- Refinery Turnovers -->
<h3>Refinery Turnovers</h3>

<?php foreach($refineryTOs as $refineryTO): ?>

    <?php // echo $refineryTO['TurnoverGroup']['name']; ?>
    <?php echo $this->Html->link($refineryTO['TurnoverGroup']['name'],
        array('controller' => 'turnover_groups', 'action' => 'view',
            $refineryTO['TurnoverGroup']['id'])); ?>
    <br>

    <?php endforeach; ?>



<!-- Business Unit Turnovers -->
<br>
<h3>Business Unit Turnovers</h3>
<?php foreach($businessUnitTOs as $buTO) {
    //print_r($buTO);

    echo $buTO['TurnoverGroup']['name'];
    echo "<br>";
}?>

<!-- Loop through MyTurnovers -->
<br>
<h3>My Turnovers</h3>
<?php foreach($myTOs as $myTO): ?>

    <?php echo $this->Html->link(CakeTime::format($myTO['Turnover']['created'], '%B %e')." - ".$myTO['Turnover']['name'],
        array('controller' => 'turnovers', 'action' => 'view',
            $myTO['Turnover']['id'])); ?>
    <br>


<?php endforeach; ?>