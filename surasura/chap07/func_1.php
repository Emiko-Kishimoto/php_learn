<!-- http://localhost:8080/surasura/chap07/func_1.php -->
 <!DOCTYPE html>
 <html lang="ja">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自作関数</title>
 </head>
 <!-- <body>
    <?php  require_once "./chap07/header.php"; ?> -->
    <?php
   
   include "./chap07/functions.php";
    echo get_price(300);
    echo "<br>";
    get_price();
    ?>
 </body>
 </html>