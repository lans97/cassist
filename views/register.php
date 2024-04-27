<form action="" id="registerForm">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="mail">Mail</label>
    <input type="text" name="mail" id="mail">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <label for="userPass2IN">Confirm Password</label>
    <input type="password" id="userPass2IN">
    <label for="super_user">Super User</label>
    <input type="checkbox" name="super_user" id="super_user">
    <button class="btn btn-primary" id="registerBTN">Add</button>
</form>

<script src="<?= PROJECT_ROOT . "public/js/register.js" ?>"></script>