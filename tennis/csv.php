<!-- http://localhost:8080/tennis/csv.php -->
 <?php 
//  $fp = fopen("drinks.csv","r");
//  $line = "";
// while($row = fgetcsv($fp)){
//     echo "<pre>";
//     var_dump($row);
//     echo "<pre>";
// }


// fclose($fp);

// fputcsv CSVへの記入 ここから
$fp = fopen("drinks.csv","r");
$drinkArray = array();
while($row = fgetcsv($fp)){
    $drinkArray[] = $row;
}
fclose($fp);
$drinkArray[4] = ["レモンティー",300,20];
echo "<pre>";
var_dump($drinkArray);
echo "<pre>";

$fp = fopen("drinks.csv","w");
foreach($drinkArray as $row){
    fputcsv($fp,$row);
}
fclose($fp);
// fputcsv CSVへの記入 ここまで


 ?>

 <!DOCTYPE html>
 <html lang="ja">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSVファイルの取り扱い</title>
 </head>
 <body>
    <h1>CSVファイルの取り扱い</h1>
    <!-- drink.csvを読み込みモードで開く -->
     <?php 
     $fp = fopen("drinks.csv","r");
     ?>
    <!-- 1行目のみを変数($table_header)に代入 -->
     <!-- <thead>...</thead>を作る -->
    <table>
        <thead>
            <tr>
      <?php 
      $table_header = fgetcsv($fp);
      var_dump($table_header);
    for($i = 0; $i < count($table_header);$i++){
      echo "<th>".$table_header[$i] ."</th>";
}
      ?>
      </tr>
        </thead>
        <tbody>
            <?php
            while($row = fgetcsv($fp)):
             ?>   
             <?php
             echo "<tr>";
             for($j = 0;$j < count($row);$j++){
             echo "<td>". $row[$j] ."</td>";
             }
             echo "</tr>";
                ?>
             <?php 
             endwhile;
             ?>
             <?php fclose($fp); ?>
        </tbody>
    </table>
 </body>
 </html>