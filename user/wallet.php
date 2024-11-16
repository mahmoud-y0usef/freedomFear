<?php
$title = "Wallet";
$selected = "wallet";
include 'inc/header.php';
include 'inc/navbar.php';

$charges = $db->select_charges();
$users = $db->get_user_by_id($_SESSION['user']['id']);
?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>

    <main class="page-main">
        <div class="uk-grid" data-uk-grid>
            <!-- Wallet Information -->
            <div class="uk-width-1-1@s uk-width-1-1@m uk-width-1-1@l">
                <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
                    <h3 class="uk-card-title">Your Wallet</h3>
                    <div class="uk-grid" data-uk-grid>
                        <!-- Jwel Section -->
                        <div class="uk-width-1-2@s uk-width-1-2@m uk-width-1-2@l">
                            <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
                                <h3 class="uk-card-title">Your Jwel</h3>
                                <?php
                                $coinsAndJwel = explode('&', $users['coins']);
                                $jwel = isset($coinsAndJwel[1]) ? $coinsAndJwel[1] : '0';
                                ?>
                                <h2 class="uk-text-bold">
                                    <?php echo htmlspecialchars(trim($jwel)); ?> 
                                    <img src="../assets/coins/packages/<?php echo htmlspecialchars($charges[7]['img']); ?>" alt="jwel-icon" class="mouse">
                                </h2>
                            </div>
                        </div>

                        <!-- Coins Section -->
                        <div class="uk-width-1-2@s uk-width-1-2@m uk-width-1-2@l">
                            <div class="uk-card uk-card-default uk-card-body uk-margin-bottom">
                                <h3 class="uk-card-title">Your Coins</h3>
                                <?php
                                $coins = isset($coinsAndJwel[0]) ? $coinsAndJwel[0] : '0';
                                ?>
                                <h2 class="uk-text-bold">
                                    <?php echo htmlspecialchars(trim($coins)); ?> 
                                    <img src="../assets/coins/packages/<?php echo htmlspecialchars($charges[8]['img']); ?>" alt="coins-icon" class="mouse">
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charge Packages -->
            <div class="uk-width-2-3@l uk-width-1-1@m uk-width-1-1@s"
                style="display: flex; justify-content: space-evenly; flex-flow: row wrap; width: 100%;">
                <?php foreach ($charges as $charge): ?>
                    <div class="card" style="margin-top: auto; margin-bottom: 50px;">
                        <div class="imgBox">
                            <img src="../assets/coins/packages/<?php echo htmlspecialchars($charge['img']); ?>" alt="<?php echo htmlspecialchars($charge['name']); ?>" class="mouse">
                        </div>
                        <div class="contentBox">
                            <h3><?php echo htmlspecialchars($charge['name']); ?></h3>
                            <h2 class="price"><?php echo htmlspecialchars($charge['price']); ?> $</h2>
                            <a href="checkout.php?charge_id=<?php echo htmlspecialchars($charge['id']); ?>" class="buy">Buy Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>
</html>
