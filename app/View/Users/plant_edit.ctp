<!-- Cake PHP Template -->

<pre>
    <?php //print_r($user); ?>
    <?php  //print_r($userInfo['Plant']); ?>
    <?php  //print_r($businessUnitInfo); ?>

</pre>

<?php
echo $this->Form->create('User');
echo $this->Form->input('Plant');
echo $this->Form->end('Save Updates');

?>