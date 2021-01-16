<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/repository/productRepository.php';

$repo = new ProductRepository();
$products = $repo->getAll();
?>
<!DOCTYPE html>

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/styles.php" ?>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/navbar.php" ?>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="card" style="width: 18rem;">
                    <img height="60%" style="object-fit: cover;"  class="card-img-top" src="<?php echo $product->image !== "" ? ("uploads/" . $product->image) : "assets/images/no-content.png" ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name; ?></h5>
                        <a href="product/details.php?id=<?php echo $product->id ?>" class="btn btn-primary">Show Prices</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/scripts.php" ?>

</html>