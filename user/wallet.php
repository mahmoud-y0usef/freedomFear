<?php
$title = "Wallet";
$selected = "Wallet";
include 'inc/header.php';
include 'inc/navbar.php';
$charges = $db->select_charges();
?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>

    <main class="page-main">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-2-3@l uk-width-3-3@m uk-width-3-3@s"
                style="display: flex; justify-content: space-evenly; flex-flow: row wrap;width: 100% !important;">
                <?php foreach ($charges as $charge): ?>
                    <div class="card" style="margin-top: auto; margin-bottom: 50px;">
                        <div class="imgBox">
                            <img src="../assets/coins/packages/<?php echo $charge['img']; ?>" alt="" class="mouse">
                        </div>
                        <div class="contentBox">
                            <h3><?php echo $charge['name']; ?></h3>
                            <h2 class="price"><?php echo $charge['price']; ?> $</h2>
                            <a href="checkout.php?charge_id=<?php echo $charge['id']; ?>" class="buy">Buy Now</a>
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