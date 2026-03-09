<?php
require_once '../../inc/functions.php';

// ログイン必須
require_login();

// DB接続
$pdo = db_connect();

try {
    // 全件取得（正解・解説も含める）
    $stmt = $pdo->query('SELECT * FROM questions ORDER BY id ASC');
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // JSON出力
    output_json($questions);
} catch (Exception $e) {
    output_json(['error' => 'Failed to fetch questions'], 500);
}
