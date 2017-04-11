<?php require "bootstrap/index.php"; ?>
<?php

if (!\App\Models\Auth::check()) {
    redirect('index.php');
}

use App\Forms\LogoutForm;

if (isset($_POST['submit'])) {
    $form = new LogoutForm();

    try {
        $form->process($_POST);
    } catch (InvalidArgumentException $e) {
        dump($e);
    }
}

?>

<?php require "resources/header.phtml"; ?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h1 class="text-center">Logout Page</h1>
        <form action="" method="POST">
            <div class="form-group">
                <input type="submit" name="submit" value="Logout" class="form-control">
            </div>
            <div class="form-group">
                <input type="checkbox" name="allDevices" value="allDevices" id="allDevices">
                <label for="allDevices"><small>Do you want to logout from all devices?</small></label>
            </div>
        </form>
    </div>
</div>


<?php require "resources/footer.phtml"; ?>