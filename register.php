<?php require "bootstrap/index.php"; ?>
<?php if (\App\Models\Auth::check()) redirect('index.php'); ?>
<?php

use App\Forms\RegisterForm;

if (isset($_POST['submit'])) {
    $form = new RegisterForm();
    try {
        $form->process($_POST);

        $result = $form->getMessage();
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    } catch (\App\Exceptions\UserAlreadyExistsException $e) {
        $error = $e->getMessage();
    }
}

?>
<?php require "resources/header.phtml"; ?>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h2 class="text-center spacing">Register Form</h2>
            <form action="" method="POST">
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
                    <input type="password" name="password_confirmation" placeholder="Repeat Password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create Account" class="form-control">
                </div>
            </form>
        </div>
    </div>

<?php require "resources/footer.phtml"; ?>

