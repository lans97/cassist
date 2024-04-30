<h1>Users</h1>

<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addUserContainer" aria-expanded="false" aria-controls="addUserContainer">New User</button>
<div class="collapse" id="addUserContainer">
    <form id="addUserForm" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" required>
            <div class="invalid-feedback">Username is required</div>
        </div>
        <div class="form-group">
            <label for="email">Mail</label><br>
            <input type="email" name="email" id="email" required>
            <div class="invalid-feedback">Mail is required</div>
        </div>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" required>
            <div class="invalid-feedback">Password is required</div>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label><br>
            <input type="password" id="confirmPassword" required>
            <div class="invalid-feedback">Password confirmation is required</div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="super_user" id="super_user">
            <label for="super_user"> is super user</label>
        </div>
        <br>
        <button type="submit" class="btn btn-secondary">Add User</button>
    </form>
</div>

<table class="table" id="usersTable">
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
    </tbody>
</table>