<?php

/**
 * Accounts CRUD
 */

require_once PROJECT_ROOT . "src/Utils/database.service.php";
$pdo = getPDOConnection();
$handler = new \App\API\Handlers\AccountsHandler($pdo);
$accounts = $handler->get_accounts();

?>

<h1>Accounts</h1>

<div id="addAccountContainer">
    <button class="btn btn-primary">Add Account</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Nickname</th>
            <th>Balance</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($accounts as $account) { ?>
            <tr>
                <th><?= $account['id'] ?></th>
                <th><?= $account['username'] ?></th>
                <th><?= $account['email'] ?></th>
                <th><?= $account['super_user'] ?></th>
                <th><?= $account['created_at'] ?></th>
                <th><?= $account['updated_at'] ?></th>
                <th><button class="btn btn-secondary" value="<?= $account['id']?>" >Edit</button><button class="btn btn-danger" >Delete</button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>