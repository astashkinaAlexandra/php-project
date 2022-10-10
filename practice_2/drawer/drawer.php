<?php

//Определяем, была ли установлена переменная значением, отличным от null
if (isset($_GET['num'])) {

    //Определяем, является ли переменная числом или числовой строкой
    if (!is_numeric($_GET['num'])) {
        echo 'Введите число';
    } else {
        //Явное преобразование типа
        $number = (int)$_GET['num'];

        //Инициализируем данные
        $Shape = $number & 3;
        $Color = $number >> 1 & 3;
        $cx = $number >> 2 & 3;
        $cy = $number >> 3 & 3;

        //Выводим эти данные
        echo '<div>' . 'Форма фигуры: ' . $Shape,
            '<br>Цвет фигуры: ' . $Color,
            '<br>Координата по x: ' . $cx,
            '<br>Координата по y: ' . $cy . '</div>';

        //Минимальные значения фигуры при 0 размерах
        $cx = 100 + $cx * 100;
        $cy = 100 + $cy * 100;

        //Цвет
        switch ($Color) {
            case 0:
                $color = "yellow";
                break;
            case 1:
                $color = "red";
                break;
            case 2:
                $color = "blue";
                break;
            case 3:
                $color = "green";
                break;
        }

        //Тег <svg> определяет контейнер для графики SVG
        $svg_code = '<svg width = "' . $cx . '" height= "' . $cy . '">';

        switch ($Shape) {
            //Круг
            case 0:
                $cx > $cy ? $cx = $cy : $cy = $cx;
                $svg_code .= '<circle cx="' . $cx / 2 . '" cy ="' . $cy / 2 . '" r="' . $cx / 2 . '" fill = "' . $color . '" />';
                break;
            //Эллипс
            case 1:
                $svg_code .= '<ellipse cx="' . $cx / 2 . '" cy ="' . $cy / 2 . '" rx="' . $cx / 2 . '" ry="' . $cy / 2 . '" fill = "' . $color . '" />';
                break;
            //Прямоугольник
            case 2:
                $svg_code .= '<rect x="0" y="0" width="' . $cx . '" height="' . $cy . '" fill="' . $color . '" />';
                break;
            //Квадрат
            case 3:
                $cx > $cy ? $cx = $cy : $cy = $cx;
                $svg_code .= '<rect x="0" y="0" width="' . $cx . '" height="' . $cy . '" fill="' . $color . '" />';
                break;
        }

        //Закрывающий тег
        $svg_code .= '</svg>';
        echo $svg_code;
    }
}
