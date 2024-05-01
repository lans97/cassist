<h1>Movements</h1>

<button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#addMovementContainer" aria-expanded="false" aria-controls="addUserContainer">New Movement</button>
<div class="collapse" id="addMovementContainer">
    <form id="addMovementForm" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="account">Account</label><br>
            <select name="account" id="account" required>
                <option value="" selected disabled>Select an account</option>
                <!-- Insert options in JS -->
            </select>
            <div class="invalid-feedback">Please select an account</div>
        </div>
        <div class="form-group">
            <label for="category">Category</label><br>
            <select name="category" id="category" required>
                <option value="" selected disabled>Select a category</option>
                <!-- Insert options in JS -->
            </select>
            <div class="invalid-feedback">Please select a category</div>
        </div>
        <div class="form-group">
            <label for="information">Information</label><br>
            <textarea name="information" id="information" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="ammount">Ammount</label><br>
            <input type="number" name="ammount" id="ammount" required>
            <div class="invalid-feedback">Ammount can't be 0</div>
        </div>
        <br>
        <button type="submit" class="btn btn-secondary">Add Movements</button>
    </form>
</div>

<table class="table" id="movementsTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Account</th>
            <th>Category</th>
            <th>Info</th>
            <th>Ammount</th>
            <th>Created</th>
            <th>Last Update</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>