<?php
include_once 'my_function.php';

//$id_user = R::findAll('messeges', ' id_user = ?', array(22) );
echo $my_id=1;


/*

$query = R::findAll('messeges', 'id_user= ?', array($my_id) );

$data = R::exportAll($query);
*/
//$query="SELECT mess, id_user FROM messeges WHERE id_user='" . $my_id . "'ORDER BY id DESC";
//$res = mysqliquery($query);
//return $data = mysqli_fetch_all($res, MYSQLI_ASSOC); //  константа MYSQLI_ASSOC делает массив ассоциативным

//mysqlifetchall($my_id)

$data = R::getAll( 'SELECT DISTINCT id_user FROM messeges' ); // выполнить запрос и получить многомерный массив
//$data = R::exportAll($data);
vardump($data);
/*
foreach ($data as $item) {

    echo "<div class='wrap_id_mess'>";
    echo "<div class=\"line_id_mess\"><div class=\"user_id\">ID:" . $item['id_user'] . "</div><div class=\"item\">Message:" . $item['mess'] . "</div></div>";
    echo "</div>";

}
*/