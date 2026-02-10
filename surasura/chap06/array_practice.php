<!-- http://localhost:8080/surasura/chap06/array_practice.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配列の練習</title>
</head>

<body>
    <h1>配列の練習</h1>
    <?php
    $team_a = [
        1 => [
            "name" => "江原",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "福永",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "村田",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "松永",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_b = [
        1 => [
            "name" => "梅崎",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "大古場",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "小池",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "小倉",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_c = [
        1 => [
            "name" => "兵藤",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "松原",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "松浦",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "永田",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_d = [
        1 => [
            "name" => "岸本",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "環",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "小松",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "横田",
            "role" => "フロントエンドエンジニア"
        ],
    ];

    $room_6c = [
        "A" => $team_a,
        "B" => $team_b,
        "C" => $team_c,
        "D" => $team_d,
    ];
    echo "<pre>";
    var_dump($room_6c);
    echo "<pre>";

 // １．$room_6cのみ使って「岸本」と段落で表示
    echo "<p>" . $room_6c["D"][1]["name"] . "</p>";

// 2.$room_6cのみ使ってBチームに所属する人の名前を箇条書きにして表示

echo "<ul>";
foreach($room_6c["B"] as $name){
echo "<li>" .$name["name"] ."</li>";
}
 echo "</ul>";

//  3.$room_6cのみ使ってAチームメンバーの情報を説明リストで表示
echo "<ul>";
foreach($room_6c["B"] as $name_name => $name){
    // var_dump($name_name);
foreach($room_6c["B"][$name_name] as $content){
echo "<li>" .$content ."</li>";
}
}
 echo "</ul>";

    ?>
// ３．正当例
<dl>
    <?php foreach($room_6c["A"] as $member):
        
        ?>
<dt>    <?php echo $member["name"] ?>    </dt>
<dt>     <?php echo $member["role"] ?>   </dt>
    <?php endforeach; ?>
</dl>
//  4.$room_6cのみ使って全チームの中からプログラマーの人の名前のみを箇条書きで表示
 <?php 

echo "<ul>";
foreach($room_6c as $class_num => $class ){
    // var_dump($class_num);
    foreach($room_6c[$class_num] as $number => $nu_content){
       // var_dump($number);
        if($room_6c[$class_num][$number]["role"] === "プログラマー"){
            echo "<li>" . $room_6c[$class_num][$number]["name"] ."</li>";
        }
    }
}  
echo "</ul>";  
?>




 // 5.$room_6cのみ使って全員をテーブルで表示


<table>
<thead>
    <tr>
<th>チーム名    </th><th>名前        </th><th>役割        </th>
    </tr>
</thead>
<tbody>
<?php 
foreach($room_6c as $class_num => $class ){
    // var_dump($class_num);

    foreach($room_6c[$class_num] as $number => $nu_content){
        // var_dump($number);
            echo "<tr>";
            echo "<td>" . $class_num ."</td>";
            echo "<td>" . $room_6c[$class_num][$number]["name"] ."</td>";
            echo "<td>" . $room_6c[$class_num][$number]["role"] ."</td>";
            echo "</tr>";
        
    }
} 

?>
</tbody>
<style>
    thead{
        background-color: gray;
        border: 1px solid black;
    }
    tbody{ 
        border: 1px solid black;
    }
</style>
</table>


<table>
<thead>
    <tr>
<th>チーム名    </th><th>名前        </th><th>役割        </th>
    </tr>
</thead>
<tbody>
<?php 
foreach($room_6c as $class_num => $class ){
    // var_dump($class_num);

    foreach($room_6c[$class_num] as $number => $nu_content){
        // var_dump($number);
        if($number === 1){
            echo "<tr>";
            echo "<td>" . $class_num ."</td>";
            echo "<td>" . $room_6c[$class_num][$number]["name"] ."</td>";
            echo "<td>" . $room_6c[$class_num][$number]["role"] ."</td>";
            echo "</tr>";
        }
    }
} 

?>
</tbody>
</table>

<!-- 5.正当例 -->
<table>
<thead>
    <tr>
<th>チーム名    </th><th>名前        </th><th>役割        </th>
    </tr>
</thead>
<tbody>
<?php 
foreach($room_6c as $team_name => $team):
foreach($team as $member):
?>
<tr>    
<td><?php  ?></td>
<td><?php  ?></td>
<td><?php  ?></td>

</tr>
<?php endforeach; 
    endforeach;?>
</tbody>
</table>


<?php
// $array = ["5","1","3"];
$array = [5,1,3];
var_dump($array);

echo count($array);

for($i = 0; $i < count($array); $i++)
echo $array[$i] ."<br>";




?>


 

</body>

</html>