<?php
// ここに出題APIを実装します
// 1. DB接続
// 2. データ取得 (SELECT)
// 3. JSON出力

require_once '../../inc/functions.php';

try{
    $db = db_connect();
    $sql = 'SELECT id,question_text,choice1,choice2,choice3,choice4 FROM questions';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($questions);
}catch(PDOException $e){
    // エラー文をログファイルに書き込み
    echo $e->getMessage();
}

?>