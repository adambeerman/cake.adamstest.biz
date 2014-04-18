
<!--
Need to show:
history,
turnovers,
strategy,
equipment,
pfds,
notes/ideas,
plants/businessUnits

-->
<h2>Welcome,
    <?php echo AuthComponent::user('first_name'); ?>
</h2>

<br />
<div class = "container-fluid ">
    <div class = "row">
        <div class = "square col-xs-3"
             style = "background-image: url('https://cdn1.iconfinder.com/data/icons/ios7-line/512/Timetable.png')">
            History
        </div>
        <div class = "square col-xs-offset-1 col-xs-3"
            style = "background-image: url('http://4vector.com/i/free-vector-three-circular-interlocking-arrows_101013_Three_Circular_Interlocking_Arrows.png')">
            <?php echo $this->Html->link('Turnovers', array('controller' => 'turnover_groups', 'action' => 'index')); ?>
        </div>
        <div class = "square col-xs-offset-1 col-xs-3">
            Strategy
        </div>

    </div>
    <div class = "row">
        <div class = "square col-xs-3">
            Equipment
        </div>
        <div class = "square col-xs-offset-1 col-xs-3">
            <?php echo $this->Html->link('PFDs', array('controller' => 'pfds', 'action' => 'index')); ?>
        </div>
        <div class = "square col-xs-offset-1 col-xs-3">
            Notes/Ideas
        </div>
    </div>
    <div class = "row">
        <div class = "square col-xs-3">
            <?php echo $this->Html->link('Plants', array('controller'=>'plants', 'action' => 'index'));?>
        </div>
        <div class = "square col-xs-offset-1 col-xs-3">
            <?php echo $this->Html->link('Business Units', array('controller'=>'business_units', 'action' => 'index'));?>
        </div>
        <div class = "square col-xs-offset-1 col-xs-3">
            Other
        </div>
    </div>

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

    <!-- allow user to modify his/her plants -->
    <br>
    <div class = "modify">
        <?php echo $this->Html->link(
            'modify',
            array('action' => 'plant_edit', $data['User']['id'])); ?>

    </div>
</div>
<br>

