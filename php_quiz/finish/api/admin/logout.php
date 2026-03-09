<?php
require_once '../../inc/functions.php';

session_start();

// セッション変数を空にする
$_SESSION = [];

// セッションクッキーを削除
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// セッション破棄
session_destroy();

output_json(['message' => 'Logout successful']);
