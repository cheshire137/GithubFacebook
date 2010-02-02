<?php echo $form->create('User', array('action' => 'update'));?>
<input type="hidden" name="data[User][facebook_id]" value="<?php echo $user['facebook_id']; ?>" />
    <fieldset>
        <legend>Edit a Github User</legend>
        <ol>
            <li><label for="data_user_github_name">Github name:</label>
            <input value="<?php echo $user['github_name']; ?>" type="text" size="20" name="data[User][github_name]" id="data_user_github_name" /></li>
            <li><input type="submit" value="Update &raquo;" /></li>
        </ol>
    </fieldset>
<?php echo $form->end(); ?>