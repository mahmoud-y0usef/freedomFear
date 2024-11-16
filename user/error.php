<?php
$title = "Error";
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
                    <h3 class="uk-card-title" style="color: #ff4d4f;">An Error Occurred</h3>
                    <p style="font-size: 18px; margin-bottom: 20px;">
                        <?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8') : 'An unexpected error occurred.'; ?>
                    </p>
                    <a href="index.php" class="uk-button uk-button-danger" style="padding: 10px 20px; font-size: 16px;">
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
