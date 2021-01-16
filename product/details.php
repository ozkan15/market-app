<?php session_start(); ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/repository/productRepository.php';

$repo = new ProductRepository();
$product = $repo->getById($_GET["id"]);
?>
<!DOCTYPE html>

<head>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/styles.php" ?>
</head>

<body>
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/navbar.php" ?>
    <div style="display: flex;justify-content:center;">
        <h2><?php echo $product->name ?></h2>
    </div>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($product->marketItems as $item) : ?>
                <div class="card" style="width: 18rem;">
                    <img height="40%" style="object-fit: cover;" class="card-img-top" src="<?php echo $item->image !== "" ? ("/uploads/" . $item->image) : "/assets/images/no-content.png" ?>" alt="Card image cap">
                    <div class="card-body">
                        Name: <h5 class="card-title"><?php echo $item->name; ?></h5>
                        Price: <h5 class="card-title"><?php echo $item->price; ?></h5>
                        Market: <h5 class="card-title"><?php echo $item->market; ?></h5>
                        <a href="<?php echo $item->link; ?>" class="btn btn-primary">Go to Link</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/scripts.php" ?>

</html>