<?php
$title = "Checkout";
$selected = "Checkout";
include 'inc/header.php';
include 'inc/navbar.php';

$charge_id = $_GET['charge_id'];
$charge = $db->select_charge_by_id($charge_id); // Implement this method in DB.php

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

<script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=USD"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $charge['price']; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Capture the funds from the transaction
            return actions.order.capture().then(function(details) {
                // Show a success message to your buyer
                alert('Transaction completed by ' + details.payer.name.given_name);
                // Redirect to a success page
                window.location.href = "success.php?orderID=" + data.orderID + "&userID=<?php echo $_SESSION['user']['id']; ?>" + "&chargeID=<?php echo $charge['id']; ?>";
            });
        }
    }).render('#paypal-button-container'); // Display payment options on your web page
</script>

</body>
</html>
