<!-- Cake PHP Template -->

<div class="pfd_items form">
    <?php echo $this->Form->create('PfdItem'); ?>
    <fieldset>
        <legend><?php echo __('New Item/Equipment'); ?></legend>
        <?php

        echo $this->Form->input('name', array('placeholder' => 'e.g. R-610'));
        echo $this->Form->input('description', array('placeholder' => 'e.g. DHT Reactor'));

        //echo $this->Form->input('plant_id');
        //echo $this->Form->input('content', array('rows' => '3'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>