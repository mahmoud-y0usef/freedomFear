<?php
$title = 'Activate Account';
include 'inc/header.php';
?>
<div class="welcome-page">
    <div class="uk-width-expand@m page-first-screen">
        <?php 
            if(isset($_GET['error'])){
                echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'.$_GET['error'].'</p></div>';
            }elseif(isset($_GET['success'])){
                echo '<div class="uk-alert-success" uk-alert><a class="uk-alert-close" uk-close></a><p>'.$_GET['success'].'</p></div>';
            }
        ?>
        <div class="fl-hd-cover"></div>
        <div class="form-login
            ">
            <div class="form-login__box">
                <div class="uk-heading
                    -line uk-text-center"><span>Activate Account</span></div>
                    <br>
                <form action="function/auth.php" method="post">
                    <div class="uk-margin"><input class="uk-input" type="text" name="email" required
                            placeholder="Email"></div>
                    <div class="uk-margin"><input class="uk-input" type="text" name="key" required
                            placeholder="Activation Key"></div>
                    <div class="uk-margin"><button class="uk-button uk-button-danger uk-width-1-1"
                            type="submit">Activate</button></div>
                    <div class="uk-text-center"><span>Already have an account?</span><a class="uk-margin-small-left"
                            href="index.php">Log In</a></div>

                    <br>

                </form>
            </div>
        </div>
    </div>


</div>


<?php
include 'inc/footer.php';
?>