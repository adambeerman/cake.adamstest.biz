<div class = "pfd">
    <h3>My PFDs</h3>
    <?php foreach($userPFDs as $PFD) {
        echo $this->Html->link($PFD['Pfd']['name'],
            array('controller' => 'pfds', 'action' => 'view', $PFD['Pfd']['id']));

        echo "<span class='faded'>";
        echo " | ";
        echo $this->Html->link('edit',
            array('controller' => 'pfds', 'action' => 'build', $PFD['Pfd']['id']));
        echo " | ";
        echo $this->Form->postLink(
            'delete',
            array('controller' => 'pfds', 'action' => 'delete', $PFD['Pfd']['id']),
            array('confirm'=> 'Are you sure?')
        );
        echo "</span>";
        echo "<br>";
    } // end of foreach?>

    <br />
    <span class = "faded">
        <?php echo $this->Html->link(
            'New PFD',
            array('controller' => 'pfds', 'action' => 'add')
        );
        ?>
    </span>


    <br/>
    <br/>
</div>