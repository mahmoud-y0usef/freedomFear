<?php
$title = "Update Account";
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
            echo '<div class="uk-alert-success" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . $_GET['success'] . '</p></div>';
        } else if (isset($_GET['error'])) {
            echo '<div class="uk-alert-danger" data-uk-alert><a class="uk-alert-close" data-uk-close></a><p>' . $_GET['error'] . '</p></div>';
        }
        ?>

        <div class="uk-grid" data-uk-grid>
            <!-- update account for user -->

            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">
                    <h3 class="uk-card-title">Update Account</h3>
                    <form class="uk-form-stacked" action="../function/up.php" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>">

                        <!-- image -->
                        <div class="uk-margin">
                            <label class="uk-form-label" for="img">Image</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" hidden id="img" type="file" name="image"
                                    value="<?php echo $user['img'] ?>">
                                <img src="../assets/img/<?php echo $user['img'] ?>" alt="user" class="uk-border-circle"
                                    width="100" height="100" id="prof">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="useranme">User Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="useranme" type="text" name="name"
                                    value="<?php echo $user['name'] ?>">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="nicname">Nick Name</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="nicname" type="text" name="nick"
                                    value="<?php echo $user['nick'] ?>">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="email">Email</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="email" type="email" name="email"
                                    value="<?php echo $user['email'] ?>">
                            </div>
                        </div>
                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>


            </div>
    </main>




</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>


<script>
    // update view for image user
    document.getElementById('img').addEventListener('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('prof').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('prof').addEventListener('click', function () {
        document.getElementById('img').click();
    });


</script>

</body>


</html>