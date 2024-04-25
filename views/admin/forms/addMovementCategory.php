<?php

/**
 * Add movement category form
 */

namespace App\Views\Admin\Forms;

require_once PROJECT_ROOT . "src/utils/database.service.php";
$pdo = getPDOConnection();
$userHandler = new \App\API\Handlers\UsersHandler($pdo);
$users = $userHandler->getUsers();

?>

<form action="/addMovementCategory" method="POST">
    <label for="mCatIdIN">ID</label>
    <input type="text" id="mCatIdIN">
    <label for="idCatUserSEL">User</label>
    <select name="users" id="mCatUserSEL">
        <option value="" disabled selected>Select a user</option>
        <?php foreach ($users as $user) { ?>
            <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
        <?php } ?>
    </select>
    <button class="btn btn-primary" id="addMCatBTN">Add</button>
</form>