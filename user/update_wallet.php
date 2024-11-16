<?php

require_once '../function/DB.php'; 

// Set response type to JSON
header('Content-Type: application/json');

// Get raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Validate the incoming data
if (!isset($data['userID']) || !isset($data['chargeID'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data.']);
    exit;
}

$userID = (int) $data['userID'];
$chargeID = (int) $data['chargeID'];

// Fetch the user and charge details
$db = new DB();
$user = $db->get_user_by_id($userID);
$charge = $db->select_charge_by_id($chargeID);

if (!$user || !$charge) {
    echo json_encode(['success' => false, 'message' => 'User or charge not found.']);
    exit;
}

// Extract the current coins and jewels from the user's wallet
$coinsAndJwel = explode('&', $user['coins']);
$currentCoins = isset($coinsAndJwel[0]) ? (int) $coinsAndJwel[0] : 0;
$currentJwel = isset($coinsAndJwel[1]) ? (int) $coinsAndJwel[1] : 0;

// Extract the charge's values for coins and jewels
$chargeCoins = isset($charge['amount_coins']) ? (int) $charge['amount_coins'] : 0;
$chargeJwel = isset($charge['amount_jwel']) ? (int) $charge['amount_jwel'] : 0;

// Update the user's wallet values
$newCoins = $currentCoins + $chargeCoins;
$newJwel = $currentJwel + $chargeJwel;

// Prepare the new wallet value as a string
$newWalletValue = $newCoins . '&' . $newJwel;

// Update the user's wallet in the database
$updateResult = $db->update_user_coins($userID, $newWalletValue);

if ($updateResult) {
    echo json_encode(['success' => true, 'message' => 'Wallet updated successfully.', 'orderID' => uniqid()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update wallet.']);
}
?>