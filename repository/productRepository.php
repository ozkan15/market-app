<?php
include $_SERVER['DOCUMENT_ROOT'] . '/db/connectDb.php';
include $_SERVER['DOCUMENT_ROOT'] . '/domain/product.php';
include $_SERVER['DOCUMENT_ROOT'] . '/domain/productSample.php';
class ProductRepository
{
    function add(Product $product): int
    {
        $conn = connectToDb();
        if ($conn) {
            $sql = "INSERT INTO Product (name, image) VALUES ('$product->name', '$product->image')";
            if ($conn->exec($sql) == false) return 0;
            $sql = "SELECT LAST_INSERT_ID() as id;";
            $statement =  $conn->query($sql);
            $id = (int) $statement->fetch(PDO::FETCH_ASSOC)["id"];
            if (!empty($product->marketItems)) {
                $sql = "";
                foreach ($product->marketItems as $marketItem) {
                    $price = (int) $marketItem->price;
                    $sql = $sql . "INSERT INTO ProductSample (name, price, market, image, link, productId) 
                    VALUES ('$marketItem->name', $price, '$marketItem->market', '$marketItem->image', '$marketItem->link', $id);";
                }
                $conn->exec($sql);
            }

            return $id;
        } else return 0;
    }

    function getAll()
    {
        $conn = connectToDb();
        if ($conn) {
            $sql = "SELECT id, name, image FROM product";
            $statement =  $conn->query($sql);
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            $productArray = array();
            foreach ($products as $product) {
                array_push($productArray, new Product($product["name"], $product["image"], $product["id"]));
            }
            return $productArray;
        } else return array();
    }

    function getById(int $id): ?Product
    {
        $conn = connectToDb();
        if ($conn) {
            $sql = "SELECT product.id, product.name as pname, product.image as pimage, productSample.productId,
            productSample.name, productSample.price, productSample.market, productSample.image, productSample.link
            FROM product LEFT JOIN productSample ON product.id = productSample.productId
            WHERE product.id = $id;";
            $statement =  $conn->query($sql);
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (empty($rows)) return null;
            $product = new Product($rows[0]["pname"], $rows[0]["pimage"], $rows[0]["id"], array());
            foreach ($rows as $row) {
                if (empty($row["productId"])) continue;
                $marketItem = new ProductSample();
                $marketItem->name = $row["name"];
                $marketItem->price = $row["price"];
                $marketItem->market = $row["market"];
                $marketItem->image = $row["image"];
                $marketItem->link = $row["link"];
                array_push($product->marketItems, $marketItem);
            }

            return $product;
        } else return null;
    }

    function update(Product $product): bool
    {
        $conn = connectToDb();

        if ($product->image !== "")
            $sql = "UPDATE product SET name = '$product->name', image = '$product->image' WHERE id = $product->id;
        DELETE FROM productsample WHERE productId = $product->id;";
        else
            $sql = "UPDATE product SET name = '$product->name' WHERE id = $product->id;
        DELETE FROM productsample WHERE productId = $product->id;";

        $conn->exec($sql);

        if (!empty($product->marketItems)) {
            $sql = "";
            foreach ($product->marketItems as $marketItem) {
                $price = (int) $marketItem->price;
                if ($marketItem->image !== "")
                    $sql = $sql . "INSERT INTO ProductSample (name, price, market, image, link, productId) 
                VALUES ('$marketItem->name', $price, '$marketItem->market', '$marketItem->image', '$marketItem->link', $product->id);";
                else
                    $sql = $sql . "INSERT INTO ProductSample (name, price, market, image, link, productId) 
                VALUES ('$marketItem->name', $price, '$marketItem->market', '$marketItem->preimage', '$marketItem->link', $product->id);";
            }
            $conn->exec($sql);
        }

        return true;
    }

    function delete(int $id): void
    {
        $conn = connectToDb();
        $sql = "DELETE FROM productsample WHERE productId = $id;DELETE FROM product WHERE id = $id;";
        $conn->exec($sql);
    }
}
