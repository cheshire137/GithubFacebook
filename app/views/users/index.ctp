<h1>Users</h1> 
<p><?php echo $html->link('Add a Github User', '/users/add') ?></p> 
<ul>
    <?php foreach ($users as $user): ?> 
    <li> 
        <?php echo $note['User']['github_name']; ?>
        [<?php echo $html->link('Edit', "/users/edit/{$user['User']['id']}")?>, 
        <?php echo $html->link('Delete', "/users/delete/{$user['User']['id']}", null, 'Are you sure to delete the following Github user? \n - '.$user['User']['github_name'].'')?>]
    </li> 
    <?php endforeach; ?> 
</ul>