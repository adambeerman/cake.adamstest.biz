
<div class = "row">
    <div class = "col-xs-offset-1 col-xs-10">
        <div class = "turnover">

        <?php // I want the user to be able to edit the turnover if they created it ?>

        <h4><?php echo $turnover['Turnover']['name']; ?></h4>

        <?php if($turnover['Turnover']['user_id']==AuthComponent::user('id')) {
            //If user owns this turnover, give them a link to modify it
            echo $this->Html->link(
                $turnover['Turnover']['content'],
                array('controller' => 'turnovers','action'=>'edit', $turnover['Turnover']['id'])
            );
            echo "<br />";
            /*echo $this->Form->postLink(
                        'Delete',
                        array('controller' => 'turnovers', 'action' => 'delete', $turnover['Turnover']['id'])
                    ); */
            echo "<span class='delete'>Delete</span>";
        }
        else {
            // Otherwise, just echo the content
            echo $turnover['Turnover']['content'];
        }

        ?>

        </div>
    </div>
</div>
<br />
