<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配列</title>
</head>
<body>
    <h1>配列</h1>
<?php 
// 配列の作成
// $friends = array("はるき","かおる","ひでと",);
$friends = ["はるき","かおる","ひでと"];

// 配列に値を追加
$friends[] = "まさとし";
$friends[10] = "たかのり";

echo $friends[0];
echo "<br>";
echo "<pre>";
var_dump($friends);
echo "<pre>";
?>

</body>
</html>