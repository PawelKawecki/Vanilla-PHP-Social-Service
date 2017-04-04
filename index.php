<?php

use App\Forms\RegisterForm;

require  __DIR__  . '/bootstrap/index.php';

if (isset($_POST['submit'])) {
    $form = new RegisterForm(new Database(new PDO('mysql:host=localhost;dbname=social_media;charset=utf8', 'root', '')));

    $form->process($_POST);
}


?>

<form action="" method="POST">
    <input type="text" name="username" placeholder="Username">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="submit" value="Create Account">
</form>
