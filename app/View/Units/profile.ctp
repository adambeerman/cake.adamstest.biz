<!-- Cake PHP Template -->

<h2>
    Dashboard: <?php echo $data['Unit']['short_name'] ?>
    <small>(
        <?php echo $data['Unit']['description']; ?>)
    </small>
</h2>

<pre>
    <?php print_r($data); ?>
</pre>

<div class = 'Equipment'>
    <h3>Equipment</h3>
    <?php foreach($data['Equipment'] as $datum): ?>

        <?php echo $this->Html->link($datum['short_name'],
            array('controller' => 'equipment', 'action' => 'profile',
                $datum['id'])); ?>
        <br>
    <?php endforeach; ?>
</div>