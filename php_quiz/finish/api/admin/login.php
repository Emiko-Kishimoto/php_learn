<?php
require_once '../../inc/functions.php';

// POSTリクエストのみ許可
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    output_json(['error' => 'Method Not Allowed'], 405);
}

$input = get_json_input();

// Null合体演算子
$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

// バリデーション
if (empty($username) || empty($password)) {
    output_json(['error' => 'Username and password are required.'], 400);
}

// DB接続
$pdo = db_connect();

// ユーザー検索
$stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 認証判定
if ($user && password_verify($password, $user['password'])) {
    // ログイン成功：セッションID再生成（セキュリティ）
    session_start();
    session_regenerate_id(true);
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_username'] = $user['username'];

    output_json(['message' => 'Login successful', 'username' => $user['username']]);
} else {
    // ログイン失敗
    output_json(['error' => 'Invalid credentials'], 401);
}
