<!-- Cake PHP Template -->

<h2>Welcome,
    <?php echo AuthComponent::user('first_name'); ?>
</h2>


<div class = 'plant'>
    <h3>Plants</h3>
    <?php foreach($data['Plant'] as $datum): ?>

        <?php //echo $datum['short_name']; ?>
        <?php echo $this->Html->link($datum['short_name'],
            array('controller' => 'plants', 'action' => 'profile',
                $datum['id'])); ?>
    <?php endforeach; ?>
</div>
