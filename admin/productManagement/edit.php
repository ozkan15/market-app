<?php
$error = null;
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/repository/productRepository.php";
include $_SERVER["DOCUMENT_ROOT"] . "/extensions/uploadFile.php";
?>

<?php if (!isset($_SESSION["userid"])) : ?>
    <?php header('Location: /login.php'); ?>
<?php else : ?>
    <?php if (!empty($_POST)) : ?>
        <?php
        $id = $_POST["id"];
        $name = $_POST["name"];
        $image = $_FILES["image"]["name"];
        $updateProduct = new Product($name, $image, $id);
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

            $marketItem->$fieldName = $value["name"];
        }

        $updateProduct->marketItems = $marketItems;
        $productRepository = new ProductRepository();
        $succeded = $productRepository->update($updateProduct);
        if ($succeded) {
            uploadFile();
            header('Location: /admin/productManagement/list.php');
            exit;
        }
        ?>
    <?php else : ?>
        <!DOCTYPE html>
        <?php
        $id = (int)$_GET["id"];
        $productRepository = new ProductRepository();
        $product = $productRepository->getById($id);
        ?>

        <head>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/styles.php" ?>
            <script src="/assets/js/jquery-3.5.1.min.js"></script>
            <script src="/assets/js/addNewTableRow.js"></script>
        </head>

        <body>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/navbar.php" ?>
            <div class="container-fluid" style="width: 60%;">
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <input name="id" value="<?php echo $product->id; ?>" hidden />
                    <div class="form-outline mb-4">
                        Name <input type="text" name="name" value="<?php echo $product->name; ?>" class="form-control" placeholder="Name" required />
                    </div>
                    <div class="form-outline mb-4">
                        Update Image <input type="file" name="image" class="form-control" placeholder="Image" />
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
                                <th scope="col">Update Image</th>
                                <th scope="col">Link</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($product->marketItems as $key => $value) : ?>
                                <tr>
                                    <td><input type="text" placeholder="Name" value="<?php echo $value->name; ?>" name="name-<?php echo $key; ?>" required /></td>
                                    <td><input type="number" placeholder="Price" value="<?php echo $value->price; ?>" name="price-<?php echo $key; ?>" required /></td>
                                    <td><input type="text" placeholder="Market" value="<?php echo $value->market; ?>" name="market-<?php echo $key; ?>" required /></td>
                                    <td>
                                        <input type="text" value="<?php echo $value->image; ?>" name="preimage-<?php echo $key; ?>" hidden />
                                        <input type="file" placeholder="Image" value="<?php echo $value->image; ?>" name="image-<?php echo $key; ?>" />
                                    </td>
                                    <td><input type="text" placeholder="Link" value="<?php echo $value->link; ?>" name="link-<?php echo $key; ?>" required /></td>
                                    <td><a href="#" onclick="this.parentElement.parentElement.remove();"><i class="fas fa-trash"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>

        </body>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/shared/scripts.php" ?>

        </html>
    <?php endif; ?>
<?php endif; ?>