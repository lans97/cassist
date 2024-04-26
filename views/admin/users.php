<?php

/**
 * Users CRUD
 */

require_once PROJECT_ROOT . "src/Utils/database.service.php";
$pdo = getPDOConnection();
$userHandler = new \App\API\Handlers\UsersHandler($pdo);
$users = $userHandler->getUsers();

?>

<h1>Users</h1>

<div id="formContainer">
    <button class="btn btn-primary">Add User</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Mail</th>
            <th>Super User</th>
            <th>Created</th>
            <th>Last Update</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <th><?= $user['id'] ?></th>
                <th><?= $user['username'] ?></th>
                <th><?= $user['mail'] ?></th>
                <th><?= $user['super_user'] ?></th>
                <th><?= $user['created_at'] ?></th>
                <th><?= $user['updated_at'] ?></th>
                <th><button>Edit</button><button>Delete</button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>