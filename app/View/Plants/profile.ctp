<!-- Cake PHP Template -->

<h2>
    Dashboard: <?php echo $data['Plant']['short_name'] ?>

</h2>

<pre>
    <?php //print_r($data); ?>
</pre>

<h3>PFD</h3>
<h4><?php echo $this->Html->link('Build '.$data['Plant']['short_name'].' PFD!',
    array('controller' => 'pfds', 'action' => 'build', $data['Plant']['id']));
    ?></h4>

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
