<?php

echo $this->Html->link($business_unit['BusinessUnit']['short_name'],array('action' => 'business_units',
    'controller'=>'profile', $business_unit['BusinessUnit']['id']));
echo "<span class='faded'> | ";
echo $this->Form->postLink(
    'Delete',
    array('controller' => 'business_units',
        'action' => 'delete',
        $business_unit['BusinessUnit']['id']),
    array('confirm'=> 'Are you sure?'));
echo "</span>";