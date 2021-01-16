<?php
include $_SERVER['DOCUMENT_ROOT'] . '/repository/productRepository.php';
$productRepository = new ProductRepository();
$products = $productRepository->getAll(); 
$myJSON = json_encode($products);

echo $myJSON;