<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>

<?php
require_once('bo/navigation.php');

$error = '';
// if post exists
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get form data
    $id = $_POST['id'];
    $text_client = $_POST['text_client'];
    $access_key = $_POST['access_key'];
    $text_password = $_POST['text_password'];
    $change_key_and_pass = $_POST['change_key_and_pass'];

    // validate data
    if (empty($id) || empty($text_client) || empty($access_key) || !isset($text_password) || empty($change_key_and_pass)) {
        $error = "All fields are required.";
    }

    // check if client exists in database
    if (empty($error)) {
        $change_key_and_pass = $_POST['change_key_and_pass'] == "true" ? true : false;

        $db = new database();
        $params = [
            ":id_client" => $id,
            ":text_client" => $text_client,
        ];
        $results = $db->EXE_QUERY("SELECT * FROM authentication WHERE client_name = :text_client AND id_client <> :id_client", $params);
        if (count($results) > 0) {
            $error = "There's another client with the same name.";
        } else {
            $db = new database();
            $params = [
                ":id_client" => $id,
                ":text_client" => $text_client,
            ];
            //UPDATE client name
            $results = $db->EXE_QUERY("UPDATE authentication 
                                            SET 
                                            client_name = :text_client,
                                            updated_at = NOW()
                                            WHERE id_client = :id_client", $params);

            $success = "Client name updated successfully.";
        }

        if ($change_key_and_pass) {
            $db = new database();
            $params = [
                ":id_client" => $id,
                ":access_key" => $access_key,
                ":text_password" => password_hash($text_password, PASSWORD_DEFAULT)
            ];
            $results = $db->EXE_QUERY("UPDATE authentication 
                                            SET 
                                            access_key = :access_key,
                                            passwrd = :text_password,
                                            updated_at = NOW()
                                            WHERE id_client = :id_client", $params);
            $success = "Client access key and password updated successfully.";
        }
    }
}
?>

<?php
// query cliend from database
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']) || !empty($_GET['id'])) {
        $db = new database();
        $params = [
            ":id_client" => $_GET['id']
        ];
        $results = $db->EXE_QUERY("SELECT * FROM authentication WHERE id_client = :id_client", $params);
        if (count($results) != 1) {
            $error = "Client not found.";
        } else {
            $id = $results[0]['id_client'];
            $text_client = $results[0]['client_name'];
            $access_key = $results[0]['access_key'];
        }
    } else {
        $error = "id is required.";
    }
}
?>

<?php if (!empty($error)) : ?>
    <div class="container">
        <div class="col-sm-6 offset-sm-3">
            <p class="alert alert-danger p-2 mt-2 text-center">
                <?= $error ?>
            </p>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-8 offset-sm-2">

                <form action="?route=edit_client" method="post">
                    <input type="hidden" name="id" id="id" value="<?= $id ?>">
                    <input type="hidden" name="change_key_and_pass" id="change_key_and_pass" value="false">


                    <h3 class="text-cente">Edit Client</h3>
                    <hr>

                    <div class="card bg-light p-2">
                        <div class="mb-3">
                            <label class="form-label">Client:</label>
                            <input type="text" name="text_client" class="form-control" value="<?= $text_client ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">access_key:</label>
                            <input type="text" id="access_key" name="access_key" class="form-control" value="<?= $access_key ?>" readonly required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="text" id="password" name="text_password" class="form-control" placeholder="<?= str_repeat("&#8226;", 32) ?>" readonly required>
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
                    <p>Client: <?= $text_client ?></p>
                    <p>Access_key: <?= $access_key ?></p>
                    <p>Password: <?= $text_password ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>

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
        document.getElementById('change_key_and_pass').value = "true";
    }
</script>