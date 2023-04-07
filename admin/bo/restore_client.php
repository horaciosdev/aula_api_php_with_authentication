<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>
<?php
require_once('bo/navigation.php');
?>
<?php
$error = '';
// check if get has an id
if (!isset($_GET['id'])) {
    $error = "id is required.";
}

if (empty($error)) {
    // check if client exist in database
    $db = new database();
    $params = [
        ":id" => $_GET['id'],
    ];
    $results = $db->EXE_QUERY("SELECT * FROM authentication WHERE id_client = :id", $params);

    if (count($results) == 0) {
        $error = "Client does not exist.";
    } else {
        // restore client
        $db->EXE_NON_QUERY("UPDATE authentication SET deleted_at = NULL WHERE id_client = :id", $params);
        header("Location: index.php");
        return;
    }
}
?>
<?php if (!empty($error)) : ?>
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3 text-center">
            <p class="alert alert-danger">
                <?= $error ?>
            </p>
            <a href="index.php" class="btn btn-primary">Back</a>
        </div>
    </div>
<?php endif; ?>