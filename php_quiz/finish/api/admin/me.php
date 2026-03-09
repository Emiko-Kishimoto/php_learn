<?php
require_once '../../inc/functions.php';

session_start();

if (isset($_SESSION['admin_id'])) {
    output_json([
        'authenticated' => true,
        'username' => $_SESSION['admin_username']
    ]);
} else {
    output_json([
        'authenticated' => false
    ]);
}
