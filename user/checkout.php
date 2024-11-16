<?php
$title = "Checkout";
$selected = "wallet";
include 'inc/header.php';
include 'inc/navbar.php';

$charge_id = isset($_GET['charge_id']) ? $_GET['charge_id'] : null;
if (!$charge_id) {
    die('Invalid charge ID');
}
$charge = $db->select_charge_by_id($charge_id);
if (!$charge) {
    die('Charge not found');
}

?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>

    <main class="page-main">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-1" style="display: flex; justify-content: center;">
                <div class="card" style="margin-top: 50px;">
                    <div class="contentBox">
                        <h3>Complete Your Purchase</h3>
                        <h2><?php echo $charge['name']; ?></h2>
                        <h3 class="price"><?php echo $charge['price']; ?> $</h3>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

<script
    src="https://www.paypal.com/sdk/js?client-id=AfZ4mwHnbQ67D47e_EnNmpPvJ0Zconitm1MrDf55lx6fa3RNDSpDkcQPbD7M3Kbr9WIvpW1YnN73iMeD&currency=USD&intent=capture"></script>
<script>
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $charge['price']; ?>' // Ensure price is correctly passed
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            // Capture the order
            return actions.order.capture()
                .then(function (details) {
                    console.log('Transaction completed:', details); // Log the transaction details
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    <?php

                    $coinsAndJwel = explode('&', $_SESSION['user']['coins']);
                    $coins = isset($coinsAndJwel[0]) ? $coinsAndJwel[0] : 0;
                    $jwel = isset($coinsAndJwel[1]) ? $coinsAndJwel[1] : 0;
                    $coins += $charge['amount_coins'];
                    $jwel += $charge['amount_jwel'];
                    $db->update_user_coins($_SESSION['user']['id'], $coins, $jwel);

                    ?>
                    // Redirect to the success page
                    window.location.href = "success.php?orderID=" + data.orderID +
                        "&userID=<?php echo $_SESSION['user']['id']; ?>" +
                        "&chargeID=<?php echo $charge['id']; ?>";
                })
                .catch(function (error) {
                    console.error('Capture error:', error); // Log the error
                    alert('An error occurred while capturing the payment.');
                    // Redirect to error page
                    window.location.href = "error.php?error=" + encodeURIComponent(error.message);
                });
        },
        onError: function (err) {
            console.error('PayPal error:', err); // Log any unexpected errors
            alert('An unexpected error occurred. Please try again.');
            window.location.href = "error.php?error=" + encodeURIComponent(err.message);
        }
    }).render('#paypal-button-container');
</script>



</body>

</html>