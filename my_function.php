<?php
include_once 'config.php'; // подключение  RedBean

function vardump($input) // техническая функция для удобного просмотра массивов
{
    if(!$input){return false;}
    if(gettype($input)=="boolean")
    {
        echo var_dump($input);
    }
    else
    {
        echo "<pre>".print_r($input,true)."</pre>";
    }
}

function from_sending($from_container){    //данные из формы

    $new_mess = R::dispense('messeges');
    $new_mess->mess = $from_container[0]; // сообщение
    $new_mess->id_user = $from_container[1];// id юзера
    R::store($new_mess);
}

function read_all() {

    $my_id = $_GET["id"];

    $data = R::findAll('messeges', 'id_user= ? ORDER BY id DESC', array($my_id) );

    $data = R::exportAll($data);




    foreach ($data as $item) {

        echo "<div class='wrap_id_mess'>";
        echo "<div class=\"line_id_mess\"><div class=\"user_id\">ID:" . $item['id_user'] . "</div><div class=\"item\">Message:" . $item['mess'] . "</div></div>";
        echo "</div>";

    }
}


