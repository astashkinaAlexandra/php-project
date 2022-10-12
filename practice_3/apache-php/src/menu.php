<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
    <link rel="stylesheet" href="../css/table.css" type="text/css"/>
</head>
<body>
<div id="wblock">
    <h1>Меню</h1>
    <?php
    require_once '_helper.php';
    $mysqli = openmysqli();
    $mysqli->set_charset('utf8mb4');
    $result = $mysqli->query("select * from " . 'dishes');
    ?>
    <table cellspacing="0">
        <tr>
            <th>Блюдо</th>
            <th>Описание</th>
            <th>Цена</th>
        </tr>
        <?php if ($result->num_rows > 0) foreach ($result as $dish) {
            echo "
            <tr>
                <td>" . $dish['title'] . "</td>
                <td>" . $dish['description'] . "</td>
                <td>" . $dish['cost'] . " руб</td>
            </tr>
            ";
        }
        else echo ''; ?>
    </table>
    <br><a href="../dynamic/about.php">На главную</a>
</div>
<?php $mysqli->close(); ?>
</body>
</html>