<?php
$title = "Checkout";
$selected = "wallet";
include 'inc/header.php';
include 'inc/navbar.php';

$charge_id = isset($_GET['charge_id']) ? $_GET['charge_id'] : null;
if (!$charge_id) {
    die('Invalid charge ID.');
}

$charge = $db->select_charge_by_id($charge_id);
if (!$charge) {
    die('Charge not found.');
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
                        <h2><?php echo htmlspecialchars($charge['name']); ?></h2>
                        <h3 class="price"><?php echo htmlspecialchars($charge['price']); ?> $</h3>
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
                        value: '<?php echo $charge['price']; ?>'
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture()
                .then(function (details) {
                    console.log('Transaction completed:', details);
                    alert('Transaction completed by ' + details.payer.name.given_name);

                    // Update user's wallet in the backend
                    fetch('update_wallet.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            userID: <?php echo json_encode($_SESSION['user']['id']); ?>,
                            chargeID: <?php echo json_encode($charge['id']); ?>
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = "success.php?orderID=" + data.orderID;
                            } else {
                                throw new Error(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Wallet update error:', error);
                            window.location.href = "error.php?error=" + encodeURIComponent(error.message);
                        });
                })
                .catch(function (error) {
                    console.error('Capture error:', error);
                    window.location.href = "error.php?error=" + encodeURIComponent(error.message);
                });
        },
        onError: function (err) {
            console.error('PayPal error:', err);
            window.location.href = "error.php?error=" + encodeURIComponent(err.message);
        }
    }).render('#paypal-button-container');
</script>

</body>

</html>