<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/_helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/session/html_header.php';
?>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Меню</title>
</head>
<body>
<div id="wblock">
    <h1>Меню</h1>
    <?php
    require_once '_helper.php';
    $mysqli = openmysqli();
    $result = $mysqli->query("select * from dishes");
    ?>
    <table cellspacing="0" , style="width:100%">
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
    <br><a href="index.php">На главную</a>
</div>
<?php $mysqli->close(); ?>
</body>
</html>