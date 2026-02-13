<!-- http://localhost:8080/php_learn/tennis_plus/index.php -->
<?php
// TODO: CSV読み込み処理
$filename = "info/info.csv";
$fp = fopen($filename,"r");

$info_array = array();
if($fp){
  while($row = fgetcsv($fp)){
    $info_array[] = [$row[0],$row[1],$row[2]];
  }
  fclose($fp);
}

// ページネーション
// 年別・月別表示（記事検索）


// TODO: ソート処理
// 投稿日の降順（日付が新しい順）に並び替え
if(!empty($info_array)){
  // ソートの基準となる要素を抜き出す
  $dates = array_column($info_array,2);
  var_dump($dates);
  // array_multisort(並べ替える配列,ソートオプション,連動してソートする配列);
  array_multisort($dates,SORT_DESC,$info_array);
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
      <a href="info_add.php">お知らせ新規登録</a>
     <?php if(count($info_array) > 0): ?>
      <ul class="list-group my-3">
        <!-- TODO: 記事一覧を表示する -->

         <?php foreach($info_array as $row): ?>
         <li class="list-group-item">
          <a class="post-link" href="info.php?id=<?php echo $row[0]; ?>">
          <time class="post-date" datetime= "<?php echo $row[2]; ?>"><?php echo $row[2]; ?></time>
          <span class="post-title"><?php echo $row[1]; ?>
        </span>
         </a>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php else: ?>
              <p>お知らせはありません</p>
      <?php endif; ?>
      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>