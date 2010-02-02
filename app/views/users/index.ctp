<p class="welcome">Hello <fb:name uid="<?php echo $fb_user; ?>" />!</p>

<?php echo $form->create('User', array('action' => 'create'));?>
<input type="hidden" name="data[User][facebook_id]" value="<?php echo $fb_user_id; ?>" />
    <fieldset>
        <legend>Add a Github User</legend>
        <ol>
            <li><label for="data_user_github_name">Github name:</label>
            <input type="text" size="20" name="data[User][github_name]" id="data_user_github_name" /></li>
            <li><input type="submit" value="Add &raquo;" /></li>
        </ol>
    </fieldset>
<?php echo $form->end(); ?>

<dl>
    <?php foreach ($users as $user): ?> 
    <dt> 
        <?php echo $user['User']['github_name']; ?> &mdash;
        <?php echo $html->link('Edit', array('controller' => 'Users', 'action' => 'edit', 'id' => $user['User']['id']))?>, 
        <?php echo $html->link('Delete', array('controller' => 'Users', 'action' => 'delete', 'id' => $user['User']['id']), null, 'Are you sure to delete the following Github user? \n - '.$user['User']['github_name'].'')?>
    </dt>
    <dd>
        <h3>Repositories</h3>
        <dl>
            <?php foreach ($repos_data[$user['User']['id']] as $repos): ?>
                <dt>
                    <a href="<?php echo $repos[0]; ?>">
                        <?php echo $repos[6]; ?>
                    </a>
                </dt>
                <dd>
                    <em><?php echo $repos[':description']; ?></em>
                </dd>
            <?php endforeach; ?>
        </dl>
    </dd>
    <?php endforeach; ?> 
</dl>