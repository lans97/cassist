<form id="registerForm" class="needs-validation" novalidate>
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
    <button type="submit" class="btn btn-secondary">Register</button>
</form>