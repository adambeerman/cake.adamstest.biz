<div class="pfd_connections form">
    <?php echo $this->Form->create('PfdConnection'); ?>
    <fieldset>
        <legend><?php echo __('New Connection'); ?></legend>
        <?php


        echo $this->Form->input('pfd_id');

        // Since we're building connections between items, at least a or b will have already been selected:
        if($ab_flag == 'a') {
            echo $this->Form->input('a_id');
            echo $this->Form->hidden('b_id');
        }
        else {
            echo $this->Form->input('b_id');
            echo $this->Form->hidden('a_id');
        }



        echo $this->Form->input('name', array('placeholder' => 'e.g. R-610'));
        echo $this->Form->input('description', array('placeholder' => 'e.g. DHT Reactor'));

        // Ignoring the plant for now.
        //echo $this->Form->input('plant_id');
        //echo $this->Form->input('content', array('rows' => '3'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div><!-- Cake PHP Template -->