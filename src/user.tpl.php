<?php
declare(strict_types = 1);
?>


<?php function drawProfile(User $user) { ?>
    <h2>Profile</h2>
    <form action="/action_edit_profile.php" method="post" class="profile">

        <label for="Username">Username:</label>
        <input id="username" type="text" name="username" value="<?=$user->username?>">

        <label for="first_name">First Name:</label>
        <input id="first_name" type="text" name="firstname" value="<?=$user->firstName?>">
        
        <label for="last_name">Last Name:</label>
        <input id="last_name" type="text" name="lastname" value="<?=$user->lastName?>">
        
        <label for="Email">Email:</label>
        <input id="email" type="text" name="email" value="<?=$user->email?>">

        <label for="Password">Password:</label>
        <input id="password" type="password" name="password" value="password">
        
        <button type="submit">Save</button>
    </form>

<?php } ?>