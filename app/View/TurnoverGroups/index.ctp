<!-- Cake PHP Template -->

<?php echo $this->Html->script('bootstrap'); ?>

<br />
<h2>Turnovers</h2>

<div class = "btn-group">
    <button type="button" class = "btn btn-default">
        Refinery
    </button>
    <button type="button" class = "btn btn-default">
        Business Unit
    </button>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Word
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <?php foreach($businessUnitTOs as $buTO) {
                echo "<li>";
                echo $this->Html->link($buTO['TurnoverGroup']['name'],array(
                        'controller' => 'turnover_groups', 'action' => 'view',
                        $buTO['TurnoverGroup']['id'])
                );
                echo "</li>";
            }
            ?>
        </ul>
    </div>

</div>

<div class = 'turnover_group'>
    <div class = "btn-group">

    </div>
    <h3>Turnovers in my Business Unit</h3>
    <?php foreach($businessUnitTOs as $buTO) {
        echo $this->Html->link($buTO['TurnoverGroup']['name'],array(
                'controller' => 'turnover_groups', 'action' => 'view',
                $buTO['TurnoverGroup']['id'])
        );
        echo "<br>";
    }

    ?>
</div>

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


<!-- Loop through MyTurnovers -->
<br>
<h3>My Turnovers</h3>
<?php foreach($myTOs as $myTO): ?>

    <?php echo $this->Html->link(CakeTime::format($myTO['Turnover']['created'], '%B %e')." - ".$myTO['Turnover']['name'],
        array('controller' => 'turnovers', 'action' => 'view',
            $myTO['Turnover']['id'])); ?>
    <br>


<?php endforeach; ?>