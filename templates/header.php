<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Cassist</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <?php if (!isset($_SESSION['token'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/accounts">Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Categories</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#"></a>
                    </li>
                <?php if (!isset($_SESSION['token'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>