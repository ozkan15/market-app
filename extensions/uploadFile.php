<?php
function uploadFile()
{
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "\\uploads\\";

    foreach ($_FILES as $file) {
        $target_file = $target_dir . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $target_file);
    }
}
