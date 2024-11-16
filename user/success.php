<?php
$title = "Success";
$selected = "wallet";
include 'inc/header.php';
include 'inc/navbar.php';
?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>

    <main class="page-main">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-1-1@s uk-width-1-1@m uk-width-1-1@l">
                <div class="uk-card uk-card-default uk-card-body uk-margin-bottom" style="text-align: center;">
                    <h3 class="uk-card-title" style="color: #29e38b;">Payment Successful</h3>
                    <p style="font-size: 18px; margin-bottom: 20px;">
                        Thank you! Your payment was successfully processed.
                    </p>
                    <p style="font-size: 18px; color: #555;">
                        <strong>Order ID:</strong>
                        <?php echo isset($_GET['orderID']) ? htmlspecialchars($_GET['orderID'], ENT_QUOTES, 'UTF-8') : 'N/A'; ?>
                    </p>
                    <a href="index.php" class="uk-button uk-button-primary"
                        style="padding: 10px 20px; font-size: 16px;">
                        Return to Home
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>

</html>