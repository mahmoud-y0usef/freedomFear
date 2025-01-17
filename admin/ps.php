<?php
$title = "Change Password";
$selected = "home";
include 'inc/header.php';
include 'inc/navbar.php';


?>




<div class="page-content">
    <?php
    include 'inc/sidebar.php';
    ?>


    <main class="page-main">

        <?php
        if (isset($_GET['success'])) {
            echo '<div class="uk-alert-success" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['success'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        } else if (isset($_GET['error'])) {
            echo '<div class="uk-alert-danger" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . filter_var($_GET['error'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
        }
        ?>

        <div class="uk-grid" data-uk-grid>
            <!-- update account for user -->

            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">
                    <h3 class="uk-card-title" data-translate-key="updatepassword">Update Password</h3>
                    <form class="uk-form-stacked" action="../function/ps.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">

                        <div class="uk-margin">
                            <label class="uk-form-label" style="color:black;" for="current_password"  data-translate-key="currentpassword">Current Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="current_password" required type="text" name="current_password"
                                    value="">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="new_password" style="color:black;" data-translate-key="newpassword">New Password</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="new_password" required type="text" name="new_password"
                                    value="">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" data-translate-key="change">Change</button>
                        </div>
                    </form>
                </div>


            </div>
    </main>




</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

</body>


</html>