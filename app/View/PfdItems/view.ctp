<!-- Cake PHP Template -->

<?php echo $this->Html->script('j_pfditems_view'); ?>

<h2><?php echo $pfdItem['PfdItem']['name']; ?></h2>
<h3><?php echo $pfdItem['PfdItem']['description']; ?></h3>

<div class = "row">
    <div class = "add_stream col-md-5 text-right">
        <span id = "add_stream_in">Add Stream</span><span class="glyphicon glyphicon-arrow-right"></span>
    </div>
    <canvas id = "unit" class = "col-md-2">

    </canvas>

    <div class = "add_stream col-md-5">
        <span class="glyphicon glyphicon-arrow-right"></span><span id = "add_stream_out">Add Stream</span>
    </div>
</div>
