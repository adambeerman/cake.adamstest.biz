<!-- File: /app/View/Posts/index.ctp -->
<h1>Blog posts</h1>

This user id is: <?php echo AuthComponent::user('id'); ?>
<br>

<h2>Links</h2>
<br>

<a href = '/users'>Users</a><br>
<a href = '/equipment'>Equipment</a><br>
<a href = '/plants'>Plants</a><br>
<a href = '/businessunits'>Business Units</a><br>



<?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'posts', 'action' => 'add')
); ?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

    <!-- Loop Through Posts Array -->
    <?php foreach ($posts as $post): ?>


    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
            array('controller' => 'posts', 'action' => 'view',
            $post['Post']['id'])); ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm'=> 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit',
                    array('action'=>'edit', $post['Post']['id'])
                );
            ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>