<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Login</h2>
            <form id="loginForm" action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>