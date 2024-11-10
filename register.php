<?php 
    $title = 'Register';
    include 'inc/header.php';
?>
    <div class="welcome-page">
        <div class="uk-width-expand@m page-first-screen">
            <div class="fl-hd-cover"></div>
            <div class="form-login">
                <?php 
                    if(isset($_GET['error'])){
                        echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'.$_GET['error'].'</p></div>';
                    }
                ?>
                <div class="form-login__box">
                    <div class="uk-heading-line uk-text-center"><span>Register</span></div>
                    <form action="function/register.php" method="post">
                        <div class="uk-margin"><input class="uk-input" type="email" name="email" required placeholder="Email"></div>
                        <div class="uk-margin"><input class="uk-input" type="text" name="username" required placeholder="Username"></div>
                        <div class="uk-margin"><input class="uk-input" type="password" name="password" required placeholder="Password"></div>
                        
                        <!-- reCAPTCHA widget -->
                        <div class="uk-margin">
                            <div class="g-recaptcha" data-sitekey="6LcI43oqAAAAAIZU5SCf6BBPKq-P1c7E8gSZ_Vlv"></div>
                        </div>

                        <div class="uk-margin"><button class="uk-button uk-button-danger uk-width-1-1"
                                type="submit">Register</button></div>
                        <div class="uk-text-center"><span>Already have an account?</span><a class="uk-margin-small-left"
                                href="index.php">Log In</a></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<!-- Include the reCAPTCHA script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php 
    include 'inc/footer.php';
?>
