<?php
require_once '../../inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

$raw_input = file_get_contents('php://input');
$input = json_decode($raw_input, true);

// デバッグ用(JSONじゃなくてPOST送信の場合も動作するように)
if (!$input && !empty($_POST)) {
    $input = $_POST;
}

$question_id = $input['question_id'] ?? null;
$user_choice = $input['user_choice'] ?? null; // 1~4の数値

if (!$question_id || !$user_choice) {
    output_json(['error' => 'Invalid input'], 400);
}

$pdo = db_connect();

// 正解を取得
$stmt = $pdo->prepare('SELECT correct_choice, explanation FROM questions WHERE id = :id');
$stmt->bindValue(':id', $question_id, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    output_json(['error' => 'Question not found'], 404);
}

// 判定
$is_correct = ((int)$data['correct_choice'] === (int)$user_choice);

output_json([
    'result' => $is_correct,
    'correct_choice' => (int)$data['correct_choice'], // 答え合わせ用に正解を返す
    'explanation' => $data['explanation']
]);
