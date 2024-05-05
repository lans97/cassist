<div class="container">
    <h2>Welcome <?= $_SESSION['username']; ?></h2>
    <input id="user-id" value="<?= $_SESSION['user-id'] ?>" hidden>
    <div class="row justify-content-center">
        <div class="col-md-5 col0-xs-1" id="mainContainer">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5 col0-xs-1">
            <div class="text-center">
                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#addMovementContainer" aria-expanded="false"
                    aria-controls="addMovementContainer">New
                    Movement</button>
            </div>
            <div class="collapse justify-content-center" id="addMovementContainer">
                <form id="addMovementForm" class="needs-validation" novalidate>
                    <div class="form-group mb-3">
                        <label class="form-label" for="account">Account</label><br>
                        <select class="form-select" name="account" id="account" required>
                            <option value="" selected disabled>Select an account</option>
                            <!-- Insert options in JS -->
                        </select>
                        <div class="invalid-feedback">Please select an account</div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="category">Category</label><br>
                        <select class="form-select" name="category" id="category" required>
                            <option value="" selected disabled>Select a category</option>
                            <!-- Insert options in JS -->
                        </select>
                        <div class="invalid-feedback">Please select a category</div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="information">Information</label><br>
                        <textarea class="form-control" name="information" id="information"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="ammount">Ammount</label><br>
                        <input class="form-control" type="number" min="0" step="0.01" name="ammount" id="ammount"
                            required>
                        <div class="invalid-feedback">Ammount can't be 0</div>
                        <select class="form-select" name="in_or_out" id="movement_sign">
                            <option value="" selected disabled>Add/Remove Funds</option>
                            <option value="plus">Add Funds (Deposit)</option>
                            <option value="minus">Remove Funds (Withdrawal)</option>
                        </select>
                        <div class="invalid-feedback">Please select an option</div>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary">Add Movements</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="/js/main/home.js"></script>