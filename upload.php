<?php
    // Каталог, в который мы будем принимать файл:
$uploaddir = '%sprogdir%/domains/System/upload/';
$uploadfile = $uploaddir.basename($_FILES['fl']['name']);

// Копируем файл из каталога для временного хранения файлов:
move_uploaded_file($_FILES['fl']['tmp_name'], $uploadfile)
?>