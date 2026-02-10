<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>連想配列</title>
</head>
<body>
    <h1>連想配列</h1>
<?php 
$class1 = [1 => "はるき",2 => "かおる",3 => "ひでと",];
$class2 = [1 => "ゆきこ",2 => "ゆか",3 => "まなみ",];

$student = ["A" => $class1, "B" => $class2];

echo "<pre>";
var_dump($student);
echo "<pre>";

echo $student["B"][1];

?>

</body>
</html>