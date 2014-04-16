<?php echo $this->Html->link($plant['Plant']['short_name'],array('action' => 'plants',
    'controller'=>'profile', $plant['Plant']['id']));
echo "<span class='faded'> | ";
echo $this->Form->postLink(
    'Delete',
    array('controller' => 'plants',
        'action' => 'delete',
        $plant['Plant']['id']),
    array('confirm'=> 'Are you sure?'));
echo "</span>";
?>