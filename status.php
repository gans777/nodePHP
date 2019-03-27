<?php
include_once 'my_function.php';
$data = R::getAll( 'SELECT DISTINCT id_user FROM messeges' );// id всех пользователей

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NodePHP</title>


    <link rel="stylesheet" href="/css/main.css?rnd=0857">

</head>
<body>
<div class="menu-block">
<span style="color: black">СТАТУС ОКОН</span><br>
<a href="index.php"><button class="button-main">Главная</button></a><br>
</div>
<div class="status-block">

    <?php
    foreach ($data as $item) {
       echo "<div class='wrap_id_user'><span>ID окна: </span><span id='id_user_".$item['id_user']."'>".$item['id_user']."<span> offline</span></span></div>";
    }
    ?>

  </div>
<!-- Подключаем jQuery, а также Socket.io -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>

    $(document).ready(function($){

        var socket = io.connect('http://localhost:3000');

        socket.emit('id_status_reload',' ');

        socket.on('id_connected_to', function(data){


            var zx="#id_user_"+data;


           $(zx).html(data+'<span> online</span>');


        });
        socket.on('id_connected_to_off', function(data){
            //$(".status-block").append('отключился id='+data);
            var zx="#id_user_"+data;
            $(zx).html(data+'<span> offline</span>');
        });
    });
</script>
</body>
</html>