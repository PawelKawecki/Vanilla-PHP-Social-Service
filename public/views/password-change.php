<?php if (!\App\Models\Auth::check()) redirect('index'); ?>

<?php require "resources/header.phtml"; ?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <h2 class="text-center spacing">Password Change</h2>
        <form action="" method="POST">
            <div class="form-group">
                <input type="password" name="old_password" placeholder="Old Password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Repeat Password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Save Changes" class="form-control">
            </div>
        </form>
    </div>
</div>

<?php require "resources/footer.phtml"; ?>

