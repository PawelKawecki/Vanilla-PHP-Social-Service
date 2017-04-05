<?php

use App\Forms\RegisterForm;

require  __DIR__  . '/bootstrap/index.php';

if (isset($_POST['submit'])) {
    $form = new RegisterForm();

    try {
        $form->process($_POST);
    } catch (InvalidArgumentException $e) {
        dump($e);
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/app.css">
</head>

</html>
<div class="container">
    <div class="header">

    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form action="" method="POST" >
                <div class="form-group">
                    <input type="text" name="username" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create Account" class="form-control">
                </div>
            </form>
        </div>
    </div>

</div>

