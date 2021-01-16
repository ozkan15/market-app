<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">Market</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (isset($_SESSION["userid"])) : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/admin/productManagement/list.php">Product Management</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>
        <?php if ($_SERVER["REQUEST_URI"] === "/index.php" || $_SERVER["REQUEST_URI"] === "/") : ?>
            <div class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 mr-4" onclick="">Search</button>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["userid"])) : ?>
            <form class="form-inline my-2 my-lg-0" method="post" action="/admin/logout.php">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
            </form>
        <?php endif; ?>
    </div>
</nav>