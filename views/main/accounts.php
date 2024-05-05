<div class="container">
    <h2>My Accounts</h2>

    <div id="myAccounts">
    </div>

    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addAccountContainer"
        aria-expanded="false" aria-controls="addAccountContainer">New Account</button>
    <div class="collapse" id="addAccountContainer">
        <form id="addAccountForm" class="needs-validation" novalidate>
            <input value="<?= $_SESSION['user-id'] ?>" hidden>
            <div class="form-group">
                <label for="nickname">Nickname</label><br>
                <input type="text" name="nickname" id="nickname" required>
                <div class="invalid-feedback">Nickname is required</div>
            </div>
            <div class="form-group">
                <label for="balance">Balance</label><br>
                <input type="number" min="0" step="0.01" name="balance" id="balance" required>
            </div>
            <br>
            <button type="submit" class="btn btn-secondary">Add Account</button>
        </form>
    </div>
</div>