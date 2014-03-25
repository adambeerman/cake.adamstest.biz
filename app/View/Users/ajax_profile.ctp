<!-- Cake PHP Template -->

<?php

echo $this->Form->create('User');
echo $this->Form->input('Plant'); //,array('multiple'=>'true'));
echo $this->Form->end('Save Updates');

?>