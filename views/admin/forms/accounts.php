<h1>Accounts</h1>

<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addAccountContainer" aria-expanded="false" aria-controls="addUserContainer">New User</button>
<div class="collapse" id="addAccountContainer">
    <form id="addAccountForm" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="user">User</label><br>
            <select name="user" id="user" required>
                <option value="" selected disabled>Select a user</option>
                <!-- Insert options in JS -->
            </select>
            <div class="invalid-feedback">Please select a user</div>
        </div>
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

<table class="table" id="accountsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Nickname</th>
            <th>Balance</th>
            <th>Created</th>
            <th>Last Update</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>