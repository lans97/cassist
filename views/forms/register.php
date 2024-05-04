<form id="registerForm" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="username">Username</label><br>
        <input type="text" class="form-control" name="username" id="username" required>
        <div class="invalid-feedback">Username is required</div>
    </div>
    <div class="form-group">
        <label for="email">Mail</label><br>
        <input type="email" class="form-control" name="email" id="email" required>
        <div class="invalid-feedback">Mail is required</div>
    </div>
    <div class="form-group">
        <label for="password">Password</label><br>
        <input type="password" class="form-control" name="password" id="password" required>
        <div class="invalid-feedback">Password is required</div>
    </div>
    <div class="form-group">
        <label for="confirmPassword">Confirm Password</label><br>
        <input type="password" class="form-control" id="confirmPassword" required>
        <div class="invalid-feedback">Password confirmation is required</div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<script src="js/register.js"></script>