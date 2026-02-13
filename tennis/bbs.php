<!-- http://localhost:8080/php_learn/tennis/bbs.php -->
 <?php 
 // DBへ接続
$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
$user = 'tennisuser';
$password = 'password';
try{
    // PDOインスタンス作成
    // PDOは「データベースとの接続窓口」
    $db = new PDO($dsn,$user,$password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    // プリペアードステートメント作成
    $sql = 'SELECT * FROM bbs ORDER BY date DESC';
    $stmt = $db->prepare($sql);

    // SQLの実行
    $stmt->execute();
    // 取得したレコードを連想配列の形で受け取る
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($result);
    // echo "<pre>";

}catch(PDOException $e){
    exit('エラー:' .$e->getMessage());
}
 
 ?>
<!doctype html>
<html lang="ja" >
  <head>
    <title>サークルサイト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>

    <?php include('navbar.php'); ?>

    <main role="main" class="container" style="padding:60px 15px 0">
      <div>
        <!-- ここから「本文」-->

        <h1>掲示板</h1>
        <form action="write.php" method="post">
          <div class="form-group">
            <label>タイトル</label>
            <input type="text" name="title" class="form-control">
          </div>
          <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <textarea name="body" class="form-control" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label>削除パスワード（数字４桁）</label>
            <input type="text" name="pass" class="form-control">
          </div>
          <input type="submit" class="btn btn-primary" value="書き込む">
        </form>

        <hr>
        <?php foreach($result as $row): ?>
        <div class="card">
          <div class="card-header"><?php echo $row['title']?$row['title']:'(無題)'; ?></div>
        
              <div class="card-body">
                <p class="card-text">
                  <?php echo nl2br($row['body']); ?>
                </p>
              </div>
              <div class="card-footer">
                <form action="delete.php" method="post" class="form-inlline">
                <?php echo $row['name'].'(' .$row['date'] .')'; ?>
                <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="pass" id="pass" class="form-control" placeholder="削除パスワード">
                <input type="submit" value="削除" class="btn btn-secondary">
                </form>
              </div>
        </div>
        <hr>
        <?php endforeach; ?>

        <!-- 本文ここまで -->
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
