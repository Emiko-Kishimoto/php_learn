<?php
require_once '../../inc/functions.php';

// ログイン必須
require_login();

// メソッド確認 
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

// JSON入力受け取り
$input = json_decode(file_get_contents('php://input'), true);

if (empty($input['id'])) {
    output_json(['error' => 'Missing ID'], 400);
}

// DB接続
$pdo = db_connect();

$sql = 'DELETE FROM questions WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $input['id'], PDO::PARAM_INT);

try {
    $stmt->execute();
    output_json(['message' => 'Question deleted', 'id' => $input['id']]);
} catch (Exception $e) {
    output_json(['error' => 'Failed to delete question'], 500);
}
