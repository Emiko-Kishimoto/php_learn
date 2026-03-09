<?php
require_once '../../inc/functions.php';

// ログイン必須
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

$input = json_decode(file_get_contents('php://input'), true);

// 簡易バリデーション
if (
    empty($input['question_text']) ||
    empty($input['choice1']) ||
    empty($input['choice2']) ||
    empty($input['choice3']) ||
    empty($input['choice4']) ||
    empty($input['correct_choice'])
) {
    output_json(['error' => 'Missing required fields'], 400);
}

$pdo = db_connect();

$sql = 'INSERT INTO questions (question_text, choice1, choice2, choice3, choice4, correct_choice, explanation) 
        VALUES (:text, :c1, :c2, :c3, :c4, :correct, :exp)';
        
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':text', $input['question_text'], PDO::PARAM_STR);
$stmt->bindValue(':c1', $input['choice1'], PDO::PARAM_STR);
$stmt->bindValue(':c2', $input['choice2'], PDO::PARAM_STR);
$stmt->bindValue(':c3', $input['choice3'], PDO::PARAM_STR);
$stmt->bindValue(':c4', $input['choice4'], PDO::PARAM_STR);
$stmt->bindValue(':correct', $input['correct_choice'], PDO::PARAM_INT);
$stmt->bindValue(':exp', $input['explanation'] ?? '', PDO::PARAM_STR);

try {
    $stmt->execute();
    output_json(['message' => 'Question created', 'id' => $pdo->lastInsertId()], 201);
} catch (Exception $e) {
    output_json(['error' => 'Failed to create question'], 500);
}
