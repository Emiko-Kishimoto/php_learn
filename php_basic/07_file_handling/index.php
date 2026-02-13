<!-- http://localhost:8080/php_learn/php_basic/07_file_handling/index.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>07_file_handling: ファイル操作の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>07_file_handling: ファイル操作の練習</h1>
    <section>
      <h2>ファイルの作成</h2>
      <section>
        <h3>PHPを使い<code>message.txt</code>というファイルを作成し「ファイル書き込み」という文字列を書き込んでください。</h3>
        <!-- ここからPHPを書く -->
         <?php 
         $fp = fopen("message.text", "w");
         fwrite($fp, "ファイル書き込み");
         fclose($fp);
         ?>

        <!-- ここまでPHPを書く -->
      </section>
    </section>
    <section>
      <h2>ファイルの読み込み</h2>
      <section>
        <h3>PHPを使い<code>data.txt</code>を読み込んで内容を全て<em>1行ずつ</em>表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
           <?php
           $fp = fopen("data.txt","r");
           while($line = fgets($fp)){
            echo $line ."<br>";
           }
           fclose($fp);
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
    <section>
      <h2>CSVファイルの取り扱い</h2>
      <section>
        <h3>PHPを使い<code>products.csv</code>を1行目だけ読み込んで、1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
           <?php 
           $fp = fopen("products.csv","r");
           $header = fgetcsv($fp);
           foreach($header as $data){
            echo $data . "<br>";
           }
           fclose($fp);
           ?>

          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>PHPを使い<code>products.csv</code>を読み込んで全ての内容を1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
           <?php 
           $fp = fopen("products.csv","r");
           while($row = fgetcsv($fp)){
            foreach($row as $data){
              echo $data;
            }
            echo "<br>";
           }
           fclose($fp);
           ?>

          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>PHPを使い<code>products.csv</code>に次のデータを追加してください。</h3>
        <dl>
          <div class="desc-item">
            <dt>商品名</dt>
            <dd>シャインマスカット</dd>
          </div>
          <div class="desc-item">
            <dt>価格</dt>
            <dd>1200</dd>
          </div>
          <div class="desc-item">
            <dt>在庫数</dt>
            <dd>55</dd>
          </div>
        </dl>
        <div class="answer">
          <!-- ここからPHPを書く -->
           <?php
          $new_prodacuts = ["シャインマスカット" ,1200, 55];
          $fp = fopen("products.csv", "a");
          fputcsv($fp, $new_prodacuts);
          fclose($fp);
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>PHPを使い<code>products.csv</code>を読み込んでテーブルで表示してください。ただし、CSVファイルの1行目はテーブルの見出し行とすること。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
           <?php
           $fp = fopen("products.csv","r");
           $header = fgetcsv($fp);
           $body = array();
           while($row = fgetcsv($fp)){
            $body[] = $row;
           }
           fclose($fp);
          //  echo "<pre>";
          //  var_dump($body);
          //  echo "<pre>";
            ?>
          <!-- ここまでPHPを書く -->
          <table>
            <thead>
              <tr>
                  <?php foreach($header as $h): ?>
                    <th><?php echo $h ?></th>
                    <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
             
                <?php foreach($body as $row): ?>
                    <tr>
                      <?php foreach($row as $data): ?>
                        <td><?php echo $data; ?></td>
                        <?php endforeach; ?>
                        <?php  ?>
                    </tr>
                  <?php endforeach; ?>
              </tr>
            </tbody>
          </table>

        </div>
      </section>
    </section>
  </article>

</body>

</html>