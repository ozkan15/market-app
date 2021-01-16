<?php session_start(); ?>
<?php if (!isset($_SESSION["userid"])) : ?>
    <?php header('Location: /login.php'); ?>
<?php else : ?>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/repository/productRepository.php";
    $productRepository = new ProductRepository();
    $products = $productRepository->getAll();
    ?>

    <!DOCTYPE html>

    <head>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/styles.php" ?>
    </head>

    <body>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/navbar.php" ?>
        <div class="container-fluid" style="width: 60%;">
            <div class="mb-2 mt-2">List of Products</div>
            <a href="/admin/productManagement/create.php"><i class="fas fa-plus"></i> New</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?php echo $product->name ?></td>
                            <td>
                                <a href=<?php echo "/admin/productManagement/edit.php?id=$product->id"; ?>><i class="fas fa-edit"></i></a>
                                <a href=<?php echo "/admin/productManagement/delete.php?id=$product->id"; ?>><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/scripts.php" ?>

    </html>
<?php endif; ?>