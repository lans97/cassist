<?php

/**
 * Categories CRUD
 */

require_once PROJECT_ROOT . "src/Utils/database.service.php";
$pdo = getPDOConnection();
$handler = new \App\API\Handlers\CategoriesHandler($pdo);
$categories = $handler->get_categories();

?>

<h1>Category Categories</h1>

<div id="addCategoryContainer">
    <button class="btn btn-primary">Add Category</button>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>User</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($categories as $category) { ?>
            <tr>
                <th><?= $category['id'] ?></th>
                <th><?= $category['username'] ?></th>
                <th><?= $category['email'] ?></th>
                <th><?= $category['super_user'] ?></th>
                <th><?= $category['created_at'] ?></th>
                <th><?= $category['updated_at'] ?></th>
                <th><button class="btn btn-secondary" value="<?= $category['id']?>" >Edit</button><button class="btn btn-danger" >Delete</button></th>
            </tr>
        <?php } ?>
    </tbody>
</table>