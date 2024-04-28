<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24"
        class="d-inline-block align-text-top">
      Bootstrap
    </a>
  </div>
</nav>

<?php if (isset($_SESSION['token'])) { ?>
  <form action="/admin/logout">
    <button type="submit" class="btn btn-secondary">Logout</button>
  </form>
<?php } ?>