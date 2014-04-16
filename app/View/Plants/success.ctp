<?php echo $this->Html->link($plant['Plant']['short_name'],array('action' => 'plants',
    'controller'=>'profile', $plant['Plant']['id'])); ?>