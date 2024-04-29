<?php

/**
 * Movements CRUD
 */

require_once PROJECT_ROOT . "src/Utils/database.service.php";
$pdo = getPDOConnection();
$handler = new \App\API\Handlers\MovementsHandler($pdo);
$movements = $handler->get_movements();

?>


<h1>Movements</h1>

<div id="addMovementContainer">
    <button class="btn btn-primary">Add Movement</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Account</th>
            <th>Info</th>
            <th>Category</th>
            <th>Ammount</th>
            <th>Created_At</th>
            <th>Updated_At</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($movements as $movement) { ?>
            <tr>
                <th><?= $movement['id'] ?></th>
                <th><?= $movement['username'] ?></th>
                <th><?= $movement['email'] ?></th>
                <th><?= $movement['super_user'] ?></th>
                <th><?= $movement['created_at'] ?></th>
                <th><?= $movement['updated_at'] ?></th>
                <th><button class="btn btn-secondary" value="<?= $movement['id']?>" >Edit</button><button class="btn btn-danger" >Delete</button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>