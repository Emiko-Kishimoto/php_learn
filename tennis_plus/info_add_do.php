<?php
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
        // ユニーク...一意（重複しない）
            $id = uniqid();
        // CSVファイルに書き込むための配列を作成
            $data_array = [$id,$title,$date,$author,$body];
        // TODO:データの書き込み（ファイルオープン、書き込み、クローズ）
            $filename = "info/info.csv";
            $fp = fopen($filename,"a");
            if($fp){
                fputcsv($fp,$data_array); 
                fclose($fp);
            }
            
    }
}
// TODO: リダイレクト
header("location:info_add.php");
exit();

?>