<?php
include_once 'my_function.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NodePHP</title>


    <link rel="stylesheet" href="/css/main.css?rnd=123">

</head>
<body>
<div class="menu-block">
<span style="color: black">ПРИЕМ СООБЩЕНИЙ</span><br>
<a href="index.php"><button class="button-main">Главная</button></a><br>
</div>

<div class="reception-block">

    <div style="background: aqua">


        <?php

        if (isset($_GET["id"])) {echo '<span>Мой ID:</span><span id="this_id" >'.$_GET["id"].'</span>';
            $my_id=$_GET["id"];
        } else {
            $my_id='гость';
            echo "<span>$my_id</span>";
        }

        ?>
    </div>
    <div class="wrap_all_mess">
<?php
    read_all($my_id);
    ?>
    </div>

</div>
<!-- Подключаем jQuery, а также Socket.io -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>

    $(document).ready(function($){

        var socket = io.connect('http://localhost:3000');

        var this_id=$('#this_id').text(); // определяет id
          // if (this_id=='гость') console.log('это гость');

           socket.emit('id_connected',this_id);  // в index.js сообщение о id пользователя

        /*   // это для сеессии вызывает
        $('body').append("<img class='nodejs' src='http://localhost:3000/glob'>"); // для определения сессии надо зайти на эту страницу (может роботом на curl на php лучше это сделать???)
        socket.on('my_socket',function (this_number_socket) {  //номер соединения сокета слушает

            //$('#my_id').append(this_number_socket);
        });
        */

        socket.on('read_now',function(data){  //  data - это массив из формы, где data[1]-id , data[0]-сообщение

            var this_id=$('#this_id').text(); // считывает id пользователя из html страницы

            console.log("id user="+this_id);

            var url_read_all='ajax/read_all.php?id='+this_id; // урл программы, где считывает данные из mysql для пользователя id
            console.log("вызов ajax="+url_read_all);
            console.log('id from form'+data[1]);


            if (data[1]==this_id) {
                $(".wrap_all_mess").empty();
                $.ajax({
                    type: "POST",
                    url: url_read_all,
                    //cache: false,
                    success: function (data) {
                       // console.log(data);
                        //alert(data);
                        $(".wrap_all_mess").prepend(data);
                    }
                });// end $.ajax


            }

        });

    });// end ready




</script>
</body>
</html>