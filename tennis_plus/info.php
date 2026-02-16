<!-- http://localhost:8080/php_learn/tennis_plus/info.php?id=698d60d89af56 -->
<?php
// TODO: ID取得とバリデーション
// $id = $_GET["id"];
// $target = array();
// $filename = "info/info.csv";
// $fp = fopen($filename,"r");

// if($fp){
//   while($row = fgetcsv($fp)){
//     if($row[0] === $id){
//     // $target = [$row[0],$row[1],$row[2],$row[3],$row[4]];
//     $target = $row;
//     break;
//     }
//   }
//   fclose($fp);
// }else{
//   echo "ファイルが開けませんでした。";
// }

// TODO: CSV読み込みと記事検索

require_once __DIR__ . '/func/functions.php';
$id = $_GET['id'];
try{
// インクリメント作成・接続
$db = db_connect();
$sql = 'SELECT id,author,title,date,body FROM info WHERE id= :id';
$stmt = $db->prepare($sql);
$stmt->bindParam(':id',$id,PDO::PARAM_INT);

$stmt->execute();

// 結果セットを連想配列の形で取得
$result = $stmt->fetch(PDO::FETCH_ASSOC);


}catch(PDOException $e){
  exit('エラー：'.$e->getMessage());

}



?>
<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php include('navbar.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
   
    <div>
      <!-- ここから「本文」-->
      <h1 class="my-5">お知らせ</h1>
      <?php if(count($result) > 0 ): ?>
      <!-- TODO: 記事詳細を表示する -->
       <article class="info">
        <header class="info-header">
          <h2 class="info-titile"><?php echo $result['title']; ?></h2>
          <div class="info-data">
            <time datetime="<?php echo $result['date']; ?>"><?php echo $result['date']; ?></time>
            <p class="m-0"><?php echo $result['author']; ?></p>
          </div>
        </header>
        <section class="info-body my-3">
          <p>
            <?php echo nl2br($result['body']); ?>
          </p>
        </section>
       </article>
      <p><a href="./">トップページへ戻る</a></p>
       <?php elseif(!$fp): ?>
          <p>ファイルが開けませんでした。</p>
      <?php else: ?>
        <p>存在しないページです。</p>
        <?php endif; ?>
      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
</body>

</html>