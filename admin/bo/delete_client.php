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
        $client_name = $results[0]['client_name'];
        $access_key = $results[0]['access_key'];
    }
}

if (!empty($error)) : ?>
    <div class="row my-5">
        <div class="col-sm-6 offset-sm-3 text-center">
            <p class="alert alert-danger">
                <?= $error ?>
            </p>
            <a href="?route=home" class="btn btn-primary">Back</a>
        </div>
    </div>

<?php else : ?>
    <div class="col-sm-6 offset-sm-3 text-center">
        <h3>Delete Client</h3>
        <hr>
        <div class="card bg-light p-2">
            <p>Are you sure you want to delete this client?</p>
            <p>
                <strong>Client Name:</strong> <?= $client_name ?>
            </p>
            <p>
                <strong>Access Key:</strong> <?= $access_key ?>
            </p>
            <div class="mt-3">
                <a href="?route=home" class="btn btn-primary">Back</a>
                <a href="?route=delete_client_ok&id=<?= $_GET['id'] ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>

    </div>
<?php endif; ?>