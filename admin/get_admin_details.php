<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../function/DB.php";

    // Validate input
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        echo json_encode(['error' => 'Invalid user ID.']);
        exit;
    }

    $db = new DB();
    $userId = (int)$_POST['id'];

    // Fetch user details
    $user = $db->get_admin_by_id($userId);

    // Check if user exists
    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
