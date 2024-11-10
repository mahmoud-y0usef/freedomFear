<?php
$title = 'Login';
include 'inc/header.php';
session_start();

if (isset($_SESSION['user'])) {
    header('Location: user/');
}

if (isset($_SESSION['admin'])) {
    header('Location: admin/');
}

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
                if (isset($_GET['error'])) {
                    echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' . $_GET['error'] . '</p></div>';
                } elseif (isset($_GET['success'])) {
                    echo '<div class="uk-alert-success" uk-alert><a class="uk-alert-close" uk-close></a><p>' . $_GET['success'] . '</p></div>';
                }
                ?>
                <div class="form-login__box">
                    <div class="uk-heading-line uk-text-center"><span>Login</span></div>
                    <form action="function/login.php" method="post">
                        <div class="uk-margin"><input class="uk-input" type="text" name="username_or_email"
                                placeholder="Username or Email" required></div>
                        <div class="uk-margin"><input class="uk-input" type="password" name="password"
                                placeholder="Password" required></div>
                        <div class="uk-margin"><input class="uk-button uk-button-danger uk-width-1-1" name="login"
                                type="submit" value="Log In">
                        </div>
                        <div class="uk-margin uk-text-center"><a href="forget-password.php">Forgotten password?</a>
                        </div>
                        <hr>
                        <div class="uk-text-center"><span>Don’t have an account?</span><a class="uk-margin-small-left"
                                href="register.php">Register</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</div>

<?php
include 'inc/footer.php';
?>