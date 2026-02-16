<!-- http://localhost:8080/php_learn/tennis_plus/info_add_do.php -->
<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
echo "<pre>";
var_dump($_POST);
echo "<pre>";

if(!empty($_POST)){
    // POST送信された時
    if(!empty($_POST["title"]) &&  !empty($_POST["author"]) && !empty($_POST["body"])){
        // 必須項目が空ではないとき
            $title = $_POST["title"];
            $author = $_POST["author"];
            $body = $_POST["body"];
        // 日付が空文字だったら当日のデータ、空文字じゃなかったら送信されたデータを代入
            $date = empty($_POST["date"])? date("Y-m-d"):$_POST["date"];
        // DBに接続
            try{
                $db = db_connect();
                // infoテーブルに1行挿入するSQL
                $sql = 'INSERT INTO info (author,title,body,date) VALUES (:author,:title,:body,:date)';
                $stmt = $db->prepare($sql);
                //  プレースホルダ
                $stmt->bindParam(':author',$author,PDO::PARAM_INT);
                $stmt->bindParam(':title',$title,PDO::PARAM_INT);
                $stmt->bindParam(':body',$body,PDO::PARAM_INT);
                $stmt->bindParam(':date',$date,PDO::PARAM_INT);
                $stmt->execute();

                // トップページへ画面遷移
                header('location:index.php');
                exit();
            }catch(PDOException $e){
                exit('エラー：'.$e->getMessage());

            }
            
    }
}
// TODO: リダイレクト
header("location:info_add.php");
exit();

?>