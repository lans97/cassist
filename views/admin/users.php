<?php

/**
 * Users CRUD
 */

require_once PROJECT_ROOT . "src/Utils/database.service.php";
$pdo = getPDOConnection();
$handler = new \App\API\Handlers\UsersHandler($pdo);
$users = $handler->get_users();

?>

<h1>Users</h1>

<div id="addUserContainer">
    <button class="btn btn-primary" id="addUser" >Add User</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>EMail</th>
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
                <th><?= $user['email'] ?></th>
                <th><?= $user['super_user'] ?></th>
                <th><?= $user['created_at'] ?></th>
                <th><?= $user['updated_at'] ?></th>
                <th><button class="btn btn-secondary" >Edit</button><button class="btn btn-danger" >Delete</button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>