<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>

<?php
require_once('bo/navigation.php');


// if post exists
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $text_client = $_POST['text_client'];
    $access_key = $_POST['access_key'];
    $text_password = $_POST['text_password'];

    // validate data
    $error = '';
    if (empty($text_client) || empty($access_key) || empty($text_password)) {
        $error = "All fields are required.";
    }

    // check if client exists in database
    if (empty($error)) {
        $db = new database();
        $params = [
            ":text_client" => $text_client,
            ":access_key" => $access_key,
        ];
        $results = $db->EXE_QUERY("SELECT * FROM authentication WHERE client_name = :text_client OR access_key = :access_key", $params);

        if (count($results) > 0) {
            $error = "Client client_name or access_key already exists.";
        }
    }

    // save data to database
    if (empty($error)) {
        $db = new database();
        $params = [
            ":client_name" => $text_client,
            ":access_key" => $access_key,
            ":passwrd" => password_hash($text_password, PASSWORD_DEFAULT),
        ];
        $db->EXE_NON_QUERY("INSERT INTO authentication VALUES (0, :client_name, :access_key, :passwrd, NOW(), NOW(), null)", $params);

        $success = "Client added successfully.";
    }
}



?>

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-8 offset-sm-2">

            <form action="?route=new_client" method="post">
                <h3 class="text-cente">New Client</h3>
                <hr>

                <div class="card bg-light p-2">
                    <div class="mb-3">
                        <label class="form-label">Client:</label>
                        <input type="text" name="text_client" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">access_key:</label>
                        <input type="text" id="access_key" name="access_key" class="form-control" readonly required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="text" id="password" name="text_password" class="form-control" readonly required>
                    </div>

                    <div class="mb-3 text-end">
                        <button type="button" id="generate" onclick="generateUserAndPassword()" class="btn btn-primary">Refresh</button>
                    </div>

                    <div class="text-center">
                        <a href="?route=home" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
            <!-- show the error -->
        </div>
        <?php if (!empty($error)) { ?>
            <p class="alert alert-danger p-2 mt-2 text-center">
                <?= $error ?>
            </p>
        <?php } ?>

        <?php if (!empty($success)) { ?>
            <p class="alert alert-success p-2 mt-2 text-center">
                <?= $success ?>
            </p>
            <div class="mt-3 card p-2 bg-light">
                <p>Cliente: <?= $text_client ?></p>
                <p>Access_key: <?= $access_key ?></p>
                <p>Password: <?= $text_password ?></p>
            </div>
        <?php } ?>
    </div>
</div>
</div>

<script>
    function generateUserAndPassword() {
        //define variables
        const characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const charactersLength = characters.length;

        const clientaccess_keyLength = 32;
        const clientPasswordLength = 32;

        //generate random access_key
        let access_key = '';
        for (var i = 0; i < clientaccess_keyLength; i++) {
            access_key += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        //generate random password
        let password = '';
        for (var i = 0; i < clientPasswordLength; i++) {
            password += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        //set access_key and password
        document.getElementById('access_key').value = access_key;
        document.getElementById('password').value = password;
    }

    generateUserAndPassword();
</script>