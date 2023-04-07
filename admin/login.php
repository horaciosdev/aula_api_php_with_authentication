<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>

<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4 card bg-light p-3">
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label class="form-label">User:</label>
                    <input type="text" name="text_user" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="text_password" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

            </form>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="row mt-3">
                    <div class="col">
                        <div class="text-center alert alert-danger p-2">
                            <?= $_SESSION['error'] ?>
                            <?php
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>