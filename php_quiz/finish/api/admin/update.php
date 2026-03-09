<?php
require_once '../../inc/functions.php';

// ログイン必須
require_login();

// メソッド確認
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'PUT') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

// JSON入力受け取り
$input = json_decode(file_get_contents('php://input'), true);

// 必須項目チェック
if (
    empty($input['id']) ||
    empty($input['question_text']) ||
    empty($input['choice1']) ||
    empty($input['choice2']) ||
    empty($input['choice3']) ||
    empty($input['choice4']) ||
    empty($input['correct_choice'])
) {
    output_json(['error' => 'Missing required fields'], 400);
}

// DB接続
$pdo = db_connect();

$sql = 'UPDATE questions 
        SET question_text = :text, 
            choice1 = :c1, 
            choice2 = :c2, 
            choice3 = :c3, 
            choice4 = :c4, 
            correct_choice = :correct, 
            explanation = :exp
        WHERE id = :id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':text', $input['question_text'], PDO::PARAM_STR);
$stmt->bindValue(':c1', $input['choice1'], PDO::PARAM_STR);
$stmt->bindValue(':c2', $input['choice2'], PDO::PARAM_STR);
$stmt->bindValue(':c3', $input['choice3'], PDO::PARAM_STR);
$stmt->bindValue(':c4', $input['choice4'], PDO::PARAM_STR);
$stmt->bindValue(':correct', $input['correct_choice'], PDO::PARAM_INT);
$stmt->bindValue(':exp', $input['explanation'] ?? '', PDO::PARAM_STR);
$stmt->bindValue(':id', $input['id'], PDO::PARAM_INT);

try {
    $stmt->execute();
    output_json(['message' => 'Question updated', 'id' => $input['id']]);
} catch (Exception $e) {
    output_json(['error' => 'Failed to update question'], 500);
}
