<?php
include $_SERVER["DOCUMENT_ROOT"] . "/repository/productRepository.php";
$productRepository = new ProductRepository();
$productRepository->delete($_GET["id"]);
header("Location: /admin/productManagement/list.php");
