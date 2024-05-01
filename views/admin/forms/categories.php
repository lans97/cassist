<h1>Categories</h1>

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
        <div class="form-group">
            <label for="user">User</label><br>
            <select name="user" id="user" required>
                <option value="" selected disabled>Select a user</option>
                <!-- Insert options in JS -->
            </select>
            <div class="invalid-feedback">Please select an account</div>
        </div>
        <br>
        <button type="submit" class="btn btn-secondary">Add Category</button>
    </form>
</div>

<table class="table" id="categoriesTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Color</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>