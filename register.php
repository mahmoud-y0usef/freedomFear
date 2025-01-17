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
                        echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>'. filter_var($_GET['error'] , FILTER_SANITIZE_SPECIAL_CHARS).'</p></div>';
                    }
                ?>
                <div class="form-login__box">
                    <div class="uk-heading-line uk-text-center"><span>Register</span></div>
                    <form action="function/register.php" method="post">
                        <div class="uk-margin"><input class="uk-input" type="email" name="email" required placeholder="Email"></div>
                        <div class="uk-margin"><input class="uk-input" type="text" name="username" required placeholder="Username"></div>
                        <div class="uk-margin"><input class="uk-input" type="password" name="password" required placeholder="Password"></div>
                        
                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">


                        <div class="uk-margin"><button class="uk-button uk-button-danger uk-width-1-1"
                                type="submit">Register</button></div>
                        <div class="uk-text-center"><span>Already have an account?</span><a class="uk-margin-small-left"
                                href="index.php">Log In</a></div>
                    </form>
                </div>
            </div>
        </div>

    </div>


<!-- Include reCAPTCHA v3 script -->
<script src="https://www.google.com/recaptcha/api.js?render=6LcI43oqAAAAAIZU5SCf6BBPKq-P1c7E8gSZ_Vlv"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcI43oqAAAAAIZU5SCf6BBPKq-P1c7E8gSZ_Vlv', {action: 'register'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script><?php 
    include 'inc/footer.php';
?>
