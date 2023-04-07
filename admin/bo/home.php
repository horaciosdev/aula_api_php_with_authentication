<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>

<?php
require_once('bo/navigation.php');
?>

<?php
// request clients data from the database
$db = new database();
$api_clients = $db->EXE_QUERY('SELECT * FROM authentication');

?>

<div class="container mt-5">
    <div class="row">
        <div class="col">

            <div class="row">
                <div class="col-sm-6">
                    <h3>Api Clients</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="?route=new_client" class="btn btn-primary btn-sm">Add Client</a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Client</th>
                                <th>AcessKey</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($api_clients as $api_client) { ?>
                                <tr class="<?= empty($api_client['deleted_at']) ? "" : "text-secondary" ?>">
                                    <td>
                                        <?= empty($api_client['deleted_at']) ? "" : "&#9760;" ?>

                                        <?= $api_client['client_name'] ?>
                                    </td>
                                    <td><?= $api_client['access_key'] ?></td>
                                    <td class="text-end">
                                        <a href="?route=edit_client&id=<?= $api_client['id_client'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <span class="mx-2">|</span>
                                        <?php if (empty($api_client['deleted_at'])) : ?>
                                            <a href="?route=delete_client&id=<?= $api_client['id_client'] ?>" class="btn btn-danger btn-sm">Exclude</a>
                                        <?php else : ?>
                                            <a href="?route=restore_client&id=<?= $api_client['id_client'] ?>" class="btn btn-success btn-sm">Restore</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>