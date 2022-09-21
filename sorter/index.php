<html lang="en">
<head>
    <title>Sorter page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<?php
//Сортировка вставками
function insertSort(array $arr) {
    $count = count($arr);
    if ($count <= 1) {
        return $arr;
    }

    for ($i = 1; $i < $count; $i++) {
        $cur_val = $arr[$i];
        $j = $i - 1;

        while (isset($arr[$j]) && $arr[$j] > $cur_val) {
            $arr[$j + 1] = $arr[$j];
            $arr[$j] = $cur_val;
            $j--;
        }
    }

    return $arr;
}

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