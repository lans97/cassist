<div class="container">
    <h2>My Categories</h2>

    <input id="user-id" value="<?= $_SESSION['user-id'] ?>" hidden>

<div id="myCategories">

</div>
<table class="table" id="categoriesTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>

<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addCategoryContainer"
    aria-expanded="false" aria-controls="addUserContainer">New Category</button>
<div class="collapse" id="addCategoryContainer">
    <form id="addCategoryForm" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" required>
            <div class="invalid-feedback">Name is required</div>
        </div>
        <div class="form-group">
            <label for="color">Color</label><br>
            <input type="color" class="form-control form-control-color" name="color" id="color">
        </div>
        <br>
        <button type="submit" class="btn btn-secondary">Add Category</button>
    </form>
</div>
</div>

<script src="/js/main/categories.js"></script>