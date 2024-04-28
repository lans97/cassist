<form id="registerForm">
    <label for="username">Username</label><br>
    <input type="text" name="username" id="username"><br>
    <span id="usernameError" class="error"></span><br>
    <label for="mail">Mail</label><br>
    <input type="text" name="mail" id="mail"><br>
    <span id="mailError" class="error"></span><br>
    <label for="password">Password</label><br>
    <input type="password" name="password" id="password"><br>
    <span id="passwordError" class="error"></span><br>
    <label for="confirmPassword">Confirm Password</label><br>
    <input type="password" id="confirmPassword"><br>
    <span id="confirmPasswordError" class="error"></span><br>
    <input type="checkbox" name="super_user" id="super_user">
    <label for="super_user">Super User</label><br>
    <button class="btn btn-primary" id="registerBTN">Register</button><br>
</form>

<script src="js/register.js"></script>