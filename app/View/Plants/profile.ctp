<!-- Cake PHP Template -->

<h2>
    Dashboard: <?php echo $data['Plant']['short_name'] ?>

</h2>

<pre>
    <?php //print_r($data); ?>
</pre>

<div class = 'unit'>
    <h3>Units</h3>
    <?php foreach($data['Unit'] as $datum): ?>
        <pre>
           <?php //print_r($datum); ?>
        </pre>
    <?php endforeach; ?>

    <?php foreach($data['Unit'] as $datum): ?>

        <?php //echo $datum['short_name']; ?>
        <?php echo $this->Html->link($datum['short_name'],
            array('controller' => 'units', 'action' => 'profile',
                $datum['id'])); ?>
        <br>
    <?php endforeach; ?>
</div>
