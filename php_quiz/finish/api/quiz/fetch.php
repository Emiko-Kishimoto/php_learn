<?php
require_once '../../inc/functions.php';

// GETリクエストのみ許可
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

$pdo = db_connect();

// 全件取得
// 重要: correct_choice と explanation はここでは取得しない（カンニング防止）
$sql = 'SELECT id, question_text, choice1, choice2, choice3, choice4 FROM questions';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

output_json($questions);
