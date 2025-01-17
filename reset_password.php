<?php
$title = 'Rest Password';
include 'inc/header.php';
?>

<div class="welcome-page">

    <!-- rest password -->
    <div class="uk-text-center" uk-grid>

        <div class="uk-width-expand@m uk-visible@m page-first-screen">
            <div class="fl-hd-cover"></div>
            <div class="uk-card  uk-card-body "></div>
        </div>
        <div class="uk-width-expand@m">
            <div class="form-login">
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p>' . filter_var($_GET['error'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
                }
                if (isset($_GET['success'])) {
                    echo '<div class="uk-alert-success" uk-alert><a class="uk-alert-close" uk-close></a><p>' . filter_var($_GET['success'] , FILTER_SANITIZE_SPECIAL_CHARS) . '</p></div>';
                }
                ?>
                <div>
                    <span>Reset Password</span>
                </div>
                <br><br>
                <div class="form-login__box">
                    <form action="function/reset_password.php" method="post">
                        <div class="uk-margin"><input class="uk-input" type="text" name="email" required
                                placeholder="Email">
                        </div>
                        <div class="uk-margin"><input class="uk-input" type="text" name="key" required
                                placeholder="Reset Key">
                        </div>
                        <div class="uk-margin"><input class="uk-input" type="password" name="password" required
                                placeholder="New Password">
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-danger uk-width-1-1" name="reset_password"
                                type="submit">Reset</button>
                        </div>

                        <hr>
                        <div class="uk-text-center"><span>Don’t have an account?</span><a class="uk-margin-small-left"
                                href="register.php">Register</a></div>
                        <br>
                        <div class="uk-text-center"><a class="uk-margin-small-left" href="index.php">Back to login</a>
                        </div>
                    </form>
                    <br>
                    <br>
                    <br><br><br>
                </div>



            </div>



            <?php
            include 'inc/footer.php';
            ?>