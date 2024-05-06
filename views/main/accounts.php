<div class="container">
    <h2>My Accounts</h2>

    <input id="user-id" value="<?= $_SESSION['user-id'] ?>" hidden>

    <div id="myAccounts">

        <table class="table" id="accountsTable">
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Balance</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
    </div>

    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addAccountContainer"
        aria-expanded="false" aria-controls="addAccountContainer">New Account</button>
    <div class="collapse" id="addAccountContainer">
        <form id="addAccountForm" class="needs-validation" novalidate>
            <input value="<?= $_SESSION['user-id'] ?>" hidden>
            <div class="form-group">
                <label class="form-label" for="nickname">Nickname</label><br>
                <input class="form-control" type="text" name="nickname" id="nickname" required>
                <div class="invalid-feedback">Nickname is required</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="balance">Balance</label><br>
                <input class="form-control" type="number" min="0" step="0.01" name="balance" id="balance" required>
            </div>
            <br>
            <button type="submit" class="btn btn-secondary">Add Account</button>
        </form>
    </div>
</div>


<script src="/js/main/accounts.js"></script>