<?php
require_once __DIR__ . '/../db.php';

header('Content-Type: application/json');

$email = $_POST['login-email'] ?? '';
$password = $_POST['login-password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Missing email or password']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, full_name, password_hash FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // START SESSION AND SAVE USER INFO
        session_start();

        // Put user info into the session so other pages can see it
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];

        // Also return JSON for your AJAX front-end
        echo json_encode([
            'success' => true,
            'name' => $user['full_name'],
            'id' => $user['id']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email or password'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
