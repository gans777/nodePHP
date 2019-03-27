<?php ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NodePHP</title>


    <link rel="stylesheet" href="/css/main.css">

</head>
<body>
<div class="menu-block">
<span style="color: black">ОТПРАВКА СООБЩЕНИЙ</span><br>
<a href="index.php"><button class="button-main">Главная</button></a><br>
</div>

<div class="sender-block">
    <input name="user_id" id="user_id" class="input-sender" type="text" placeholder="введите ID"><br>
    <input name="message" id="message" class="input-sender" type="text" placeholder="введите сообщение"><br>
    <button class="button-main">отправить</button>
</div>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function($){
        // Включаем socket.io и отслеживаем все подключения
        var socket = io.connect('http://localhost:3000');


        $("button.button-main").click(function(event){
            event.preventDefault();

            var my_id=$("#user_id").val();
            var z=$("#message").val();

            var form_from=[];
            form_from[1]=my_id; // id_user
            form_from[0]=z; //сообщение (надо было ассоцированный массив сделать)

 if ((my_id=='')||(z=='')) {
     console.log('какое-то поле формы пустое');
     return;
                           }

              console.log('my_id'+form_from[1]);
            console.log('mess'+form_from[0]);


            $.ajax(
                {
                    url : 'ajax/from.php',
                    type:'post',
                    data: {"form_val": form_from} ,
                    success: function (d_data,s) {
                        console.log('сохранено');
                        $("input").val('');

                        socket.emit('send mess',form_from); // отправляет в index.js данные из формы, и далее отправляет  io.sockets.emit('read_now', data); --петля лишняя чтоли?

                        socket.emit('my_id_form',form_from);// отправка в node.js данных из формы для тех. контроля-- можно удалить

                    },
                    error: function(){
                        alert("не получилось");
                    }
                }
            );
            return false;// тут не нужен может быть
        });
    });
</script>
</body>
</html>