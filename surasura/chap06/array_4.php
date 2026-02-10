<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>制御構文と配列</title>
</head>
<body>
    <h1>制御構文と配列</h1>
<?php 
$drinks = ["コーヒー","ジンジャーエール","ハーブティー",];

// 3次元配列
// $job = ["job" => "環境委員" ]

$class1 = [1 => "はるき",2 => "かおる",3 => "ひでと",];
$class2 = [1 => "ゆきこ",2 => "ゆか",3 => "まなみ",];

$students = ["A" => $class1, "B" => $class2];

echo "<pre>";
var_dump($students);
echo "<pre>";

echo $students["B"][1];

?>
<ul>
    <?php 
    // 配列の要素数を返す関数
    // echo count($drinks);
    for($i = 0; $i < count($drinks); $i++){
        echo "<li>" .$drinks[$i] ."</li>";
    }


    ?>
    <!-- <li>コーヒー</li>
    <li>ジンジャーエール</li>
    <li>ハーブティー</li> -->
</ul>

<ul>
    <?php 
    // $class_1とfor文を使って表示
    for($i = 1; $i <= count($class1); $i++){
        echo "<pre>";
    echo $class1[$i];
        echo "<pre>";
    }
    ?>
    <!-- <li>はるき</li>
    <li>かおる</li>
    <li>ひでと</li> -->
</ul>

<ul>
    <?php 
    //$studentsとfor文を使って表示 
    for($i = 1; $i <= count($students["B"]); $i++){
        echo "<pre>";
    echo $students["B"][$i];
        echo "<pre>";
    }

    ?>
    <!-- <li>ゆきこ</li>
    <li>ゆか</li>
    <li>まなみ</li> -->
</ul>

<ul>
    <?php 
    // 連想配列とforeach
    // foreach(配列 as ループ内変数 => ループ内変数)
    foreach($students as $class_name => $class){
        // echo "<pre>";
        // var_dump($class);
        // echo "<pre>";
        foreach($class as $num => $student){
            echo "<li>" .$class_name . "組：".$num ."番：" .$student . "</li>";
        }
    }

   

    ?>
    <!-- <li>はるき</li>
    <li>かおる</li>
    <li>ひでと</li>
    <li>ゆきこ</li>
    <li>ゆか</li>
    <li>まなみ</li> -->
</ul>



</body>
</html>