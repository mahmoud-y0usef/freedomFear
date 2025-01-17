<?php
$title = "Add Stream";
$selected = "streams";
include 'inc/header.php';
include 'inc/navbar.php';

// Fetch available languages
$lang = $db->get_type_lang_stream();
?>

<div class="page-content">
    <?php include 'inc/sidebar.php'; ?>

    <main class="page-main">

        <!-- Display success or error messages -->
        <?php if (isset($_GET['success'])): ?>
            <div class="uk-alert-success" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                <p><?php echo htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="uk-alert-danger" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                <p><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endif; ?>

        <div class="uk-grid" data-uk-grid>
            <!-- Add stream form -->
            <div class="uk-width-1-1">
                <div class="uk-card uk-card-default uk-card-body">
                    <h3 class="uk-card-title" data-translate-key="add_stream">Add Stream</h3>
                    <form class="uk-form-stacked" action="../function/add_stream.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>">

                        <!-- Title -->
                        <div class="uk-margin">
                            <label class="uk-form-label" for="title" data-translate-key="title">Title</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="title" type="text" name="title" placeholder="Enter stream title" required>
                            </div>
                        </div>

                        <!-- URL -->
                        <div class="uk-margin">
                            <label class="uk-form-label" for="url" data-translate-key="url">URL</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="url" type="text" name="url" placeholder="Enter stream URL" required>
                            </div>
                        </div>

                        <!-- Language -->
                        <div class="uk-margin">
                            <label class="uk-form-label" for="lang" data-translate-key="language">Language</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="lang" name="lang" required>
                                    <option value="" disabled selected data-translate-key="select_language">Select language</option>
                                    <?php foreach ($lang as $l): ?>
                                        <option value="<?php echo htmlspecialchars($l['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php echo htmlspecialchars($l['name'], ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="uk-margin">
                            <label class="uk-form-label" for="img" data-translate-key="image">Image</label>
                            <div class="uk-form-controls">
                                <input class="uk-input" hidden id="img" type="file" name="img" accept="image/*" required>
                                <img src="../assets/img/streams/freedom_fear.png" alt="stream" class="uk-border-circle" width="100" height="100" id="prof">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="uk-margin">
                            <button class="uk-button uk-button-primary" type="submit" data-translate-key="add">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>

<div class="page-modals">
    <?php include 'inc/modals.php'; ?>
</div>

<script>
    // Preview selected image
    document.getElementById('img').addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('prof').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    // Open file selector when clicking on the preview image
    document.getElementById('prof').addEventListener('click', function() {
        document.getElementById('img').click();
    });
</script>

</body>
</html>
