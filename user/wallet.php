<?php
$title = "Store";
$selected = "Store";
include 'inc/header.php';
include 'inc/navbar.php';
$charges = $db->select_charges();

?>
<div class="page-content">
    <?php
    include 'inc/sidebar.php';
    ?>


    <main class="page-main">
        <div class="uk-grid" data-uk-grid>
            <div class="uk-width-2-3@l uk-width-3-3@m uk-width-3-3@s"
                style="display: flex; justify-content: space-evenly; flex-flow: row wrap;width: 100% !important;">


                <?php
                foreach ($charges as $charge) {
                    echo '

                        <div class="card" style="margin-top: auto; margin-bottom: 50px;"
                    style="margin-top: auto; margin-bottom: 50px;">

                    <div class="imgBox">
                        <img src="../assets/coins/packages/' . $charge['img'] . '" alt="" class="mouse">
                    </div>

                    <div class="contentBox">
                        <h3>' . $charge['name'] . '</h3>
                        <h2 class="price">' . $charge['price'] . ' $</h2>
                        <a href="#" class="buy">Buy Now</a>
                    </div>

                </div>
                        ';
                }

                ?>

            </div>
        </div>


    </main>




</div>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>
</body>


</html>