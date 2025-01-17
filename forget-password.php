<?php
$title = 'Forget Password';
include 'inc/header.php';
?>


<div class="welcome-page">


    <div class="uk-text-center" uk-grid>

        <div class="uk-width-expand@m uk-visible@m page-first-screen">
            <div class="fl-hd-cover"></div>
            <div class="uk-card  uk-card-body "></div>
        </div>
        <div class="uk-width-expand@m">
            <div class="form-login">
                <?php 
                if(isset($_GET['error'])){
                    echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'.filter_var($_GET['error'] , FILTER_SANITIZE_SPECIAL_CHARS).'</p></div>';
                }
                ?>
                <div>
                    <span>Forget Password</span>
                </div>
                <br><br>
                <div class="form-login__box">
                    <form action="function/forget_password.php" method="post">
                        <div class="uk-margin"><input class="uk-input" type="text" name="email" required placeholder="Email">
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-danger uk-width-1-1" name="send_email"
                                type="submit">Send</button>
                        </div>
                </div>
                <hr>
                <div class="uk-text-center"><span>Don’t have an account?</span><a class="uk-margin-small-left"
                        href="register.php">Register</a></div>
                <br>
                <div class="uk-text-center"><a class="uk-margin-small-left" href="index.php">Back to login</a></div>
                </form>
            </div>
        </div>
    </div>
</div>




</div>


<?php
include 'inc/footer.php';
?>