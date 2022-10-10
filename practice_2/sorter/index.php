<html lang="en">
<head>
    <title>Sorter page</title>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
</head>
<body>
<?php

//Сортировка вставками
include "insert_sort.php";

//Считываем значения, переданные после параметра запроса array
if (isset($_GET['array'])) {
    //Преобразуем переданный массив в строку
    $array_str = $_GET['array'];
    //Преобразуем строку в массив строк по разделителю
    $array = explode(",", $array_str);
    //Сортируем массив
    $new_array = insertSort($array);
    echo 'Sorted array: ' . implode(',', $new_array);
} else echo "Empty array!";
?>
</body>
</html>