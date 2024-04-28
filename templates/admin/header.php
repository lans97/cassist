<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            Cassist Admin
        </a>
    </div>
</nav>

<?php if (isset($_SESSION['token'])) { ?>
    <form action="/admin/logout">
        <button type="submit" class="btn btn-secondary">Logout</button>
    </form>
<?php } ?>