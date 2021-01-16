<?php $error = null; ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION["userid"])) : ?>
    <?php header('Location: /login.php'); ?>
<?php else : ?>
    <?php if (!empty($_POST)) : ?>
        <?php
        include $_SERVER["DOCUMENT_ROOT"] . "/repository/productRepository.php";
        include $_SERVER["DOCUMENT_ROOT"] . "/extensions/uploadFile.php";
        $name = $_POST["name"];
        $image = $_FILES["image"]["name"];
        $newProduct = new Product($name, $image);
        $marketItems = array();
        foreach ($_POST as $key => $value) {
            if (strpos($key, "-") === false) continue;
            $fieldArray = explode("-", $key);
            $fieldName = $fieldArray[0];
            $fieldIndex = (int) $fieldArray[1];

            if (!isset($marketItems[$fieldIndex])) {
                $marketItem = new ProductSample();
                array_push($marketItems, $marketItem);
            } else
                $marketItem = $marketItems[$fieldIndex];

            $marketItem->$fieldName = $value;
        }

        foreach ($_FILES as $key => $value) {
            if (strpos($key, "-") === false) continue;
            $fieldArray = explode("-", $key);
            $fieldName = $fieldArray[0];

            $marketItem->$fieldName = $value;
        }

        $newProduct->marketItems = $marketItems;
        $productRepository = new ProductRepository();
        $id = $productRepository->add($newProduct);
        if ($id !== 0) {
            uploadFile();
            header('Location: /admin/productManagement/list.php');
            exit;
        }
        ?>
    <?php endif; ?>

    <!DOCTYPE html>

    <head>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/styles.php" ?>
        <script src="/assets/js/jquery-3.5.1.min.js"></script>
        <script src="/assets/js/addNewTableRow.js"></script>
    </head>

    <body>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/navbar.php" ?>
        <div class="container-fluid" style="width: 60%;">
            <form action="create.php" method="post" enctype="multipart/form-data">
                <div class="mb-2 mt-2"><b>Create Product</b></div>
                <div class="form-outline mb-4">
                    Name <input type="text" name="name" class="form-control" placeholder="Name" required />
                </div>
                <div class="form-outline mb-4">
                    Image <input type="file" name="image" class="form-control" placeholder="Image" />
                </div>
                <div style="color:red;" class="mb-2"><?php echo $error ?></div>
                <div class="mb-2 mt-2">Markets</div>
                <a href="#" onclick="addNewTableRow(document.getElementById('markets-table'))"><i class="fas fa-plus"></i>Add New Market Item</a>
                <table class="table" id="markets-table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Market</th>
                            <th scope="col">Image</th>
                            <th scope="col">Link</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
        </div>

    </body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/scripts.php" ?>

    </html>
<?php endif; ?>