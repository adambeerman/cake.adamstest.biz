<!-- Cake PHP Template -->

<?php // We have $pfd information available ?>

<div id = "pfd_builder">

    <h2>PFD BUILDER</h2>

    <?php if(isset($initial_flag)) {

        echo "<h3>Add your first item</h3>";
        echo '<div class = "new_item">';
        echo $this->Html->link('[+]', array('controller' => 'pfd_items', 'action'=> 'add', $pfd['Pfd']['id']));
        echo '</div>';

    } else {
        //Here
        foreach($items as $item) {

            echo $this->Html->link($item['PfdItem']['name'],
                array('controller' => 'pfd_items', 'action' => 'view', $item['PfdItem']['id']));

            echo "<span class='faded'>";
            echo " | ";
            echo $this->Html->link('edit',
                array('controller' => 'pfd_items', 'action' => 'edit', $item['PfdItem']['id']));
            echo " | ";
            echo $this->Form->postLink(
                'delete',
                array('controller' => 'pfd_items', 'action' => 'delete', $item['PfdItem']['id']),
                array('confirm'=> 'Are you sure?')
            );
            echo "</span>";
            echo "<br>";
            echo "<br>";

        }
    }
    ?>


</div>

