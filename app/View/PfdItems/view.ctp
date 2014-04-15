<!-- Cake PHP Template -->

<?php echo $this->Html->script('j_pfditems_view'); ?>

<?php debug($pfdItem); ?>

<h2><?php echo $pfdItem['PfdItem']['name']; ?></h2>
<h3><?php echo $pfdItem['PfdItem']; ?></h3>
<canvas id = "unit">

</canvas>