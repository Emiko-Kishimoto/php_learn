<?php
require_once __DIR__ . '/config.php';

// DB接続関数
function db_connect()
{
    try {
        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database Connection Error: ' . $e->getMessage()]);
        exit();
    }
}

// JSON出力関数
function output_json($data, $status_code = 200)
{
    header('Content-Type: application/json; charset=UTF-8');
    // CORS対策（開発環境用：全てのオリジンを許可）
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    http_response_code($status_code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}

// 管理者ログイン必須チェック
function require_login()
{
    // セッション開始（まだ始まっていなければ）
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // セッション変数にadmin_idがない＝ログインしていない
    if (!isset($_SESSION['admin_id'])) {
        output_json(['error' => 'Unauthorized'], 401);
    }
}

// JSONデータ受け取り関数
function get_json_input()
{
    $raw = file_get_contents('php://input');
    $input = json_decode($raw, true);

    // フォールバック
    if (!$input && !empty($_POST)) {
        return $_POST;
    }

    return $input ? $input : [];
}
